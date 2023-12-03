<?php

use Illuminate\Support\Facades\Route;

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
});
Route::get('/admin/login', function() {
    return view('login');
});
Route::get('/admin/register', function() {
    return view('register');
});
Route::post('/git-pull', function () {
    exec('git pull', $output, $return_var);
    return ['success' => $return_var === 0, 'output' => $output];
});
