@extends('layouts.AdminDashboard')
@section('title')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Detalles del Usuario</h1>

    <a href="{{ route('users.index') }}" class="btn btn-secondary m-2">
        <i class="fas fa-arrow-left"></i> Volver
    </a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Rol</th>
                            <td>
                                <span class="badge text-white {{ $user->role == 0 ? 'bg-success' : 'bg-primary' }}">
                                    {{ $user->role == 0 ? 'Administrador' : 'Cliente' }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('users.edit', $user) }}" class="btn btn-info">
            <i class="fas fa-edit"></i> Editar Usuario
        </a>
    </div>

</div>

@endsection
