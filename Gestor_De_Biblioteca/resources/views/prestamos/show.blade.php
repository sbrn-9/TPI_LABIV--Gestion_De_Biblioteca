@extends('layouts.admindashboard')
@section('title','ALBA Library-Mostrar Prestamos')
@section('content')
<div class="container mt-4">
    @if(Auth::user()->role->isAdmin())
        <a href="{{ route('prestamos.index') }}" class="btn btn-secondary mb-3">
            <i class="fa fa-chevron-left"></i> Volver
        </a>

    @elseif(Auth::user()->role->isCliente())
        <a href="{{ route('cliente-prestamos.index') }}" class="btn btn-secondary mb-3">
            <i class="fa fa-chevron-left"></i> Volver
        </a>
    @endif

    <div class="card">
        <div class="card-header">
            <h1 class="card-subtitle">Préstamo ID: {{$prestamo->id}}</h1>
        </div>
        <div class="card-body">
            <p class="card-text"> <strong>Cliente: </strong>{{$prestamo->propietario->name}}</p>
            <p class="card-text"><strong>Estado:</strong> {{$prestamo->estado->name}}</p>
            <p class="card-text"><strong>Fecha de Préstamo:</strong> {{$prestamo->fecha_prestamo->format('d-M-y')}}</p>
            <p class="card-text"><strong>Fecha de Devolución:</strong> {{$prestamo->fecha_devolucion->format('d-M-y')}}</p>

            <h4>Libros:</h4>

            <div class="row">
                @if ($prestamoLibrosInfo->isEmpty())
                <div class="col-md-12"> <div class="alert alert-info">No hay libros prestados.</div>
            </div>
                @else
                @foreach ($prestamoLibrosInfo as $info)
                <div class="col-12 mb-3">
                    <div class="card flex-row">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">{{$info->libro->titulo}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{$info->libro->autor}}</h6>
                                <p class="card-text"><strong>Cantidad:</strong> {{$info->cantidad}}</p>
                            </div>
                            @if($info->libro->img_url)
                            <img src="{{ $info->libro->img_url }}" alt="Imagen del libro {{ $info->libro->titulo }}" class="img-fluid rounded" style="max-height: 100px;">
                            @else
                            <div class="alert alert-info">No hay imagen del libro disponible</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>


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
            <i class="fas fa-edit"></i> Editar
        </a>
        @if (Auth::user()->role->isAdmin())
            <form action="{{ route('prestamos.activar', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de activar este préstamo?');">
                @csrf
                @method('PATCH')

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i>
                    Activar
                </button>
            </form>
            <form action="{{ route('prestamos.cancelar', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de cancelar este préstamo?');">
                @csrf
                @method('PATCH')
            <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i> Cancelar</button>
            </form>
        @elseif(Auth::user()->role->isCliente())
            <form action="{{ route('cliente-prestamos.cancelar', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de cancelar este préstamo?');">
                @csrf
                @method('PATCH')
            <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i> Cancelar</button>
            </form>
        @endif
    </div>
    @elseif($prestamo->estado->isActivo() && Auth::user()->role->isAdmin())
        <form action="{{ route('prestamos.cerrar', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de cerrar este préstamo?');">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn btn-danger">
                <i class="fa fa-times"></i>
                Cerrar
            </button>
        </form>

    @endif

</div>
@endsection
