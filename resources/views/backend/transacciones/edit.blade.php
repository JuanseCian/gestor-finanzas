@extends('layouts.app')

@section('content')

<h2>Mis transacciones</h2>

<a href="{{ route('transacciones.create') }}">Nueva</a>

<table class="table">
    <tr>
        <th>Tipo</th>
        <th>Monto</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>

    @foreach($transacciones as $t)
    <tr>
        <td>{{ $t->tipo }}</td>
        <td>{{ $t->monto }}</td>
        <td>{{ $t->fecha }}</td>
        <td>
            <a href="{{ route('transacciones.edit', $t) }}">Editar</a>

            <form method="POST" action="{{ route('transacciones.destroy', $t) }}">
                @csrf
                @method('DELETE')
                <button>Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection