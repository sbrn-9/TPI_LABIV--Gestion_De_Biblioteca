@extends('layouts.AdminDashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Lista de Préstamos</h1>


    @if (Auth::user()->role->isAdmin())
        <a href="{{route('prestamos.create')}}" class="btn btn-primary m-2">
            <i class="fas fa-plus"></i> Nuevo Préstamo
        </a>
    @elseif (Auth::user()->role->isCliente())
    <a href="{{route('cliente-prestamos.create')}}" class="btn btn-primary m-2">
        <i class="fas fa-plus"></i> Nuevo Préstamo
    </a>
    @endif

    <button id="detailButton" class="btn btn-secondary m-2" disabled>
        <i class="fas fa-eye"></i> Detalles
    </button>
    <button id="editButton" class="btn btn-info m-2" disabled>
        <i class="fas fa-edit"></i> Editar
    </button>

    <form id="deleteForm" action="" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <button id="deleteButton" class="btn btn-danger m-2" disabled>
        <i class="fas fa-trash"></i> Eliminar
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
                            <th>Acciones</th>
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
                            <td>
                                @if(Auth::check() && Auth::user()->role->isAdmin())
                                <form action="{{ route('prestamos.updateEstado', $prestamo->id) }}" method="POST" style="display:flex;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="activo">
                                    <button type="submit" class="btn btn-success m-2">
                                        <i class="fas fa-check"> Activar</i>
                                    </button>
                                </form>

                                <form action="{{ route('prestamos.updateEstado', $prestamo->id) }}" method="POST" style="display:flex;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="cerrado">
                                    <button type="submit" class="btn btn-danger m-2">
                                        <i class="fas fa-times"> Cerrar</i>
                                    </button>
                                </form>
                                @endif

                                @if(Auth::check() && Auth::user()->role->isCliente())

                                <form action="{{ route('cliente-prestamos.updateEstado', $prestamo->id) }}" method="POST" style="display:flex;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="cancelado">
                                    <button type="submit" class="btn btn-warning m-2">
                                        <i class="fas fa-ban"></i> Cancelar
                                    </button>
                                </form>
                                @endif




                </td>

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
    const deleteForm = document.getElementById('deleteForm');

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
            deleteButton.onclick = () => {
                if (confirm('¿Estás seguro de que deseas eliminar este prestamo?')) {
                deleteForm.action = `{{ url('prestamos') }}/${prestamoId}`;
                deleteForm.submit();
                }
            };
        }
        }
</script>

@endsection
