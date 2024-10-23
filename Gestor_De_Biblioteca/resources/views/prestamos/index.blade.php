@extends('layouts.AdminDashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Lista de Préstamos</h1>

    <a href="{{route('prestamos.create')}}" class="btn btn-primary m-2">
        Nuevo Préstamo
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
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Fecha Préstamo</th>
                            <th>Fecha Cancelacion</th>
                            <th>Fecha Devolución</th>
                            <th>Fecha Modificacion</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($prestamos as $prestamo)
                        <tr>
                            <td class="text-center"><input type="radio" name="selectedPrestamo" value="{{ $prestamo->id }}" onclick="toggleButtons(this)"></td>
                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->propietario->name }}</td>
                            <td>{{ $prestamo->estado->name }}</td>
                            <td>{{ $prestamo->fecha_prestamo }}</td>
                            <td>{{ $prestamo->canceled_at }}</td>
                            <td>{{ $prestamo->fecha_devolucion }}</td>
                            <td>{{ $prestamo->updated_at}}</td>
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
            const prestamoId = radio.value;
            detailButton.disabled = false;
            editButton.disabled = false;
            deleteButton.disabled = false;

            detailButton.onclick = () => window.location.href = `{{ url('prestamos') }}/${prestamoId}`;
            editButton.onclick = () => window.location.href = `{{ url('prestamos') }}/${prestamoId}/edit`;
            deleteButton.onclick = () => window.location.href = `{{ url('prestamos') }}/${prestamoId}/destroy`;
        }
    }
</script>

@endsection
