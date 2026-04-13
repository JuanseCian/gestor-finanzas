@extends('layouts.app')

@section('content')

<div class="text-center mt-5">

    <h1 class="fw-bold">Controlá tu dinero fácil</h1>

    <p class="text-muted">
        Registrá ingresos y gastos de manera simple.
    </p>

    @guest
        <a href="{{ route('register') }}" class="btn btn-warning mt-3">
            Empezar ahora
        </a>
    @endguest

</div>

@endsection