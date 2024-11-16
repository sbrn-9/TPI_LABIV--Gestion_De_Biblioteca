@extends('layouts.AdminDashboard')
@section('title')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Usuarios</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary m-2">
        <i class="fas fa-plus"></i> Nuevo Usuario
    </a>
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
                            <th class="text-center" style="width: 30px;">#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th class="text-center">Rol</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="text-center align-middle">
                                <input type="radio" name="selectedUser" value="{{ $user->id }}" onclick="toggleButtons(this)">
                            </td>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="text-center align-middle">
                                    {{ $user->role->getNombreTipo() }}
                            </td>
                          
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
            const userId = radio.value;
            detailButton.disabled = false;
            editButton.disabled = false;
            deleteButton.disabled = false;

            detailButton.onclick = () => window.location.href = `{{ url('users') }}/${userId}`;
            editButton.onclick = () => window.location.href = `{{ url('users') }}/${userId}/edit`;
            deleteButton.onclick = () => {
                if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                    deleteForm.action = `{{ url('users') }}/${userId}`;
                    deleteForm.submit();
                }
            };
        }
    }

    function confirmDelete(userId) {
        if (confirm('¿Está seguro que desea eliminar este usuario?')) {
            document.getElementById('deleteForm').action = `{{ url('users') }}/${userId}`;
            document.getElementById('deleteForm').submit();
        }
    }
</script>

@endsection
