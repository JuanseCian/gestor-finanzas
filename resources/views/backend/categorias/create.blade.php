@extends('layouts.app')

@section('content')

<h2>Nueva Categoría</h2>

<form method="POST" action="{{ route('categorias.store') }}">
    @csrf

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tipo</label>
        <select name="tipo" class="form-control">
            <option value="ingreso">Ingreso</option>
            <option value="gasto">Gasto</option>
        </select>
    </div>

    <button class="btn btn-success">Guardar</button>

</form>

@endsection