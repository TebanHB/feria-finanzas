<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function mostrarCarrito()
    {
        // Tu código para mostrar los productos en el carrito aquí
    }

    public function agregarAlCarrito($id, $cantidad)
    {
        $producto = Producto::find($id);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] += $cantidad;
        } else {
            $carrito[$id] = [
                'nombre' => $producto->nombre,
                'cantidad' => $cantidad,
                'precio' => $producto->precio
            ];
        }

        session()->put('carrito', $carrito);

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito'
        ]);
    }
    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);

        return response()->json([
            'success' => true,
            'carrito' => $carrito
        ]);
    }
    public function eliminarDelCarrito($id)
    {
        // Tu código para eliminar un producto del carrito aquí
    }

    public function comprar()
    {
        // Tu código para procesar la compra de los productos en el carrito aquí
    }
}
