@extends('layouts.admindashboard')
@section('content')
<h1>id: {{$prestamo->id}}</h1>
<h1>Fecha de prestamo:{{$prestamo->fecha_prestamo}}</h1>
<h2>Fecha de devolucion:{{$prestamo->fecha_devolucion}}</h2>
<h4>Cliente: {{$prestamo->clienteche->name}}</h4>
<h4>Libros:</h4>
<ul>
@foreach ($prestamo->libros as $libro)
    <li>{{$libro->titulo}}</li>
@endforeach
</ul>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div id="boton-editar">
    <div>
        <a href="{{route('prestamos.edit', ['prestamo' => $prestamo->id])}}" class="btn btn-primary">
            Editar
        </a>
        <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este prestamo?');">
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
