@extends('layouts.AdminDashboard')

@section('content')
    <div class="container">
        <h2>Editar Prestamo</h2>
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
        <form action="{{ route('prestamos.update', ['prestamo' => $prestamo->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Fecha de prestamo -->
            <div class="form-group">
                <label for="fecha_prestamo">Fecha de Prestamo</label>
                <input type="date" class="form-control" id="fecha_prestamo" name="fecha_prestamo" value="{{old('fecha_prestamo', $prestamo->fecha_prestamo->format('Y-m-d'))}}" required>
            </div>

            <!-- Fecha de devolución -->
            <div class="form-group">
                <label for="fecha_devolucion">Fecha de Devolución</label>
                <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" value="{{old('fecha_devolucion', $prestamo->fecha_devolucion->format('Y-m-d'))}}" required>
            </div>

            <!-- Libros -->
            {{-- <h4>Libros:</h4>
            @foreach ($prestamo->libros as $libro)
                <div class="form-group">
                    <label>{{ $libro->titulo }} ({{ $libro->cantidad }})</label>
                    <input type="hidden" name="libros[{{ $loop->index }}][libro_id]" value="{{ $libro->id }}">
                    <input type="number" class="form-control" name="libros[{{ $loop->index }}][cantidad]" min="0ñ" max="{{ $libro->disponibles }}" placeholder="Cantidad">
                </div>
            @endforeach --}}
            <div class="container">
                <h4 class="mb-4">Libros:</h4>
                <div class="row">
                    @foreach ($prestamoLibrosInfo as $info)
                        <div class="col-md-6 mb-3">
                            <div class="form-group p-3 rounded border shadow-sm bg-light"> <!-- Caja con fondo claro y sombra -->
                                <div class="d-flex justify-content-between align-items-center"> <!-- Alinear en una fila -->
                                    <label class="font-weight-bold mb-0">{{ $info->libro->titulo }}</label>
                                    <small class="text-muted">({{ $info->cantidad}}
                                        {{($info->cantidad == 1 ? ' pedido' : ' pedidos')
                                        . ($info->libro->disponibles == 1 ? ', 1 disponible'
                                        : ', ' . $info->libro->disponibles . ' disponibles')}} )
                                    </small>
                                </div>
                                <input type="hidden" name="libros[{{ $loop->index }}][libro_id]" value="{{ $info->libro->id }}">
                                <input
                                    type="number"
                                    class="form-control mt-2 w-50"
                                    style="width: auto;"
                                    name ="libros[{{ $loop->index }}][cantidad]"
                                    min="0"
                                    placeholder="Otra Cantidad"
                                    value="{{ old('libros.' . $loop->index . '.cantidad', $info->cantidad) }}"
                                >
                                <button class="btn btn-danger">
                                    Quitar
                                </button>
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
@endsection
