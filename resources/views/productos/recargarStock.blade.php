@extends('plantillas.app')

@section('content')
<div class="container">
    <h1>Recargar Stock</h1>
    <h2>Producto: {{ $producto->nombre }}</h2>
    <img src="{{ asset('storage/imagenes/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="150" height="150">    <p>Stock actual: {{ $producto->stock }}</p>
    <form action="/recargarStock" method="POST">
        @csrf
        <div class="form-group">
            <label for="cantidad">Cantidad de Stock</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad de stock">
            <input type="hidden" name="id" value="{{ $producto->id }}">
        </div>
        <button type="submit" class="btn btn-primary">Recargar Stock</button>
    </form>
</div>
@endsection