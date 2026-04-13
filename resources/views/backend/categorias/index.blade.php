@extends('layouts.app')

@section('content')

<h2>Categorías</h2>

<a href="{{ route('categorias.create') }}" class="btn btn-success mb-3">
    Nueva Categoría
</a>

<table class="table table-dark">
    <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>

    @foreach($categorias as $c)
    <tr>
        <td>{{ $c->nombre }}</td>
        <td>
            <span class="badge {{ $c->tipo == 'ingreso' ? 'bg-success' : 'bg-danger' }}">
                {{ $c->tipo }}
            </span>
        </td>
        <td>
            <a href="{{ route('categorias.edit', $c) }}" class="btn btn-warning btn-sm">
                Editar
            </a>

            <form method="POST" action="{{ route('categorias.destroy', $c) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

@endsection