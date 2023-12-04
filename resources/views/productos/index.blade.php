@extends('plantillas.app')
@push('css')
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section class="contenido">
        <div class="mostrador" id="mostrador">
            <div class="fila">
                @foreach ($productos as $producto)
                    <div class="item" onclick="cargar(this,{{$producto}})">
                        <div class="contenedor-foto">
                            <img src="{{ asset('storage/imagenes/' . $producto->imagen) }}" alt="">
                        </div>
                        <p class="descripcion">{{ $producto->nombre }}</p>
                        <span class="precio">Bs {{ $producto->precio_estandar }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- CONTENEDOR DEL ITEM SELECCIONADO -->
        <div class="seleccion" id="seleccion">
            <div class="cerrar" onclick="cerrar()">
                &#x2715
            </div>
            <div class="info">
                <img src="img/1.png" alt="" id="img">
                <h2 id="modelo">NIKE MODEL 1</h2>
                <span class="precio_minimo" id="precio_minimo">SEXO</span>
                <span class="stock" id="stock">SEXO</span>
                <span class="id" id="id">SEXO</span>
                <button id="recargarStock" name="recargarStock" onclick="recargarStock()">Recargar Stock</button>
                <script>
                    function recargarStock() {
                        var id = document.getElementById('id').innerText;
                        window.location.href = '/productos/recargarstock/' + id;
                    }
                </script>
                <span class="precio" id="precio">$ 130</span>

                <div class="fila">
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
