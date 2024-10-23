@extends('layouts.admindashboard')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{$libro->titulo}}</h1>
            <h5 class="card-subtitle text-muted">{{$libro->categoria->nombre}}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{{$libro->descripcion}}</p>
            <p class="card-text"><strong>Cantidad:</strong> {{$libro->cantidad}}</p>
        </div>
    </div>

    @if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
    @endif

    <div class="mt-4 d-flex justify-content-between">
        <a href="{{route('libros.edit', ['libro' => $libro->id])}}" class="btn btn-primary">
            Editar
        </a>
        <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este libro?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</div>
@endsection
