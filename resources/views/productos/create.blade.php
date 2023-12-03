@extends('plantillas.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="precio_estandar">Precio Estandar</label>
                        <input type="number" class="form-control" id="precio_estandar" name="precio_estandar" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="precio_minimo">Precio Minimo</label>
                        <input type="number" class="form-control" id="precio_minimo" name="precio_minimo" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Producto</button>
        </form>
    </div>
@endsection
