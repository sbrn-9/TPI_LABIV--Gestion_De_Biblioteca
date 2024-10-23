@extends('layouts.admindashboard')
@section('content')
<a href="{{ route('prestamos.index') }}" class="btn btn-primary">Volver</a>
<h1>id: {{$prestamo->id}}</h1>
<h1>Fecha de prestamo:{{$prestamo->fecha_prestamo->format('d-M-y')}}</h1>
<h2>Fecha de devolucion:{{$prestamo->fecha_devolucion->format('d-M-y')}}</h2>
<h4>Cliente: {{$prestamo->propietario->name}}</h4>
<h4>Libros:</h4>
<ul>
@if ($prestamoLibrosInfo->isEmpty())
    NO HAY LIBROS PRESTADOS, ELIMINAR ESTE PRESTAMO? ver esta parte jejejeje
    <a href="{{route('prestamos.destroy', $prestamo->id)}}" class="btn btn-danger">Eliminar</a>
@else
    @foreach ($prestamoLibrosInfo as $info)
    <li>{{$info->libro->titulo}} : {{$info->cantidad}}</li>
    @endforeach
@endif

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
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


    </div>
</div>
@endsection
