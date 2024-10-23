@extends('layouts.Admindashboard')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Prestamo</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Por las Barbas de mí tía Petuña/ Algo fue mal...</strong><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('prestamos.store') }}" method="POST">
            @csrf

            <!-- Fecha de prestamo -->
            <div class="form-group">
                <label for="fecha_prestamo">Fecha de prestamo</label>
                <input type="date" class="form-control" id="fecha_prestamo" name="fecha_prestamo" required>
            </div>

            <!-- Fecha de devolución -->
            <div class="form-group">
                <label for="fecha_devolucion">Fecha de Devolución</label>
                <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" required>
            </div>

            <!-- Libros -->
            <h4>Libros a prestar:</h4>
            @foreach ($libros as $libro)
                <div class="form-group">
                    <label>{{ $libro->titulo }} (Disponibles: {{ $libro->disponibles }})</label>
                    <input
                    type="hidden"
                    name="libros[{{ $loop->index }}][libro_id]"
                    value="{{ $libro->id }}"
                    >
                    <input
                    type="number"
                    class="form-control"
                    name="libros[{{ $loop->index }}][cantidad]"
                    min="1"
                    max="{{ $libro->disponibles }}"
                    placeholder="Disponibles: {{ $libro->disponibles }}">
                </div>
            @endforeach

            <x-primary-button class="btn btn-primary">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>

    </div>
@endsection
