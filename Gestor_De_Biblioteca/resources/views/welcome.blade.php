@extends('layouts.AdminDashboard')
@section('title')
@section('content')

{{-- ADMIN prestamoS--}}
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Préstamos</h1>

    {{-- botones de crud --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha de préstamo</th>
                            <th>Fecha de devolución</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Fecha de préstamo</th>
                            <th>Fecha de devolución</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </tfoot>
                    <tbody>
                         {{-- @foreach ($prestamos as $prestamo)
                        <tr>
                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->titulo }}</td>
                            <td>{{ $prestamo->autor }}</td>
                            <td>{{ $prestamo->descripcion }}</td>
                            <td>{{ $prestamo->codigo }}</td>
                            <td>{{ $prestamo->cantidad }}</td>
                            <td>{{ $prestamo->disponibles}}</td>
                            <td>{{ $prestamo->categoria->nombre }}</td>
                            <td>
                                <a href="{{route('prestamos.show', ['prestamo' => $prestamo->id])}}" class="btn btn-primary">
                                    Detalles
                                </a>
                                <a href="{{route('prestamos.edit', ['prestamo' => $prestamo->id])}}" class="btn btn-outline-primary">
                                    Editar
                                </a>
                                <a href="{{route('prestamos.edit', ['prestamo' => $prestamo->id])}}" class="btn btn-outline-primary">
                                    Cancelar
                                </a>
                                <a href="{{route('prestamos.destroy', ['prestamo' => $libro->id])}}"  class="btn btn-danger">
                                    Eliminar
                                </a></td>
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
