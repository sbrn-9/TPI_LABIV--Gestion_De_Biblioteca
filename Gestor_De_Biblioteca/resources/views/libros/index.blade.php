@extends('layouts.AdminDashboard')
@section('title')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Libros</h1>

    <a href="{{route('libros.create')}}" class="btn btn-primary m-2">
        Nuevo Libro
    </a>
    <button id="detailButton" class="btn btn-secondary m-2" disabled>
        Detalles
    </button>
    <button id="editButton" class="btn btn-info m-2" disabled>
        Editar
    </button>
    <button id="deleteButton" class="btn btn-danger m-2" disabled>
        Eliminar
    </button>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Descripción</th>
                            <th>Código</th>
                            <th>Cantidad</th>
                            <th>Disponibilidad</th>
                            <th>Categoría</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($libros as $libro)
                        <tr>
                            <td class="text-center"><input type="radio" name="selectedLibro" value="{{ $libro->id }}" onclick="toggleButtons(this)"></td>
                            <td>{{ $libro->id }}</td>
                            <td>{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->descripcion }}</td>
                            <td>{{ $libro->codigo }}</td>
                            <td>{{ $libro->cantidad }}</td>
                            <td>{{ $libro->disponibles}}</td>
                            <td>{{ $libro->categoria->nombre }}</td>
                            
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    let lastCheckedRadio = null;

    function toggleButtons(radio) {
        const detailButton = document.getElementById('detailButton');
        const editButton = document.getElementById('editButton');
        const deleteButton = document.getElementById('deleteButton');

        if (lastCheckedRadio === radio) {
            radio.checked = false;
            lastCheckedRadio = null;
            detailButton.disabled = true;
            editButton.disabled = true;
            deleteButton.disabled = true;
        } else {
            lastCheckedRadio = radio;
            const libroId = radio.value;
            detailButton.disabled = false;
            editButton.disabled = false;
            deleteButton.disabled = false;

            detailButton.onclick = () => window.location.href = `{{ url('libros') }}/${libroId}`;
            editButton.onclick = () => window.location.href = `{{ url('libros') }}/${libroId}/edit`;
            deleteButton.onclick = () => window.location.href = `{{ url('libros') }}/${libroId}/destroy`;
        }
    }
</script>

@endsection
