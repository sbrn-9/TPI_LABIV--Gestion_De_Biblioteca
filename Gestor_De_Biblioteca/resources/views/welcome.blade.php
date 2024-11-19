@extends('layouts.AdminDashboard')
@section('title', 'ALBA Library - Bienvenidos')
@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <img src="{{asset('assets/img/logo.png')}}" alt="ALBA Library Logo" style="width: 120px; height: 120px;" class="mb-4">
        <h1 class="h1 mb-3 text-gray-800">Bienvenido a ALBA Library</h1>
        <p class="lead text-gray-600">Tu destino para descubrir, aprender y crecer a través de la lectura</p>
    </div>

    <!-- Features Section -->
    <div class="row">
        @if(Auth::check() && Auth::user()->role->isCliente())
        <a href="{{route('cliente-libros.index')}}" class="col-xl-4 col-md-6 mb-4"  style="text-decoration: none; cursor: pointer;transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='1'">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Catálogo Digital</div>
                            <div class="h5 mb-0 font-weight-normal text-gray-800">Explora nuestra extensa colección de libros</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('cliente-prestamos.index')}}" class="col-xl-4 col-md-6 mb-4"  style="text-decoration: none; cursor: pointer;transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='1'">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Préstamos Fáciles</div>
                            <div class="h5 mb-0 font-weight-normal text-gray-800">Gestiona tus préstamos de forma simple</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="#" class="col-xl-4 col-md-6 mb-4"  style="text-decoration: none; cursor: pointer;transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='1'">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Reportes</div>
                            <div class="h5 mb-0 font-weight-normal text-gray-800">Estadísticas y análisis detallados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

     @endif

     @if(Auth::check() && Auth::user()->role->isAdmin())
        <a href="{{route('libros.index')}}" class="col-xl-4 col-md-6 mb-4"  style="text-decoration: none; cursor: pointer;transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='1'">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Catálogo Digital</div>
                            <div class="h5 mb-0 font-weight-normal text-gray-800">Explora nuestra extensa colección de libros</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('prestamos.index')}}" class="col-xl-4 col-md-6 mb-4"  style="text-decoration: none; cursor: pointer;transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='1'">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Préstamos Fáciles</div>
                            <div class="h5 mb-0 font-weight-normal text-gray-800">Gestiona tus préstamos de forma simple</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('informes.negocio')}}" class="col-xl-4 col-md-6 mb-4"  style="text-decoration: none; cursor: pointer;transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='1'">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Reportes</div>
                            <div class="h5 mb-0 font-weight-normal text-gray-800">Estadísticas y análisis detallados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

     @endif

    <!-- Call to Action -->
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <h4 class="mb-4">Comienza tu viaje literario hoy</h4>
                    @if(!Auth::check())
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mb-3">
                            <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                        </a>
                        <p class="text-muted">Accede a tu cuenta para disfrutar de todos nuestros servicios</p>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('prestamos.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-book-reader mr-2"></i>Mis Préstamos
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                @if(Auth::user()->role->isAdmin())
                                    <a href="{{ route('libros.index') }}" class="btn btn-info btn-block">
                                        <i class="fas fa-books mr-2"></i>Gestionar Libros
                                    </a>
                                @else
                                    <a href="{{ route('cliente-libros.index') }}" class="btn btn-info btn-block">
                                        <i class="fas fa-search mr-2"></i>Explorar Libros
                                    </a>
                                @endif
                            </div>
                            @if(Auth::user()->role->isAdmin())
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('users.index') }}" class="btn btn-success btn-block">
                                        <i class="fas fa-users mr-2"></i>Gestionar Usuarios
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sobre ALBA Library</h6>
                </div>
                <div class="card-body">
                    <p>ALBA Library es tu sistema integral de gestión bibliotecaria, diseñado para hacer que la experiencia de lectura sea más accesible y eficiente. Nuestro sistema ofrece:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i>Gestión completa del catálogo de libros</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i>Sistema eficiente de préstamos y devoluciones</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i>Notificaciones automáticas de fechas de devolución</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i>Reportes detallados y estadísticas de uso</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i>Interfaz intuitiva y fácil de usar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('alerts')
    @auth
        @isset($alerts)
        @if(!is_null($alerts))
        @if (count($alerts) > 0)
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{count($alerts)}}+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notificaciones
                </h6>
                @foreach ($alerts as $alert)
                @if(Auth::user()->role->isAdmin())
                <a class="dropdown-item d-flex align-items-center" href="{{route('prestamos.show', $alert->id)}}">
                @else
                <a class="dropdown-item d-flex align-items-center" href="{{route('cliente-prestamos.show', $alert->id)}}">
                @endif
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{$alert->fecha_devolucion}}</div>
                        @if(Auth::user()->role->isAdmin())
                        <span class="font-weight-bold">Préstamo de: {{$alert->propietario->name}}</span>
                        <span class="font-weight-bold">Próximo a Vencer</span>
                        @elseif(Auth::user()->role->isCliente())
                        <span class="font-weight-bold">Préstamo próximo a Vencer</span>
                        @endif
                    </div>
                </a>
                @endforeach
                @if(Auth::user()->role->isAdmin())
                <a class="dropdown-item text-center small text-gray-500" href="{{route('prestamos.index')}}">Otros Préstamos</a>
                @elseif(Auth::user()->role->isCliente())
                <a class="dropdown-item text-center small text-gray-500" href="{{route('cliente-prestamos.index')}}">Otros Préstamos</a>
                @endif
            </div>
        </li>
        @endif
        @endif
        @endisset
    @endauth

@endsection
