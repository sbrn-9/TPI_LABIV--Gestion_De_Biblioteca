@extends('layouts.Admindashboard')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Crear Nuevo Préstamo</h2>
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

                <h4>Libros a prestar:</h4>
                <div id="librosContainer"></div>
                <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#libroModal" id="addLibroButton">Agregar Libro</button>
                
                <br>

                <x-primary-button class="btn btn-primary" id="guardarButton">
                    {{ __('Guardar') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>

<!--Libro Modal -->
<div class="modal fade" id="libroModal" tabindex="-1" role="dialog" aria-labelledby="libroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="libroModalLabel">Agregar Libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select id="libroSelect" class="form-control mb-3">
                
                </select>
                <input type="number" id="cantidadInput" class="form-control mb-3 @error('libros.*.cantidad') is-invalid @enderror" min="1" placeholder="Cantidad" required>
                <div id="cantidadError" class="text-danger" style="display: none;">La cantidad debe ser al menos 1.</div>
                @error('libros.*.cantidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="noLibrosMessage" class="text-danger" style="display: none;">No hay libros disponibles para agregar.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="addLibro()">Agregar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editCantidadModal" tabindex="-1" role="dialog" aria-labelledby="editCantidadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCantidadModalLabel">Editar Cantidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="editLibroInfo" class="mb-3"></p>
                <input type="number" id="editCantidadInput" class="form-control mb-3" min="1" placeholder="Cantidad" required>
                <div id="editCantidadError" class="text-danger" style="display: none;">La cantidad debe ser igual o menos que el disponible y al menos 1.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="saveCantidad()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    const libros = @json($libros);
    let libroIndex = 0;
    const addedLibros = new Set();
    let currentEditLibroId = null;
    let currentEditDisponibles = 0;
    let currentEditLibroTitulo = '';

    function populateLibroSelect() {
        const libroSelect = document.getElementById('libroSelect');
        libroSelect.innerHTML = '';
        let hasOptions = false;
        libros.forEach(libro => {
            if (!addedLibros.has(libro.id)) {
                const option = document.createElement('option');
                option.value = libro.id;
                option.text = `${libro.titulo} (Disponibles: ${libro.disponibles})`;
                libroSelect.appendChild(option);
                hasOptions = true;
            }
        });
        document.getElementById('noLibrosMessage').style.display = hasOptions ? 'none' : 'block';
    }

    function addLibro() {
        const libroSelect = document.getElementById('libroSelect');
        const cantidadInput = document.getElementById('cantidadInput');
        const selectedLibroId = libroSelect.value;
        const selectedLibroText = libroSelect.options[libroSelect.selectedIndex].text;
        const cantidad = parseInt(cantidadInput.value);
        const disponibles = parseInt(selectedLibroText.match(/\d+/)[0]);

        if (isNaN(cantidad)) {
            alert('La cantidad es requerida.');
            return;
        }

        if (cantidad < 1) {
            document.getElementById('cantidadError').style.display = 'block';
            return;
        }
        document.getElementById('cantidadError').style.display = 'none';

        if (selectedLibroId && cantidad >= 1) {
            if (cantidad > disponibles) {
                alert('La cantidad no puede ser mayor que el disponible.');
                return;
            }

            const container = document.getElementById('librosContainer');
            const libroDiv = document.createElement('div');
            libroDiv.classList.add('d-flex', 'align-items-center', 'mb-2');
            libroDiv.innerHTML = `
                <input type="hidden" name="libros[${libroIndex}][libro_id]" value="${selectedLibroId}">
                <input type="hidden" name="libros[${libroIndex}][cantidad]" value="${cantidad}">
                <span class="mr-2">${selectedLibroText.split(' (')[0]} - Cantidad: ${cantidad}</span>
                <button type="button" class="btn btn-warning btn-sm mr-2" onclick="editCantidad(${selectedLibroId}, '${libroSelect.options[libroSelect.selectedIndex].text.split(' (')[0]}', ${disponibles}, this)">Editar</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeLibro(this, ${selectedLibroId})">Eliminar</button>
            `;
            container.appendChild(libroDiv);

            addedLibros.add(parseInt(selectedLibroId));
            libroIndex++;
            $('#libroModal').modal('hide');
            populateLibroSelect();
        }
    }

    function editCantidad(libroId, libroTitulo, disponibles, button) {
        currentEditLibroId = libroId;
        currentEditDisponibles = disponibles;
        currentEditLibroTitulo = libroTitulo;
        const cantidadInput = button.parentElement.querySelector('input[name^="libros"][name$="[cantidad]"]');
        document.getElementById('editCantidadInput').value = cantidadInput.value;
        document.getElementById('editLibroInfo').textContent = `Editando: ${libroTitulo} (Disponibles: ${disponibles})`;
        $('#editCantidadModal').modal('show');
    }

    function saveCantidad() {
        const newCantidad = parseInt(document.getElementById('editCantidadInput').value);

        if (isNaN(newCantidad)) {
            document.getElementById('editCantidadError').textContent = 'La cantidad es requerida.';
            document.getElementById('editCantidadError').style.display = 'block';
            return;
        }

        if (newCantidad > currentEditDisponibles || newCantidad < 1) {
            document.getElementById('editCantidadError').style.display = 'block';
            return;
        }
        document.getElementById('editCantidadError').style.display = 'none';

        document.querySelectorAll('#librosContainer input[name^="libros"][name$="[libro_id]"]').forEach((input, index) => {
            if (parseInt(input.value) === currentEditLibroId) {
                const cantidadInput = document.querySelectorAll('#librosContainer input[name^="libros"][name$="[cantidad]"]')[index];
                cantidadInput.value = newCantidad;
                cantidadInput.nextElementSibling.textContent = `${currentEditLibroTitulo} - Cantidad: ${newCantidad}`;
            }
        });

        $('#editCantidadModal').modal('hide');
    }

    function removeLibro(button, libroId) {
        const libroDiv = button.parentElement;
        libroDiv.remove();
        addedLibros.delete(libroId);
        populateLibroSelect();
    }

    document.addEventListener('DOMContentLoaded', populateLibroSelect);
</script>
@endsection
