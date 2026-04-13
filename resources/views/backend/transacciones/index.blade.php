@extends('layouts.app')

@section('content')

<h2>Mis Transacciones</h2>

<a href="{{ route('transacciones.create') }}" class="btn btn-success mb-3">
    Nueva Transacción
</a>

<table class="table table-dark table-striped">
    <tr>
        <th>Tipo</th>
        <th>Monto</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>

    @foreach($transacciones as $t)
    <tr>
        <td>{{ $t->tipo }}</td>
        <td>${{ $t->monto }}</td>
        <td>{{ $t->fecha }}</td>
        <td>
            <a href="{{ route('transacciones.edit', $t) }}" class="btn btn-warning btn-sm">Editar</a>

            <form method="POST" action="{{ route('transacciones.destroy', $t) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection