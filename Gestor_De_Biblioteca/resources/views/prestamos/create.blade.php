@extends('layouts.Admindashboard')

@section('content')
<div class="container mt-4">
    <a href="{{route('prestamos.index')}}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Atrás
    </a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Crear Nuevo Préstamo</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="fecha_prestamo">Fecha de Préstamo</label>
                    <input type="date" class="form-control @error('fecha_prestamo') is-invalid @enderror" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo') }}" required>
                    @error('fecha_prestamo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" class="form-control @error('fecha_devolucion') is-invalid @enderror" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion') }}" required>
                    @error('fecha_devolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h4>Libros a prestar:</h4>
                <div class="container">
                    <div class="row">
                        @foreach ($libros as $libro)
                            <div class="col-md-6 mb-3">
                                <div class="form-group p-3 rounded border shadow-sm bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="font-weight-bold mb-0">{{ $libro->titulo }}</label>
                                        <small class="text-muted">
                                            ({{ $libro->disponibles }} {{ $libro->disponibles == 1 ? 'disponible' : 'disponibles' }})
                                        </small>
                                    </div>
                                    <input type="hidden" name="libros[{{ $loop->index }}][libro_id]" value="{{ $libro->id }}">
                                    <input type="number" 
                                        class="form-control mt-2 w-50 @error('libros.'.$loop->index.'.cantidad') is-invalid @enderror" 
                                        name="libros[{{ $loop->index }}][cantidad]" 
                                        min="1" 
                                        max="{{ $libro->disponibles }}"
                                        value="{{ old('libros.' . $loop->index . '.cantidad') }}"
                                        placeholder="Cantidad">
                                    @error('libros.'.$loop->index.'.cantidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <x-primary-button class="btn btn-primary">
                    {{ __('Guardar') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>
@endsection
