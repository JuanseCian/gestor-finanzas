@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-3 mt-lg-5">
    <div class="col-md-8 col-lg-6">

        <!-- ENCABEZADO DEL FORMULARIO -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                @if($tipo == 'ingreso')
                    <i class="bi bi-arrow-down-circle-fill text-success me-2"></i> Nuevo Ingreso
                @else
                    <i class="bi bi-arrow-up-circle-fill text-danger me-2"></i> Nuevo Gasto
                @endif
            </h2>
            <a href="{{ route('transacciones.index') }}" class="btn btn-outline-secondary rounded-pill px-3 btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <!-- TARJETA DEL FORMULARIO -->
        <div class="card border-0 shadow-sm rounded-4 bg-body-tertiary">
            <div class="card-body p-4 p-md-5">

                <form method="POST" action="{{ route('transacciones.store') }}">
                    @csrf
                    
                    <!-- tipo oculto -->
                    <input type="hidden" name="tipo" value="{{ $tipo }}">

                    <!-- MONTO -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted">Monto</label>
                        <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden">
                            <span class="input-group-text bg-body border-end-0 border-light-subtle text-muted">$</span>
                            <input type="number" step="0.01" name="monto" class="form-control border-start-0 border-light-subtle bg-body" placeholder="0.00" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <!-- FECHA -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted">Fecha</label>
                            <input type="date" name="fecha" class="form-control form-control-lg bg-body border-light-subtle shadow-sm rounded-3" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <!-- CATEGORÍA -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted">Categoría</label>
                            <select name="categoria_id" class="form-select form-select-lg bg-body border-light-subtle shadow-sm rounded-3" required>
                                <option value="" disabled selected>Selecciona...</option>
                                @foreach($categorias as $c)
                                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- MÉTODO -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted">Método de pago/cobro</label>
                        <select name="metodo_id" class="form-select form-select-lg bg-body border-light-subtle shadow-sm rounded-3" required>
                            <option value="" disabled selected>Selecciona un método...</option>
                            @foreach($metodos as $m)
                                <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted">Descripción (Opcional)</label>
                        <textarea name="descripcion" class="form-control bg-body border-light-subtle shadow-sm rounded-3" rows="3" placeholder="Detalles de la transacción..."></textarea>
                    </div>

                    <!-- BOTÓN GUARDAR -->
                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-lg {{ $tipo == 'ingreso' ? 'btn-success' : 'btn-danger' }} rounded-pill shadow-sm fw-bold">
                            <i class="bi bi-check2-circle me-2"></i> Guardar {{ ucfirst($tipo) }}
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection