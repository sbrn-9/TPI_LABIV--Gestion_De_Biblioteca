@extends('layouts.admindashboard')

@section('content')
<div class="container mt-4">
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Volver
    </a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Préstamo ID: {{$prestamo->id}}</h1>
            <h5 class="card-subtitle text-muted">Cliente: {{$prestamo->propietario->name}}</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Estado:</strong> {{$prestamo->estado->name}}</p>
            <p class="card-text"><strong>Fecha de Préstamo:</strong> {{$prestamo->fecha_prestamo->format('d-M-y')}}</p>
            <p class="card-text"><strong>Fecha de Devolución:</strong> {{$prestamo->fecha_devolucion->format('d-M-y')}}</p>
            <h4>Libros:</h4>
            <ul>
                @if ($prestamoLibrosInfo->isEmpty())
                    <li>No hay libros prestados.</li>
                @else
                    @foreach ($prestamoLibrosInfo as $info)
                        <li>{{$info->libro->titulo}} : {{$info->cantidad}}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    @if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
    @endif
    @if($prestamo->estado->isPendiente())
    <div class="mt-4 d-flex justify-content-between">
        <a href="{{route('prestamos.edit', ['prestamo' => $prestamo->id])}}" class="btn btn-primary" >
            Editar
        </a>
        @if (Auth::user()->role->isAdmin())
            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este préstamo?');">
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        @endif
    </div>
    @elseif($prestamo->estado->isCerrado())
        Ya no se puede Editar Pero puede pedir otro igual.
        <div class="mt-4 d-flex justify-content-between">
            <a href="#" class="btn btn-primary" >
                Repetir Préstamo
            </a>
        </div>

    @endif

</div>
@endsection
