@extends('plantillas.app')
@push('css')
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section class="contenido">
        <div class="mostrador" id="mostrador">
            <div class="fila">
                @foreach ($productos as $producto)
                    <div class="item" onclick="cargar(this)">
                        <div class="contenedor-foto">
                            <img src="{{ asset($producto->imagen) }}" alt="">
                        </div>
                        <p class="descripcion">{{ $producto->nombre }}</p>
                        <input type="hidden" id="precio_minimo" value="{{ $producto->precio_minimo }}">
                        <input type="hidden" id="stock" value="{{ $producto->stock }}">
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
                <p id="descripcion">SEXO</p>
                <p id="precio-minimo-mostrado"></p>
                <p id="stock-mostrado"></p>
                <span class="precio" id="precio">$ 130</span>

                <div class="fila">
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
