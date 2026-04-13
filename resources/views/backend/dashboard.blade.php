@extends('layouts.app')

@section('content')

<!-- ENCABEZADO DEL DASHBOARD -->
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4 gap-3">
    <div>
        <h2 class="fw-bold mb-0">Panel de Control</h2>
        <p class="text-muted mb-0">Resumen financiero de tus cuentas</p>
    </div>
    <div class="bg-body-secondary px-4 py-2 rounded-pill text-muted small fw-medium">
        <i class="bi bi-calendar3 me-2"></i> {{ now()->format('d M, Y') }}
    </div>
</div>

<div class="d-flex gap-2 mb-4 flex-wrap">

    <a href="{{ route('dashboard', ['filtro' => 'hoy']) }}"
       class="btn {{ $filtro == 'hoy' ? 'btn-primary' : 'btn-outline-primary' }}">
        Hoy
    </a>

    <a href="{{ route('dashboard', ['filtro' => 'semana']) }}"
       class="btn {{ $filtro == 'semana' ? 'btn-primary' : 'btn-outline-primary' }}">
        Semana
    </a>

    <a href="{{ route('dashboard', ['filtro' => 'mes']) }}"
       class="btn {{ $filtro == 'mes' ? 'btn-primary' : 'btn-outline-primary' }}">
        Mes
    </a>

    <a href="{{ route('dashboard', ['filtro' => 'anio']) }}"
       class="btn {{ $filtro == 'anio' ? 'btn-primary' : 'btn-outline-primary' }}">
        Año
    </a>

</div>
<form method="GET" class="row g-2 mb-4">

    <input type="hidden" name="filtro" value="personalizado">

    <!-- Año -->
    <div class="col-auto">
        <select name="anio" class="form-select">
            @for($i = now()->year; $i >= now()->year - 5; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <!-- Mes -->
    <div class="col-auto">
        <select name="mes" class="form-select">
            <option value="">Todo</option>
            @for($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}">
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-auto">
        <button class="btn btn-dark">Aplicar</button>
    </div>

</form>

<!-- RESUMEN FINANCIERO -->
<div class="row g-4 mb-5">

    <!-- Tarjeta Ingresos -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 card-hover bg-success-subtle text-success-emphasis">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-uppercase tracking-wide">Ingresos</h6>
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                        <i class="bi bi-graph-up-arrow fs-5"></i>
                    </div>
                </div>
                <!-- Usamos number_format para que se vea como dinero real -->
                <h2 class="fw-bolder mb-0">${{ number_format($ingresos ?? 0, 2, ',', '.') }}</h2>
                <p class="small mt-2 mb-0 opacity-75"><i class="bi bi-arrow-up-short"></i> Total acumulado</p>
            </div>
        </div>
    </div>

    <!-- Tarjeta Gastos -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 card-hover bg-danger-subtle text-danger-emphasis">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-uppercase tracking-wide">Gastos</h6>
                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                        <i class="bi bi-graph-down-arrow fs-5"></i>
                    </div>
                </div>
                <h2 class="fw-bolder mb-0">${{ number_format($gastos ?? 0, 2, ',', '.') }}</h2>
                <p class="small mt-2 mb-0 opacity-75"><i class="bi bi-arrow-down-short"></i> Gastos registrados</p>
            </div>
        </div>
    </div>

    <!-- Tarjeta Balance -->
    <div class="col-md-4">
        @php $isPositive = ($balance ?? 0) >= 0; @endphp
        <div class="card border-0 shadow-sm rounded-4 h-100 card-hover {{ $isPositive ? 'bg-primary-subtle text-primary-emphasis' : 'bg-warning-subtle text-warning-emphasis' }}">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-uppercase tracking-wide">Balance Total</h6>
                    <div class="{{ $isPositive ? 'bg-primary' : 'bg-warning text-dark' }} text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                        <i class="bi bi-wallet2 fs-5"></i>
                    </div>
                </div>
                <h2 class="fw-bolder mb-0">${{ number_format($balance ?? 0, 2, ',', '.') }}</h2>
                <p class="small mt-2 mb-0 opacity-75">
                    <i class="bi {{ $isPositive ? 'bi-emoji-smile' : 'bi-info-circle' }}"></i> 
                    {{ $isPositive ? 'Finanzas saludables' : 'Revisa tus gastos' }}
                </p>
            </div>
        </div>
    </div>

</div>

<!-- SECCIÓN INFERIOR -->
<div class="row g-4">

    <!-- GESTIÓN Y HERRAMIENTAS (Accesos rápidos) -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0">Herramientas Rápidas</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    
                    <!-- Transacciones -->
                    <div class="col-md-6">
                        <a href="{{ route('transacciones.index') }}" class="text-decoration-none text-body">
                            <div class="card border border-2 border-light-subtle rounded-4 h-100 card-hover bg-body-tertiary">
                                <div class="card-body p-3 d-flex align-items-center gap-3">
                                    <div class="bg-body text-primary rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                        <i class="bi bi-list-columns-reverse fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Transacciones</h6>
                                        <p class="text-muted small mb-0">Ver historial completo</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Estadísticas -->
                    <div class="col-md-6">
                        <a href="#" class="text-decoration-none text-body">
                            <div class="card border border-2 border-light-subtle rounded-4 h-100 card-hover bg-body-tertiary">
                                <div class="card-body p-3 d-flex align-items-center gap-3">
                                    <div class="bg-body text-info rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                        <i class="bi bi-pie-chart fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Estadísticas</h6>
                                        <p class="text-muted small mb-0">Gráficos y reportes</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Nuevo Ingreso -->
                    <div class="col-md-6">
                        <a href="{{ route('transacciones.create', ['tipo' => 'ingreso']) }}" class="text-decoration-none">
                            <div class="card border border-2 border-success-subtle rounded-4 h-100 card-hover bg-success-subtle">
                                <div class="card-body p-3 d-flex align-items-center gap-3">
                                    <div class="bg-success text-white rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                        <i class="bi bi-plus-lg fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-success-emphasis mb-1">Añadir Ingreso</h6>
                                        <p class="text-success-emphasis opacity-75 small mb-0">Registrar nuevo dinero</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Nuevo Gasto -->
                    <div class="col-md-6">
                        <a href="{{ route('transacciones.create', ['tipo' => 'gasto']) }}" class="text-decoration-none">
                            <div class="card border border-2 border-danger-subtle rounded-4 h-100 card-hover bg-danger-subtle">
                                <div class="card-body p-3 d-flex align-items-center gap-3">
                                    <div class="bg-danger text-white rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                        <i class="bi bi-dash-lg fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-danger-emphasis mb-1">Añadir Gasto</h6>
                                        <p class="text-danger-emphasis opacity-75 small mb-0">Registrar nueva salida</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- CATEGORÍAS -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 mt-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Categorías</h5>

                <!-- Botón abrir modal -->
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                    <i class="bi bi-plus-lg"></i> Nueva
                </button>
            </div>

            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2">
                    @forelse($categorias as $cat)
                        <span class="badge bg-secondary-subtle text-dark px-3 py-2">
                            {{ $cat->nombre }}
                        </span>
                    @empty
                        <p class="text-muted small mb-0">No hay categorías aún</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- PERFIL LATERAL -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center overflow-hidden">
            <!-- Banner de fondo (Header profile) -->
            <div class="bg-primary bg-gradient opacity-75" style="height: 100px;"></div>
            
            <div class="card-body p-4 position-relative pt-0">
                <!-- Avatar superpuesto -->
                <div class="mt-n5 mb-3">
                    <img src="{{ auth()->user()->foto ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random&size=150' }}"
                         class="rounded-circle border border-4 border-body bg-body shadow-sm"
                         width="100"
                         height="100"
                         alt="Foto de perfil">
                </div>
                
                <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                <p class="text-muted small mb-4">{{ auth()->user()->email }}</p>

                <div class="d-grid gap-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary rounded-pill fw-medium">
                        <i class="bi bi-pencil-square me-1"></i> Editar perfil
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL CREAR CATEGORIA -->
<div class="modal fade" id="modalCategoria" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf

            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <!-- Tipo -->
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select" required>
                            <option value="ingreso">Ingreso</option>
                            <option value="gasto">Gasto</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection