@extends('layouts.admindashboard')
@section('title')
Estadisticas de Control
@endsection
@section('content')
<div class="container-fluid">
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Volver
    </a>
    <div class="card card-shadow">
        <div class="card-header py-3">
            <h1 class="h3 mb-0 text-gray-800">Estadísticas de Control</h1>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="col-mb-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Libro Mejor Calificado</div>
                                        <div class="text-xs font-weight-bold text-gray-800 mb-1">
                                            {{$bestLibro->titulo}}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$bestLibro->calificacion}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-mb-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Libro Mas Largo</div>
                                        <div class="text-xs font-weight-bold text-gray-800 mb-1">
                                            {{$largestLibro->titulo}}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$largestLibro->numero_paginas}} Páginas</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-mb-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Libro Mas Antiguo</div>
                                        <div class="text-xs font-weight-bold text-gray-800 mb-1">
                                            {{$oldestLibro->titulo}}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$oldestLibro->fecha_publicacion}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Existencias de Libros</h6>
                        </div>
                        <div class="card-body">
                            @isset($libros)
                            <div class="table-responsive-informe">
                                <table class="table table-bordered  border-left-primary">
                                    <thead>
                                            <th>#</th>
                                            <th>Título</th>
                                            <th>Autor</th>
                                            <th>Editorial</th>
                                            <th>Cantidad</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($libros as $index => $libro)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $libro->titulo }}</td>
                                            <td>{{ $libro->autor }}</td>
                                            <td>{{ $libro->editorial ?? 'No especificada' }}</td>
                                            <td>{{ $libro->cantidad }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="card-body">
                                <p>No hay datos disponibles</p>
                            </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Categorias Con Mas Libros</h6>
                        </div>
                        <div class="card-body">
                            @isset($catNames)
                            @isset($existencias)
                            <div class="table-responsive-informe">
                                <table class="table table-bordered  border-left-primary">
                                    <thead>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($catNames as $index => $cat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $cat }}</td>
                                            <td> {{ $existencias[$index] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="card-body">
                                <p>No hay datos disponibles</p>
                            </div>
                            @endisset
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
