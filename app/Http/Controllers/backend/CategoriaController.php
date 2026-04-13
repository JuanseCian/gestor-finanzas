<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('usuario_id', auth()->id())->get();

        return view('backend.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('backend.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:ingreso,gasto'
        ]);

        Categoria::create([
            'usuario_id' => auth()->id(),
            'nombre' => $request->nombre,
            'tipo' => $request->tipo
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada');
    }

    public function edit(Categoria $categoria)
    {
        $this->authorizeUser($categoria);

        return view('backend.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $this->authorizeUser($categoria);

        $categoria->update($request->only('nombre', 'tipo'));

        return redirect()->route('categorias.index')->with('success', 'Actualizada');
    }

    public function destroy(Categoria $categoria)
    {
        $this->authorizeUser($categoria);

        $categoria->delete();

        return back()->with('success', 'Eliminada');
    }

    private function authorizeUser($categoria)
    {
        if ($categoria->usuario_id !== auth()->id()) {
            abort(403);
        }
    }
}