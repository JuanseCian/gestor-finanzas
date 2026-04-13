@extends('layouts.app')

@section('content')

<h2 class="mb-4">Panel de Usuario</h2>

<!-- RESUMEN FINANCIERO -->
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card bg-success text-white p-3 text-center shadow">
            <h6>Ingresos</h6>
            <h3>${{ $ingresos ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white p-3 text-center shadow">
            <h6>Gastos</h6>
            <h3>${{ $gastos ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card {{ ($balance ?? 0) >= 0 ? 'bg-primary' : 'bg-warning' }} text-white p-3 text-center shadow">
            <h6>Balance</h6>
            <h3>${{ $balance ?? 0 }}</h3>
        </div>
    </div>

</div>

<div class="row">

    <!-- PERFIL -->
    <div class="col-md-4">
        <div class="card bg-secondary text-white p-3 text-center shadow">

            <img src="{{ auth()->user()->foto ?? 'https://via.placeholder.com/120' }}"
                 class="rounded-circle mb-3"
                 width="120"
                 height="120">

            <h5>{{ auth()->user()->name }}</h5>
            <p class="text-light small">{{ auth()->user()->email }}</p>

            <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm mt-2">
                Editar perfil
            </a>

        </div>
    </div>

    <!-- ACCESOS RÁPIDOS -->
    <div class="col-md-8">
        <div class="row g-3">

            <div class="col-md-4">
                <div class="card bg-dark text-white text-center p-4 shadow">
                    <h5>💰</h5>
                    <p>Transacciones</p>
                    <a href="{{ route('transacciones.index') }}" class="btn btn-success btn-sm">
                        Ver
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-white text-center p-4 shadow">
                    <h5>⚖️</h5>
                    <p>Balance</p>
                    <a href="#" class="btn btn-warning btn-sm">
                        Ver
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-white text-center p-4 shadow">
                    <h5>📊</h5>
                    <p>Estadísticas</p>
                    <a href="#" class="btn btn-primary btn-sm">
                        Ver
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection