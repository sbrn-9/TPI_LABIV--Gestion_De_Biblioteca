@extends('layouts.AdminDashboard')
@section('title')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Libros</h1>

    <a href="{{route('libros.create')}}" class="btn btn-primary">
        Nuevo Libro
    </a>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        </tr>>
                    </thead>
                    <tfoot>
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
                    </tfoot>
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
            </div>
        </div>
    </div>

</div>
@endsection
