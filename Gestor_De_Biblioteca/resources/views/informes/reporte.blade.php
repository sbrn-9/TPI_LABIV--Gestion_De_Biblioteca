@extends('layouts.admindashboard')

@section('title')
Estadísticas de Administradores
@endsection

@section('content')

<div class="container-fluid">
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Volver
    </a>

    <h1 class="h3 mb-4 text-gray-800">Estadísticas de Administradores</h1>

    <div class="row">
        @foreach ($adminReports as $report)
        <div class="col-md-6 mb-3"> <!-- Ajuste para organizar las tarjetas -->
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                {{ $report['admin']->name }}
                            </div>
                            <div class="p mb-0 font-weight-medium text-gray-800">
                                Total de cancelaciones esta semana: {{ $report['weekly_cancelations'] }}
                            </div>
                            <div class="p mb-0 font-weight-medium text-gray-800">
                                Total de activaciones esta semana: {{ $report['weekly_activations'] }}
                            </div>
                            <div class="p mb-0 font-weight-medium text-gray-800">
                                Total de rechazos esta semana: {{ $report['weekly_rejections'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Promedios Mensuales</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p>Promedio mensual de activaciones: {{ $monthlyAverages['avg_activations'] }}</p>
                </div>

                <div class="col-md-4">
                    <p>Promedio mensual de cancelaciones: {{ $monthlyAverages['avg_cancelations'] }}</p>
                </div>

                <div class="col-md-4">
                    <p>Promedio mensual de cierres: {{ $monthlyAverages['avg_closures'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


