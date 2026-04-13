@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h2 class="fw-bold mb-0">{{ __('Perfil de Usuario') }}</h2>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-start border-danger border-4">
                <div class="card-body p-4 p-md-5">
                    <div class="max-w-xl">
                        <h3 class="text-danger fw-bold h5 mb-3">{{ __('Eliminar Cuenta') }}</h3>
                        <p class="text-muted small mb-4">
                            {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán de forma permanente.') }}
                        </p>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .max-w-xl {
        max-width: 36rem;
    }
    
    .dark .card {
        background-color: #1e1e1e;
        color: #f8f9fa;
    }
</style>
@endsection