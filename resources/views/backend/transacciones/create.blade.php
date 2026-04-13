@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('transacciones.store') }}">
    @csrf

    <select name="tipo">
        <option value="ingreso">Ingreso</option>
        <option value="gasto">Gasto</option>
    </select>

    <input type="number" name="monto" placeholder="Monto">

    <input type="date" name="fecha">

    <textarea name="descripcion"></textarea>

    <button>Guardar</button>
</form>

@endsection