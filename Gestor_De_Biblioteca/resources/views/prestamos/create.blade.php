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

            @if(Auth::user()->role->isAdmin())

            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="buscarQuery">Buscar Cliente:</label>
                    <input type="text" name="query" id="buscarQuery" class="form-control mr-2" placeholder="Buscar libros...">
                    <button type="button" id="buscarButton" class="btn btn-primary m-2">Buscar</button>
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_prestamo">Fecha de Préstamo</label>
                    <input type="date" class="form-control @error('fecha_prestamo') is-invalid @enderror" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo') }}" required>
                    @error('fecha_prestamo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" class="form-control @error('fecha_devolucion') is-invalid @enderror" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion') }}" required>
                    @error('fecha_devolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="buscarQuery">Buscar Libros:</label>
                    <input type="text" name="query" id="buscarQuery" class="form-control mr-2" placeholder="Buscar libros...">
                    <button type="button" id="buscarButton" class="btn btn-primary m-2">Buscar</button>
                </div>

                <div class="row" id="resultadosBusqueda">
                    <!-- Resultados de la búsqueda se mostrarán aquí -->
                </div>

                <label>Libros a prestar:</label>

                <table class="table table-striped" id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Libros seleccionados se agregarán aquí dinámicamente -->
                    </tbody>
                </table>


                <div id="librosSeleccionados">
                    <!-- Libros seleccionados se agregarán aquí dinámicamente -->
                </div>

                <x-primary-button class="btn btn-primary">
                    {{ __('Guardar') }}
                </x-primary-button>

            </form>

            @elseif(Auth::user()->role->isCliente())
            <form action="{{ route('cliente-prestamos.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="fecha_prestamo">Fecha de Préstamo</label>
                    <input type="date" class="form-control @error('fecha_prestamo') is-invalid @enderror" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo') }}" required>
                    @error('fecha_prestamo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" class="form-control @error('fecha_devolucion') is-invalid @enderror" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion') }}" required>
                    @error('fecha_devolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="buscarQuery">Buscar Libros:</label>
                    <input type="text" name="query" id="buscarQuery" class="form-control mr-2" placeholder="Buscar libros...">
                    <button type="button" id="buscarButton" class="btn btn-primary m-2">Buscar</button>
                </div>

                <div class="row" id="resultadosBusqueda">
                    <!-- Resultados de la búsqueda se mostrarán aquí -->
                </div>

                <label>Libros a prestar:</label>

                <table class="table table-striped" id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Libros seleccionados se agregarán aquí dinámicamente -->
                    </tbody>
                </table>


                <div id="librosSeleccionados">
                    <!-- Libros seleccionados se agregarán aquí dinámicamente -->
                </div>

                <x-primary-button class="btn btn-primary">
                    {{ __('Guardar') }}
                </x-primary-button>

            </form>
            @endif
        </div>
    </div>
</div>


<script>
    document.getElementById('buscarButton').addEventListener('click', function() {
        var query = document.getElementById('buscarQuery').value.toLowerCase();
        console.log('Buscando libros para:', query);

        fetch(`/libro/buscar-libros?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos recibidos:', data);
                var resultados = document.getElementById('resultadosBusqueda');
                resultados.innerHTML = '';

                if (data.length === 0) {
                    resultados.innerHTML = '<p>No se encontraron libros.</p>';
                } else {
                    data.forEach(libro => {
                        var titulo = libro.titulo.toLowerCase();
                        if (titulo.includes(query)) {
                            var card = document.createElement('div');
                            card.className = 'col-md-6 mb-3';
                            card.innerHTML = `
                                <div class="card flex-row">
                                    <img src="${libro.img_url}" class="card-img-left" alt="${libro.titulo}" style="width: 150px; height: auto;">
                                    <div class="card-body">
                                        <h5 class="card-title">${libro.titulo}</h5>
                                        <p class="card-text">${libro.descripcion}</p>
                                        <p class="text-muted">Disponibles: ${libro.disponibles}</p>
                                        <div class="form-group">
                                            <label for="cantidad-${libro.id}">Cantidad:</label>
                                            <input type="number" id="cantidad-${libro.id}" class="form-control" min="1" max="${libro.disponibles}" value="1">
                                        </div>
                                        <a href="#" class="btn btn-primary add-to-prestamo" data-libro-id="${libro.id}" data-libro-titulo="${libro.titulo}" data-libro-disponibles="${libro.disponibles}">Agregar a Préstamo</a>
                                    </div>
                                </div>
                            `;
                            resultados.appendChild(card);
                        }
                    });

                    document.querySelectorAll('.add-to-prestamo').forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            const libroId = this.getAttribute('data-libro-id');
                            const titulo = this.getAttribute('data-libro-titulo');
                            const disponibles = parseInt(this.getAttribute('data-libro-disponibles'));
                            const cantidad = parseInt(document.getElementById(`cantidad-${libroId}`).value);

                            if (cantidad > disponibles) {
                                alert(`La cantidad de libros solicitada (${cantidad}) supera a la cantidad disponible (${disponibles}).`);
                            } else {
                                var librosSeleccionados = document.getElementById('librosSeleccionados');
                                librosSeleccionados.innerHTML += `
                                    <input type="hidden" name="libros[${libroId}][libro_id]" value="${libroId}">
                                    <input type="hidden" name="libros[${libroId}][cantidad]" value="${cantidad}">
                                `;

                                var tablaLibros = document.getElementById('tablaLibros').getElementsByTagName('tbody')[0];
                                var fila = tablaLibros.insertRow();
                                var celdaTitulo = fila.insertCell(0);
                                var celdaCantidad = fila.insertCell(1);
                                celdaTitulo.textContent = titulo;
                                celdaCantidad.textContent = cantidad;
                            }
                        });
                    });
                }
            })
            .catch(error => console.error('Error al buscar libros:', error));
    });
    </script>



@endsection
