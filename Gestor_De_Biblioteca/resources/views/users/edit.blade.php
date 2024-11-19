@extends('layouts.AdminDashboard')
@section('title', 'ALBA Library-Editar Usuario')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Editar Usuario</h1>

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

    <form action="{{ route('users.update', $user) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            <i class="fas fa-save"></i> Actualizar Usuario
        </button>
    </form>

</div>

@endsection
