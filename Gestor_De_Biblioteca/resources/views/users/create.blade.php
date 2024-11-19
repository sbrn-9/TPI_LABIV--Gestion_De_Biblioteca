@extends('layouts.AdminDashboard')
@section('title', 'ALBA Library-Crear Usuario')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Crear Usuario</h1>

    <a href="{{ route('users.index') }}" class="btn btn-secondary m-2">
        <i class="fas fa-arrow-left"></i> Volver
    </a>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">
        </div>

        <div class="form-group">
            <label for="role">Rol</label>
            <select name="role" id="role" class="form-control">
                <option value="1">Cliente</option>
                <option value="0">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            <i class="fas fa-save"></i> Crear Usuario
        </button>
    </form>

</div>

@endsection
