@extends('layouts.AdminDashboard')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Prestamo</h2>

        <form action="{{ route('crearprestamo.store') }}" method="POST">
            @csrf

            <!-- Fecha de retiro -->
            <div class="form-group">
                <label for="fecha_retiro">Fecha de Retiro</label>
                <input type="date" class="form-control" id="fecha_retiro" name="fecha_retiro" required>
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
                    <label>{{ $libro->titulo }} (Disponibles: {{ $libro->disponibilidad }})</label>
                    <input type="hidden" name="libros[{{ $loop->index }}][libro_id]" value="{{ $libro->id }}">
                    <input type="number" class="form-control" name="libros[{{ $loop->index }}][cantidad]" min="1" max="{{ $libro->disponibilidad }}" placeholder="Cantidad">
                </div>
            @endforeach

            <x-primary-button class="btn btn-primary">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>

    </div>
@endsection
