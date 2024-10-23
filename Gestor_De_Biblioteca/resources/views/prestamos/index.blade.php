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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha Préstamo</th>
                    <th>Fecha Devolución</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Admin Cancelador</th>
                    <th>Fecha Cancelacion</th>
                    <th>Admin Modificador</th>
                    <th>Fecha Modificacion</th>
                    <th>Admin Eliminador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamos as $prestamo)
                    <tr>
                        <td>{{ $prestamo->id }}</td>
                        <td>{{ $prestamo->fecha_prestamo }}</td>
                        <td>{{ $prestamo->fecha_devolucion }}</td>
                        <td>{{ $prestamo->propietario->name }}</td>
                        <td>{{ $prestamo->estado->name }}</td>
                        <td>{{ $prestamo->admin_cancelador->name ?? 'N/A' }}</td>
                        <td>{{ $prestamo->canceled_at }}</td>
                        <td>{{ $prestamo->admin_modificador->name ?? 'N/A' }}</td>
                        <td>{{ $prestamo->updated_at}}</td>
                        <td>{{ $prestamo->admin_eliminador->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('prestamos.create') }}" class="btn btn-primary">
            Nuevo Préstamo
        </a>
    </div>
</div>
@endsection
