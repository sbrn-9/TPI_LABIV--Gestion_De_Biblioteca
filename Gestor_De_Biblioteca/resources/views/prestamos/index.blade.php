@extends('layouts.AdminDashboard')
@section('title','ALBA Library-Prestamos')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Lista de Préstamos</h1>
    <a href="{{route('prestamos.create')}}" class="btn btn-primary m-2">
        <i class="fas fa-plus"></i> Nuevo Préstamo
    </a>
    <button id="detailButton" class="btn btn-secondary m-2" disabled>
        <i class="fas fa-eye"></i> Detalles
    </button>
    <button id="editButton" class="btn btn-info m-2" disabled>
        <i class="fas fa-edit"></i> Editar
    </button>

    @if(auth()->user()->role->isAdmin())
        <form id="deleteForm" action="" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
        <button id="deleteButton" class="btn btn-danger m-2" disabled>
            <i class="fas fa-trash"></i> Eliminar
        </button>
    @endif

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
                        @isset($prestamos)
                        @foreach ($prestamos as $prestamo)
                        <tr>
                            <td class="text-center">
                                <input type="radio" name="selectedPrestamo" value="{{ $prestamo->id }}" data-estado="{{ $prestamo->estado }}" onclick="toggleButtons(this, {{ Auth::user()->role->isAdmin() ? 'true' : 'false' }})">
                            </td>
                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->propietario->name }}</td>
                            <td>{{ $prestamo->estado->name }}</td>
                            <td>{{ $prestamo->fecha_prestamo }}</td>
                            <td>{{ $prestamo->canceled_at }}</td>
                            <td>{{ $prestamo->fecha_devolucion }}</td>
                            <td>{{ $prestamo->updated_at }}</td>
                            <td>
                                @if(auth()->user()->role->isAdmin() && $prestamo->estado->isPendiente())
                                <form action="{{ route('prestamos.activar', $prestamo->id) }}" method="POST" style="display:flex;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="1">
                                    <button type="submit" class="btn btn-success btn-icon-split m-2">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Activar</span>
                                    </button>
                                </form>
                                <form action="{{ route('prestamos.cancelar', $prestamo->id) }}" method="POST" style="display:flex;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="4">
                                    <button type="submit" class="btn btn-warning btn-icon-split m-2" onclick="return confirm('¿Estás seguro de que deseas cancelar este préstamo?')">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Cancelar</span>
                                    </button>
                                </form>
                                @endif
                                @if ($prestamo->estado->isActivo() || $prestamo->estado->isAtrasado())
                                @if(auth()->user()->role->isAdmin())
                                    <form action="{{ route('prestamos.cerrar', $prestamo->id) }}" method="POST" style="display:flex;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="estado" value="2">
                                        <button type="submit" class="btn btn-danger btn-icon-split m-2">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="text">Cerrar</span>
                                        </button>
                                    </form>
                                @endif
                                @endif
                                @if(auth()->user()->role->isCliente() && $prestamo->estado->isPendiente())
                                <form action="{{ route('cliente-prestamos.cancelar', $prestamo->id) }}" method="POST" style="display:flex;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="4">
                                    <button type="submit" class="btn btn-warning btn-icon-split m-2" onclick="return confirm('¿Estás seguro de que deseas cancelar este préstamo?')">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Cancelar</span>
                                    </button>
                                </form>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    let lastCheckedRadio = null;

    function toggleButtons(radio, isAdmin) {
        const detailButton = document.getElementById('detailButton');
        const editButton = document.getElementById('editButton');
        const deleteButton = document.getElementById('deleteButton');
        const deleteForm = document.getElementById('deleteForm');

        if (lastCheckedRadio === radio) {
            radio.checked = false;
            lastCheckedRadio = null;
            detailButton.disabled = true;
            if (editButton) editButton.disabled = true;
            if (deleteButton) deleteButton.disabled = true;
        } else {
            lastCheckedRadio = radio;
            const prestamoId = radio.value;
            const prestamoEstado = radio.getAttribute('data-estado');
            detailButton.disabled = false;
            if (editButton) editButton.disabled = false;
            if (deleteButton) deleteButton.disabled = false;

            if (isAdmin) {
                detailButton.onclick = () => window.location.href = `{{ url('prestamos') }}/${prestamoId}`;
                editButton.onclick = () => window.location.href = `{{ url('prestamos') }}/${prestamoId}/edit`;
            } else {
                console.log("Es cliente")
                detailButton.onclick = () => window.location.href = `{{ url('cliente/mis-prestamos') }}/${prestamoId}`;
                if (editButton) editButton.onclick = () => window.location.href = `{{ url('cliente/mis-prestamos') }}/${prestamoId}/edit`;
            }

            if (deleteButton) deleteButton.onclick = () => {
                if (prestamoEstado === 'activo' || prestamoEstado === 'cerrado') {
                    alert(`No se puede cancelar el préstamo porque está en estado ${prestamoEstado}.`);
                } else {
                    if (confirm('¿Estás seguro de que deseas eliminar este préstamo?')) {
                        if (isAdmin) {
                            deleteForm.action = `{{ url('prestamos') }}/${prestamoId}`;
                        } else {
                            deleteForm.action = `{{ url('cliente/prestamos') }}/${prestamoId}`;
                        }
                        deleteForm.submit();
                    }
                }
            };
        }
    }
    </script>


@endsection


@section('alerts')
    @isset($alerts)
    @if(!is_null($alerts))
    @if (count($alerts) > 0)
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">{{count($alerts)}}+</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Notificaciones
        </h6>
        @foreach($alerts as $alert)
        @if(Auth::user()->role->isAdmin())
        <a class="dropdown-item d-flex align-items-center" href="{{route('prestamos.show', $alert->id)}}">
        @else
        <a class="dropdown-item d-flex align-items-center" href="{{route('cliente-prestamos.show', $alert->id)}}">
        @endif
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">{{$alert->fecha_devolucion}}</div>
                <span class="font-weight-bold">Préstamo Próximo a Vencer</span>
            </div>
        </a>
        @endforeach

    </div>
    </li>
    @endif
    @endif
    @endisset
@endsection
