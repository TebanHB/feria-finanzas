<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function venderCarrito()
    {
        try {
            $carrito = session()->get('carrito', []);

            foreach ($carrito as $producto) {
                $productoEnBase = Producto::find($producto['id']);
                if (!$productoEnBase) {
                    return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
                }
                $productoEnBase->stock -= $producto['cantidad'];
                $productoEnBase->save();
            }

            session()->forget('carrito');

            return response()->json([
                'success' => true,
                'message' => 'Productos vendidos'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function agregarAlCarrito($id, $cantidad)
    {
        $producto = Producto::find($id);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] += $cantidad;
        } else {
            $carrito[$id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'cantidad' => $cantidad,
                'precio' => $producto->precio_estandar
            ];
        }

        session()->put('carrito', $carrito);

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito'
        ]);
    }
    public function vaciarCarrito()
{
    session()->forget('carrito');

    return response()->json([
        'success' => true,
        'message' => 'Carrito vaciado'
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
