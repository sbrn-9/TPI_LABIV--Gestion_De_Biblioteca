@extends('layouts.Admindashboard')

@section('content')
<div class="container mt-4">
    <a href="{{route('prestamos.index')}}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Atrás
    </a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Crear Nuevo Préstamo</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('prestamos.store') }}" method="POST" id="prestamoForm">
                @csrf

                <div class="form-group mb-3">
                    <label for="fecha_prestamo">Fecha de Préstamo</label>
                    <input type="date" class="form-control @error('fecha_prestamo') is-invalid @enderror" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo', today()->toDateString()) }}" required>
                    @error('fecha_prestamo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" class="form-control @error('fecha_devolucion') is-invalid @enderror" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion', today()->addDays(7)->toDateString()) }}" required>
                    @error('fecha_devolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Libros a prestar</h4>
                            <div class="input-group w-50" style="position: relative;">
                                <input type="text" id="searchBooks" class="form-control" placeholder="Buscar libros...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <div id="searchResults" class="position-absolute w-100 mt-1 d-none" style="top: 100%; z-index: 1000;">
                                    <div class="list-group">
                                        <!-- Search results will be inserted here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="selectedBooksTable">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Título</th>
                                        <th>Disponibles</th>
                                        <th>Cantidad a prestar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedBooksList">
                                    <!-- Selected books will be added here dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <x-primary-button class="btn btn-primary">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<template id="selectedBookRowTemplate">
    <tr>
        <td style="width: 100px;">
            <div class="book-image-container">
                <img src="" alt="Portada del libro" class="img-thumbnail book-cover" style="width: 60px; height: 90px; object-fit: cover;">
                <i class="fas fa-book fa-3x text-secondary"></i>
            </div>
        </td>
        <td class="book-title"></td>
        <td>
            <span class="badge bg-info text-white"></span>
        </td>
        <td style="width: 200px;">
            <input type="hidden" name="libros[INDEX][libro_id]">
            <input type="number" 
                class="form-control cantidad-input" 
                name="libros[INDEX][cantidad]" 
                min="1" 
                style="width: 100px;"
                required>
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-book">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
</template>

<style>
#searchResults {
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    max-height: 300px;
    overflow-y: auto;
}

#searchResults .list-group-item {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    cursor: pointer;
}

#searchResults .list-group-item:hover {
    background-color: #f8f9fa;
}

.book-image-container {
    width: 60px;
    height: 90px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.book-image-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.book-image-container .fa-book {
    display: none;
}

.book-image-container img:not([src]), 
.book-image-container img[src=""], 
.book-image-container img.error {
    display: none;
}

.book-image-container img:not([src]) ~ .fa-book,
.book-image-container img[src=""] ~ .fa-book,
.book-image-container img.error ~ .fa-book {
    display: block;
}

#searchResults .book-image-container {
    width: 40px;
    height: 60px;
    margin-right: 12px;
}

#searchResults .book-info {
    flex-grow: 1;
}
</style>

<script>
window.addEventListener('load', function() {
    // Datos de libros y libros seleccionados previamente
    const libros = @json($libros);
    const oldLibros = @json(old('libros', []));
    
    // Elementos del DOM
    const searchInput = document.getElementById('searchBooks');
    const searchResults = document.getElementById('searchResults');
    const selectedBooksList = document.getElementById('selectedBooksList');
    const selectedBookRowTemplate = document.getElementById('selectedBookRowTemplate');
    
    // Set para mantener track de los libros seleccionados
    const selectedBookIds = new Set();
    
    // Función para mostrar resultados de búsqueda
    function showSearchResults(searchTerm = '') {
        const listGroup = searchResults.querySelector('.list-group');
        listGroup.innerHTML = '';

        const results = libros.filter(libro => 
            libro.titulo.toLowerCase().includes(searchTerm.toLowerCase()) &&
            !selectedBookIds.has(libro.id) &&
            libro.disponibles > 0
        );

        results.forEach(libro => {
            const item = document.createElement('a');
            item.className = 'list-group-item list-group-item-action';
            item.innerHTML = `
                <div class="book-image-container">
                    <img src="${libro.img_url || ''}" alt="Portada de ${libro.titulo}" onerror="this.classList.add('error')">
                    <i class="fas fa-book fa-2x text-secondary"></i>
                </div>
                <div class="book-info">
                    ${libro.titulo}
                    <small class="text-muted d-block">
                        (${libro.disponibles} ${libro.disponibles === 1 ? 'disponible' : 'disponibles'})
                    </small>
                </div>
            `;
            item.addEventListener('click', () => selectBook(libro));
            listGroup.appendChild(item);
        });

        searchResults.classList.remove('d-none');
    }

    // Función para seleccionar un libro
    function selectBook(libro, cantidad = 1) {
        if (selectedBookIds.has(libro.id)) return;

        const newRow = selectedBookRowTemplate.content.cloneNode(true);
        const tr = newRow.querySelector('tr');
        const index = selectedBooksList.children.length;

        const img = tr.querySelector('img');
        img.src = libro.img_url || '';
        img.onerror = function() {
            this.classList.add('error');
        };

        tr.querySelector('.book-title').textContent = libro.titulo;
        tr.querySelector('.badge').textContent = `${libro.disponibles} ${libro.disponibles === 1 ? 'disponible' : 'disponibles'}`;
        
        const libroIdInput = tr.querySelector('input[name="libros[INDEX][libro_id]"]');
        const cantidadInput = tr.querySelector('input[name="libros[INDEX][cantidad]"]');
        
        libroIdInput.name = `libros[${index}][libro_id]`;
        libroIdInput.value = libro.id;
        
        cantidadInput.name = `libros[${index}][cantidad]`;
        cantidadInput.max = libro.disponibles;
        cantidadInput.value = cantidad;

        tr.querySelector('.remove-book').addEventListener('click', () => {
            selectedBookIds.delete(libro.id);
            tr.remove();
            reindexInputs();
            showSearchResults(searchInput.value);
        });

        cantidadInput.addEventListener('change', function() {
            const value = parseInt(this.value) || 0;
            if (value > libro.disponibles) {
                this.value = libro.disponibles;
            }
            if (value < 1) {
                this.value = 1;
            }
        });

        selectedBooksList.appendChild(tr);
        selectedBookIds.add(libro.id);
        
        // Limpiar búsqueda y ocultar resultados
        searchInput.value = '';
        searchResults.classList.add('d-none');
    }

    // Función para reindexar inputs después de eliminar
    function reindexInputs() {
        const rows = selectedBooksList.querySelectorAll('tr');
        rows.forEach((row, index) => {
            row.querySelector('input[type="hidden"]').name = `libros[${index}][libro_id]`;
            row.querySelector('input[type="number"]').name = `libros[${index}][cantidad]`;
        });
    }

    // Event listeners
    searchInput.addEventListener('input', () => showSearchResults(searchInput.value));
    searchInput.addEventListener('focus', () => showSearchResults(searchInput.value));
    
    // Cerrar resultados al hacer click fuera
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('d-none');
        }
    });

    // Validación del formulario
    document.getElementById('prestamoForm').addEventListener('submit', function(e) {
        if (selectedBookIds.size === 0) {
            e.preventDefault();
            alert('Debe seleccionar al menos un libro para el préstamo.');
        }
    });

    // Restaurar libros seleccionados si hay errores de validación
    if (oldLibros.length > 0) {
        oldLibros.forEach(oldLibro => {
            const libro = libros.find(l => l.id == oldLibro.libro_id);
            if (libro) {
                selectBook(libro, oldLibro.cantidad);
            }
        });
    }
});
</script>
@endsection
