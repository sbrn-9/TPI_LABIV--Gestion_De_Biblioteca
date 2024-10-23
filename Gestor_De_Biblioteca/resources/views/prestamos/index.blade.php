@extends('layouts.admindashboard')

@section('content')
<div class="container">
    <h1>Lista de Préstamos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <a href="{{route('prestamos.create') }}" class="btn btn-primary m-2" >
            Nuevo Préstamo
        </a>

        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Estado</th>
                                <th>Fecha Préstamo</th>
                                <th>Fecha Cancelacion</th>
                                <th>Fecha Devolución</th>
                                <th>Fecha Modificacion</th>
                                <th>Acciones</th>
                            </tr>>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Estado</th>
                                <th>Fecha Préstamo</th>
                                <th>Fecha Cancelacion</th>
                                <th>Fecha Devolución</th>
                                <th>Fecha Modificacion</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->id }}</td>
                                <td>{{ $prestamo->propietario->name }}</td>
                                <td>{{ $prestamo->estado->name }}</td>
                                <td>{{ $prestamo->fecha_prestamo }}</td>
                                <td>{{ $prestamo->canceled_at }}</td>
                                <td>{{ $prestamo->fecha_devolucion }}</td>
                                <td>{{ $prestamo->updated_at}}</td>
                                <td>
                                    <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-info btn-sm m-2" >Ver</a>
                                    <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning btn-sm m-2" >Editar</a>
                                    <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm m-2" onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?')" >Eliminar</button>
                                    </form>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>







    </div>
</div>
@endsection
