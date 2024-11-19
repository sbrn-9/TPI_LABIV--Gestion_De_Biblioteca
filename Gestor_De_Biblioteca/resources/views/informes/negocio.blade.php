@extends('layouts.admindashboard')
@section('title')
Estadisticas de Negocio
@endsection
@section('content')
<div class="container-fluid">
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Volver
    </a>

    <div class="card card-shadow">
        <div class="card-header py-3">
            <h1 class="h3 mb-0 text-gray-800">Estadísticas de Negocio</h1>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Prestamos Por Mes</h6>
                        </div>
                        <div class="card-body">
                        @isset($data)
                            <div class="chart-bar">
                                <canvas id="myBarChart"
                                data-labels='@json($labels)'
                                data-values='@json($data)'></canvas>
                            </div>
                            <hr>
                            <p>Cantidad de Prestamos realizados en cada mes</p>
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
                            <h6 class="m-0 font-weight-bold text-primary">Categorías Más Leídas</h6>
                        </div>

                        <div class="card-body">
                            @isset($topCats)
                            @isset($catNames)
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"
                                data-labels='@json($catNames)'
                                data-values='@json($topCats)'></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary-dark"></i> {{$catNames[0]}}
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> {{$catNames[1]}}
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary-light"></i> {{$catNames[2]}}
                                </span>
                            </div>
                            <hr>
                            <p>Suma la cantidad de libros prestados por cada categoria</p>
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
        <div class="row">
            <div class="col-md-4">
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios con Mas Prestamos</h6>
                        </div>
                        <div class="card-body">
                                @isset($userNames)
                                @isset($userValues)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Prestamos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($userNames as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user }}</td>
                                        <td> {{ $userValues[$index] }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                <div class="card-body">
                                    <p>No hay datos disponibles</p>
                                </div>
                                @endisset
                                @endisset
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Top 5 Libros Mas Prestados</h6>
                        </div>
                        <div class="card-body">
                            @isset($topLibros)
                            <div class="table">
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Autor</th>
                                            <th class="text-center">Calificación</th>
                                            <th>Prestamos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topLibros as $index => $libro)
                                        <tr>
                                            <td>{{ $libro->titulo }}</td>
                                            <td>{{ $libro->autor }}</td>
                                            <td class="text-center align-middle">
                                                @if($libro->calificacion)
                                                    <div class="text-warning">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $libro->calificacion)
                                                                <i class="fas fa-star"></i>
                                                            @elseif($i - 0.5 <= $libro->calificacion)
                                                                <i class="fas fa-star-half-alt"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                @else
                                                    <span class="text-muted">Sin calificar</span>
                                                @endif
                                            </td>
                                            <td>{{ $libro->total_prestamos }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            @else
                                <div class="card-body">
                                    <p>No hay datos disponibles</p>
                                </div>
                            @endisset
                            </table>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

    <script src="{{asset('assets/js/Chart.js')}}"></script>

    <!-- Page level custom scripts -->

    <script src="{{asset('assets/js/chart-pie-demo.js')}}"></script>
    <script src="{{asset('assets/js/chart-bar-demo.js')}}"></script>
@endsection
