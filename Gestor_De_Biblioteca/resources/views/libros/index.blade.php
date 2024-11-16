@extends('layouts.AdminDashboard')
@section('title')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Libros</h1>

    @if(Auth::check() && Auth::user()->role->isAdmin())

    <a href="{{route('libros.create')}}" class="btn btn-primary m-2">
        <i class="fas fa-plus"></i> Nuevo Libro
    </a>
  
    @endif

    <button id="detailButton" class="btn btn-secondary m-2" disabled>
        <i class="fas fa-eye"></i> Detalles
    </button>
    @if(Auth::check() && Auth::user()->role->isAdmin())

    <button  id="editButton" class="btn btn-info m-2" disabled>
        <i class="fas fa-edit"></i> Editar
    </button>

     <form id="deleteForm" action="" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <button id="deleteButton" class="btn btn-danger m-2" disabled>
        <i class="fas fa-trash"></i> Eliminar
    </button>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 30px;">#</th>
                            <th class="text-center" style="width: 80px;">Imagen</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th class="text-center">Calificación</th>
                            <th>Código</th>
                            <th class="text-center" style="width: 100px;">Cantidad</th>
                            <th class="text-center" style="width: 120px;">Disponibles</th>
                            <th>Categoría</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($libros as $libro)
                        <tr>
                            <td class="text-center align-middle">
                                <input type="radio" name="selectedLibro" value="{{ $libro->id }}" onclick="toggleButtons(this)">
                            </td>
                            <td class="text-center">
                                @if($libro->img_url)
                                    <img src="{{ $libro->img_url }}" alt="Portada de {{ $libro->titulo }}"
                                         class="img-thumbnail" style="max-height: 60px;">
                                @else
                                    <span class="text-muted"><i class="fas fa-image fa-2x"></i></span>
                                @endif
                            </td>
                            <td class="align-middle">{{ $libro->titulo }}</td>
                            <td class="align-middle">{{ $libro->autor }}</td>
                            <td class="align-middle">{{ $libro->editorial ?? 'No especificada' }}</td>
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
                            <td class="align-middle">{{ $libro->codigo }}</td>
                            <td class="text-center align-middle">{{ $libro->cantidad }}</td>
                            <td class="text-center align-middle">
                                <span class="badge text-white {{ $libro->disponibles > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $libro->disponibles }}
                                </span>
                            </td>
                            <td class="align-middle">{{ $libro->categoria->nombre }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    let lastCheckedRadio = null;

    function toggleButtons(radio) {
        const detailButton = document.getElementById('detailButton');
        const editButton = document.getElementById('editButton');
        const deleteButton = document.getElementById('deleteButton');
            // Create invisible elements if they don't exist
            if (!detailButton) {
                detailButton = document.createElement('button');
                detailButton.style.display = 'none';
                document.body.appendChild(detailButton);
            }


        if (lastCheckedRadio === radio) {
            radio.checked = false;
            lastCheckedRadio = null;
            detailButton.disabled = true;
            if (editButton) editButton.disabled = true;
            if (deleteButton) deleteButton.disabled = true;
        } else {
            lastCheckedRadio = radio;
            const libroId = radio.value;
            detailButton.disabled = false;
            if (editButton) editButton.disabled = false;
            if (deleteButton) deleteButton.disabled = false;

            detailButton.onclick = () => window.location.href = `{{ url('libros') }}/${libroId}`;
            if (editButton) editButton.onclick = () => window.location.href = `{{ url('libros') }}/${libroId}/edit`;
            if (deleteButton) deleteButton.onclick = () => {
                if (confirm('¿Estás seguro de que deseas eliminar este libro?')) {
                deleteForm.action = `{{ url('libros') }}/${libroId}`;
                deleteForm.submit();
                }
            };

        }
    }
</script>

@endsection
