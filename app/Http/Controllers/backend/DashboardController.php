<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Categoria;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $filtro = $request->filtro ?? 'mes';

        $query = Transaccion::where('usuario_id', $userId);

        switch ($filtro) {

            case 'hoy':
                $query->whereDate('fecha', Carbon::today());
                break;

            case 'semana':
                $query->whereBetween('fecha', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
                break;

            case 'anio':
                $query->whereYear('fecha', now()->year);
                break;

            case 'personalizado':
                if ($request->anio) {
                    $query->whereYear('fecha', $request->anio);
                }

                if ($request->mes) {
                    $query->whereMonth('fecha', $request->mes);
                }
                break;

            default: // mes actual
                $query->whereMonth('fecha', now()->month)
                    ->whereYear('fecha', now()->year);
                break;
        }

        $ingresos = (clone $query)->where('tipo', 'ingreso')->sum('monto');
        $gastos = (clone $query)->where('tipo', 'gasto')->sum('monto');
        $balance = $ingresos - $gastos;
        $categorias = Categoria::where('usuario_id', auth()->id())->get();

        return view('backend.dashboard', compact(
            'ingresos',
            'gastos',
            'balance',
            'filtro',
            'categorias'
        ));
    }
      
}