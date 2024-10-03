@extends('layouts.admindashboard')
@section('content')
<h1>{{$libro->titulo}}</h1>
<h2>{{$libro->categoria->nombre}}</h2>
<h4>{{$libro->descripcion}}</h4>
<h4>cantidad:{{$libro->cantidad}}</h4>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div id="boton-editar">
    <div>
        <a href="{{route('libros.edit', ['libro' => $libro->id])}}" class="btn btn-primary">
            Editar
        </a>
        <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este libro?');">
            @csrf
            @method('DELETE') <!-- Esto es crucial para que funcione -->
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>

        <!-- a href="{//{route('prestamos.create') }}" class="btn btn-primary">
            Pedir Préstamo
        </-a-->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


    </div>
</div>
@endsection