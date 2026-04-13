<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Categoria;
use App\Models\Cuenta;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::where('usuario_id', auth()->id())
            ->latest()
            ->get();

        return view('backend.transacciones.index', compact('transacciones'));
    }

    public function create()
    {
        $categorias = Categoria::where('usuario_id', auth()->id())->get();
        $cuentas = Cuenta::where('usuario_id', auth()->id())->get();

        return view('backend.transacciones.create', compact('categorias', 'cuentas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:ingreso,gasto',
            'monto' => 'required|numeric|min:0',
            'fecha' => 'required|date'
        ]);

        Transaccion::create([
            'usuario_id' => auth()->id(),
            'tipo' => $request->tipo,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'cuenta_id' => $request->cuenta_id,
            'fecha' => $request->fecha
        ]);

        return redirect()->route('transacciones.index')->with('success', 'Transacción creada');
    }

    public function edit(Transaccion $transaccion)
    {
        $this->authorizeUser($transaccion);

        $categorias = Categoria::where('usuario_id', auth()->id())->get();
        $cuentas = Cuenta::where('usuario_id', auth()->id())->get();

        return view('backend.transacciones.edit', compact('transaccion', 'categorias', 'cuentas'));
    }

    public function update(Request $request, Transaccion $transaccion)
    {
        $this->authorizeUser($transaccion);

        $transaccion->update($request->all());

        return redirect()->route('transacciones.index')->with('success', 'Actualizada');
    }

    public function destroy(Transaccion $transaccion)
    {
        $this->authorizeUser($transaccion);

        $transaccion->delete();

        return back()->with('success', 'Eliminada');
    }

    private function authorizeUser($transaccion)
    {
        if ($transaccion->usuario_id !== auth()->id()) {
            abort(403);
        }
    }
}