@extends('layouts.app')

@section('content')

<div class="row align-items-center min-vh-75 py-5 mt-lg-4">
    
    <!-- LADO IZQUIERDO: TEXTOS Y LLAMADAS A LA ACCIÓN -->
    <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
        
        <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill border border-primary-subtle fs-6">
            <i class="bi bi-stars me-1"></i> Simple, rápido y seguro
        </span>
        
        <h1 class="display-4 fw-bold mb-4" style="letter-spacing: -1px;">
            Toma el control de tu <span class="text-primary">dinero</span> fácilmente
        </h1>
        
        <p class="lead text-muted mb-5 pe-lg-5">
            Registra tus ingresos, controla tus gastos diarios y visualiza tus estadísticas en tiempo real para alcanzar tus metas financieras sin estrés.
        </p>

        @guest
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-medium">
                    Empezar ahora <i class="bi bi-arrow-right ms-2"></i>
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5 fw-medium">
                    Ya tengo cuenta
                </a>
            </div>
        @endguest

        @auth
            <div class="card border-0 shadow-sm rounded-4 p-4 mt-4 bg-body-tertiary">
                <h5 class="fw-bold mb-3">👋 ¡Hola de nuevo, {{ auth()->user()->name }}!</h5>
                <p class="text-muted small mb-4">¿Qué te gustaría hacer hoy?</p>
                
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('transacciones.create', ['tipo' => 'ingreso']) }}" class="btn btn-success rounded-pill px-4 fw-medium shadow-sm">
                        <i class="bi bi-arrow-down-circle me-2"></i> Agregar Ingreso
                    </a>
                    
                    <a href="{{ route('transacciones.create', ['tipo' => 'gasto']) }}" class="btn btn-danger rounded-pill px-4 fw-medium shadow-sm">
                        <i class="bi bi-arrow-up-circle me-2"></i> Agregar Gasto
                    </a>
                    
                    <a href="{{ route('dashboard') }}" class="btn btn-dark rounded-pill px-4 fw-medium shadow-sm">
                        <i class="bi bi-speedometer2 me-2"></i> Ir al Panel
                    </a>
                </div>
            </div>
        @endauth

    </div>

    <div class="col-lg-6 d-none d-lg-block text-center">
        <img src="https://illustrations.popsy.co/amber/freelancer.svg" 
             alt="Ilustración Finanzas" 
             class="img-fluid" 
             style="max-height: 480px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
    </div>

</div>

@endsection