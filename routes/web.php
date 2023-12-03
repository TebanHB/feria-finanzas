<?php

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
Route::get('/admin', function() {
    return view('index');
})->middleware('auth')->name('admin');
Route::get('/admin/login', function() {
    return view('login');
})->name('login');
Route::get('/admin/register', function() {
    return view('register');
})->name('register');
Route::post('/git-pull', function () {
    exec('git pull', $output, $return_var);
    return ['success' => $return_var === 0, 'output' => $output];
});
Route::get('/home', function() {
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
Route::post('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::resource('productos', ProductoController::class)->names('admin.productos');
