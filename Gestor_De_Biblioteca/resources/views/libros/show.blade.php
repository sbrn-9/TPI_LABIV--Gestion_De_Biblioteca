@extends('layouts.admindashboard')

@section('content')
<div class="container mt-4">
    <a href="{{route('libros.index')}}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Atrás
    </a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{$libro->titulo}}</h1>
            <h5 class="card-subtitle text-muted">{{$libro->categoria->nombre}}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($libro->img_url)
                        <img src="{{ $libro->img_url }}" alt="Imagen de {{ $libro->titulo }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                    @else
                        <div class="alert alert-info">No hay imagen disponible</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h4>Detalles del Libro</h4>
                    <dl class="row">
                        <dt class="col-sm-3">Autor</dt>
                        <dd class="col-sm-9">{{$libro->autor}}</dd>

                        <dt class="col-sm-3">Editorial</dt>
                        <dd class="col-sm-9">{{$libro->editorial ?? 'No especificada'}}</dd>

                        <dt class="col-sm-3">Fecha de Publicación</dt>
                        <dd class="col-sm-9">{{$libro->fecha_publicacion ? date('d/m/Y', strtotime($libro->fecha_publicacion)) : 'No especificada'}}</dd>

                        <dt class="col-sm-3">Idioma</dt>
                        <dd class="col-sm-9">{{$libro->idioma ?? 'No especificado'}}</dd>

                        <dt class="col-sm-3">Número de Páginas</dt>
                        <dd class="col-sm-9">{{$libro->numero_paginas ?? 'No especificado'}}</dd>

                        <dt class="col-sm-3">Calificación</dt>
                        <dd class="col-sm-9">
                            @if($libro->calificacion)
                                <div class="d-flex align-items-center">
                                    <span class="me-2">{{$libro->calificacion}} / 5 &nbsp;&nbsp;</span>
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
                                </div>
                            @else
                                No calificado
                            @endif
                        </dd>

                        <dt class="col-sm-3">Descripción</dt>
                        <dd class="col-sm-9">{{$libro->descripcion}}</dd>

                        <dt class="col-sm-3">Código</dt>
                        <dd class="col-sm-9">{{$libro->codigo}}</dd>

                        <dt class="col-sm-3">Cantidad Total</dt>
                        <dd class="col-sm-9">{{$libro->cantidad}}</dd>

                        <dt class="col-sm-3">Disponibles</dt>
                        <dd class="col-sm-9">
                            <span class="badge text-white {{ $libro->disponibles > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{$libro->disponibles}}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Categoría</dt>
                        <dd class="col-sm-9">{{$libro->categoria->nombre}}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
    @endif

    <div class="mt-4 d-flex justify-content-between">
        <a href="{{route('libros.edit', ['libro' => $libro->id])}}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Editar
        </a>
        <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este libro?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </form>
    </div>
</div>
@endsection
