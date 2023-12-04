<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index2()
    {
        $productos = Producto::all();
        return view('productos.vender', compact('productos'));
    }
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }
    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreImagen = $file->getClientOriginalName();
            $file->storeAs('public/imagenes', $nombreImagen);
            $data['imagen'] = $nombreImagen;
        }

        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio_estandar = $request->precio_estandar;
        $producto->precio_minimo = $request->precio_minimo;
        $producto->stock = $request->stock;
        $producto->imagen = $data['imagen'];
        $producto->save();

        return redirect()->route('admin.productos.index');
    }
    public function recargarStock($id)
    {
        $producto = Producto::find($id);
        return view('productos.recargarStock', ['producto' => $producto]);
    }
    public function cargar(Request $request){
        $producto = Producto::find($request->id);
        $producto->stock += $request->cantidad;
        $producto->save();
        return redirect()->action([ProductoController::class, 'index']);
    }
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
