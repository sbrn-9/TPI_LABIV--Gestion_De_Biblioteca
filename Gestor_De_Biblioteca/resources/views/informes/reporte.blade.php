@extends('layouts.admindashboard')

@section('title')
Estadísticas de Administradores
@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Estadísticas de Administradores</h1>

    <div class="row">
        @foreach ($adminReports as $report)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $report['admin']->name }}</h5>
                    <p class="card-text">Total de cancelaciones esta semana: {{ $report['weekly_cancelations'] }}</p>
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
            <p>Promedio mensual de cancelaciones: {{ $monthlyAverages->avg_cancelations }}</p>
            <p>Promedio mensual de activaciones: {{ $monthlyAverages->avg_activations }}</p>
            <p>Promedio mensual de cierres: {{ $monthlyAverages->avg_closures }}</p>
        </div>
    </div>
</div>
@endsection
