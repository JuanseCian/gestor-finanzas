@extends('layouts.app')

@section('content')

<h2>Editar Categoría</h2>

<form method="POST" action="{{ route('categorias.update', $categoria) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $categoria->nombre }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tipo</label>
        <select name="tipo" class="form-control">
            <option value="ingreso" {{ $categoria->tipo == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
            <option value="gasto" {{ $categoria->tipo == 'gasto' ? 'selected' : '' }}>Gasto</option>
        </select>
    </div>

    <button class="btn btn-primary">Actualizar</button>

</form>

@endsection