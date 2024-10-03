@extends('layouts.admindashboard')
@section('content')
<h1>Lista de Libros</h1>
    <a href="{{route('libros.create')}}" class="button">
        Nuevo Libro
    </a>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Descripción</th>
                <th>Código</th>
                <th>Cantidad</th>
                <th>Disponibilidad</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $libro->descripcion }}</td>
                    <td>{{ $libro->codigo }}</td>
                    <td>{{ $libro->cantidad }}</td>
                    <td>{{ $libro->disponibles}}</td>
                    <td>{{ $libro->categoria->nombre }}</td>
                    <td>
                        <a href="{{route('libros.show', ['libro' => $libro->id])}}" class="btn btn-primary">
                            Detalles
                        </a>
                        <a href="{{route('libros.edit', ['libro' => $libro->id])}}" class="btn btn-outline-primary">
                            Editar
                        </a>
                        <a href="{{route('libros.destroy', ['libro' => $libro->id])}}"  class="btn btn-danger">
                            Eliminar
                        </a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
