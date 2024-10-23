@extends('layouts.AdminDashboard')

@section('content')
<div class="container mt-4">
    <a href="{{route('prestamos.index')}}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Atrás
    </a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editar Préstamo</h1>
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

            <form action="{{ route('prestamos.update', ['prestamo' => $prestamo->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="fecha_prestamo">Fecha de Préstamo</label>
                    <input type="date" class="form-control @error('fecha_prestamo') is-invalid @enderror" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo', $prestamo->fecha_prestamo->format('Y-m-d')) }}" required>
                    @error('fecha_prestamo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" class="form-control @error('fecha_devolucion') is-invalid @enderror" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion', $prestamo->fecha_devolucion->format('Y-m-d')) }}" required>
                    @error('fecha_devolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h4>Libros:</h4>
                <div class="container">
                    <div class="row">
                        @foreach ($prestamoLibrosInfo as $info)
                            <div class="col-md-6 mb-3">
                                <div class="form-group p-3 rounded border shadow-sm bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="font-weight-bold mb-0">{{ $info->libro->titulo }}</label>
                                        <small class="text-muted">({{ $info->cantidad }}
                                            {{($info->cantidad == 1 ? ' pedido' : ' pedidos')
                                            . ($info->libro->disponibles == 1 ? ', 1 disponible'
                                            : ', ' . $info->libro->disponibles . ' disponibles')}} )
                                        </small>
                                    </div>
                                    <input type="hidden" name="libros[{{ $loop->index }}][libro_id]" value="{{ $info->libro->id }}">
                                    <input type="number" class="form-control mt-2 w-50 @error('libros.'.$loop->index.'.cantidad') is-invalid @enderror" name="libros[{{ $loop->index }}][cantidad]" min="0" placeholder="Otra Cantidad" value="{{ old('libros.' . $loop->index . '.cantidad', $info->cantidad) }}">
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
