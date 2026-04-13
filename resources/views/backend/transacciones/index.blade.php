@extends('layouts.app')

@section('content')

<!-- ENCABEZADO -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
    <div>
        <h2 class="fw-bold mb-0">Mis Transacciones</h2>
        <p class="text-muted mb-0">Historial de todos tus movimientos financieros</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('transacciones.create', ['tipo' => 'ingreso']) }}" class="btn btn-success rounded-pill shadow-sm fw-medium px-3">
            <i class="bi bi-plus-lg me-1"></i> Ingreso
        </a>
        <a href="{{ route('transacciones.create', ['tipo' => 'gasto']) }}" class="btn btn-danger rounded-pill shadow-sm fw-medium px-3">
            <i class="bi bi-dash-lg me-1"></i> Gasto
        </a>
    </div>
</div>

<!-- TABLA DE TRANSACCIONES -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body-tertiary">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4 py-3 text-muted fw-semibold">Fecha</th>
                    <th class="py-3 text-muted fw-semibold">Tipo</th>
                    <th class="py-3 text-muted fw-semibold">Método</th>
                    <th class="py-3 text-muted fw-semibold">Monto</th>
                    <th class="pe-4 py-3 text-muted fw-semibold text-end">Acciones</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($transacciones as $t)
                <tr>
                    <td class="ps-4 py-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-calendar-event text-secondary"></i>
                            <!-- Suponiendo que la fecha es un string 'Y-m-d', si es un objeto Carbon puedes usar format() -->
                            <span>{{ $t->fecha }}</span>
                        </div>
                    </td>
                    <td class="py-3">
                        @if(strtolower($t->tipo) == 'ingreso')
                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 border border-success-subtle">
                                <i class="bi bi-arrow-down-circle me-1"></i> Ingreso
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill px-3 py-2 border border-danger-subtle">
                                <i class="bi bi-arrow-up-circle me-1"></i> Gasto
                            </span>
                        @endif
                    </td>
                    <td class="py-3">
                        <span class="text-body-secondary"><i class="bi bi-wallet2 me-1"></i> {{ $t->metodo->nombre ?? 'N/A' }}</span>
                    </td>
                    <td class="py-3">
                        <span class="fw-bold fs-5 {{ strtolower($t->tipo) == 'ingreso' ? 'text-success' : 'text-danger' }}">
                            {{ strtolower($t->tipo) == 'ingreso' ? '+' : '-' }}${{ number_format($t->monto, 2, ',', '.') }}
                        </span>
                    </td>
                    <td class="pe-4 py-3 text-end">
                        <a href="{{ route('transacciones.edit', $t) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 me-1" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form method="POST" action="{{ route('transacciones.destroy', $t) }}" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta transacción?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" title="Eliminar">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-inbox fs-1 mb-3 d-block"></i>
                            <h5 class="fw-medium">No hay transacciones registradas</h5>
                            <p>Comienza agregando tu primer ingreso o gasto.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection