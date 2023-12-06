<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PagosPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('index');
})->middleware('auth')->name('admin');
Route::get('/admin/login', function () {
    return view('login');
})->name('login');
Route::get('/admin/register', function () {
    return view('register');
})->name('register');
Route::post('/git-pull', function () {
    exec('git pull', $output, $return_var);
    return ['success' => $return_var === 0, 'output' => $output];
});
Route::get('/home', function () {
    return redirect('/admin');
})->name('home');
// Ruta para mostrar el formulario de login
Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// Ruta para procesar el formulario de login
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
// Ruta para mostrar el formulario de registro
Route::get('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
// Ruta para procesar el formulario de registro
Route::post('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout.post');
Route::get('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout.get');
Route::resource('productos', ProductoController::class)->middleware('auth')->names('admin.productos');
Route::get('/productos/recargarstock/{id}', [ProductoController::class, 'recargarStock'])->middleware('auth');
Route::post('/recargarStock', [ProductoController::class, 'cargar'])->middleware('auth');
Route::get('/escogerProductos', [ProductoController::class, 'index2'])->middleware('auth')->name('escoger.productos');
Route::post('/productos/agregarcarrito/{id}/{cantidad}', [CarritoController::class, 'agregarAlCarrito'])->middleware('auth')->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'verCarrito'])->middleware('auth')->name('carrito.ver');
Route::get('/cobro/qr', function(){
    return view('cobros.cobroqr');
})->middleware('auth')->name('pago.qr');
Route::post('/consumirServicio', [PagosPageController::class, 'RecolectarDatos'])->middleware('auth');
Route::post('/consultar', [PagosPageController::class, 'ConsultarEstado'])->middleware('auth');
Route::get('/carrito/vaciar', [CarritoController::class, 'vaciarCarrito'])->middleware('auth')->name('carrito.vaciar');
Route::get('/carrito/vender', [CarritoController::class, 'venderCarrito'])->middleware('auth')->name('carrito.vender');