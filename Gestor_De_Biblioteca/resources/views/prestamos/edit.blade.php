@extends('layouts.AdminDashboard')

@section('content')
<div class="container mt-4">
    <a href="{{route('prestamos.index')}}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Atrás
    </a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editar Préstamo</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('prestamos.update', ['prestamo' => $prestamo->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="fecha_prestamo">Fecha de Préstamo</label>
                    <input type="date" class="form-control @error('fecha_prestamo') is-invalid @enderror" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo', $prestamo->fecha_prestamo->format('Y-m-d')) }}" required>
                    @error('fecha_prestamo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" class="form-control @error('fecha_devolucion') is-invalid @enderror" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion', $prestamo->fecha_devolucion->format('Y-m-d')) }}" required>
                    @error('fecha_devolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h4>Libros:</h4>
                <div class="container px-0">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($prestamoLibrosInfo as $info)
                            <div class="col book-item" id="book-container-{{ $info->libro->id }}">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0 flex-grow-1">{{ $info->libro->titulo }}</h5>
                                            <button type="button" class="btn btn-link text-danger p-0 ms-2 delete-book" 
                                                    onclick="deleteBook({{ $info->libro->id }}, {{ $loop->index }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <p class="card-text text-muted small mb-3">
                                            {{ $info->cantidad }} {{($info->cantidad == 1 ? ' pedido' : ' pedidos')}} | 
                                            {{ $info->libro->disponibles }} {{($info->libro->disponibles == 1 ? ' disponible' : ' disponibles')}}
                                        </p>
                                        <input type="hidden" name="libros[{{ $loop->index }}][libro_id]" value="{{ $info->libro->id }}">
                                        <input type="number" 
                                               class="form-control @error('libros.'.$loop->index.'.cantidad') is-invalid @enderror" 
                                               name="libros[{{ $loop->index }}][cantidad]" 
                                               id="cantidad-{{ $info->libro->id }}"
                                               min="0" 
                                               placeholder="Cantidad" 
                                               value="{{ old('libros.' . $loop->index . '.cantidad', $info->cantidad) }}">
                                        @error('libros.'.$loop->index.'.cantidad')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <x-primary-button class="btn btn-primary">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function deleteBook(bookId, index) {
    // Get the book container and quantity input
    const container = document.getElementById(`book-container-${bookId}`);
    const quantityInput = document.getElementById(`cantidad-${bookId}`);
    
    // Set quantity to 0
    quantityInput.value = 0;
    
    // Hide the container with animation
    container.style.transition = 'opacity 0.3s ease-out';
    container.style.opacity = '0';
    
    setTimeout(() => {
        container.style.display = 'none';
    }, 300);
}
</script>

<style>
.book-item {
    transition: all 0.3s ease;
}

.book-item .card {
    transition: transform 0.2s ease;
}

.book-item .card:hover {
    transform: translateY(-2px);
}

.delete-book {
    opacity: 0.7;
    transition: opacity 0.2s ease;
}

.delete-book:hover {
    opacity: 1;
}
</style>
@endsection
