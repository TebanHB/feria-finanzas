@extends('plantillas.app')
@push('css')
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
@endpush
@section('content')
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
                <span class="precio_minimo" id="precio_minimo"></span>
                <br>
                <span class="stock" id="stock"></span>
                <span hidden class="id" id="id"></span>
                <br>
                <input type="number" id="cantidad" name="cantidad" min="1" class="form-control" placeholder="Cantidad">
                <button id="agregarCarrito" name="agregarCarrito" class="btn btn-primary" onclick="agregarCarrito()">Agregar al carrito</button>
                <script>
                    var csrfToken = '{{ csrf_token() }}';

                    function agregarCarrito() {
                        var id = document.getElementById('id').innerText;
                        var cantidad = document.getElementById('cantidad').value;

                        fetch('/productos/agregarcarrito/' + id + '/' + cantidad, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id,
                                cantidad: cantidad
                            })
                        }).then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.success) {
                                alert('Producto agregado al carrito');
                            } else {
                                alert('Hubo un error al agregar el producto al carrito');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                    }
                </script>
                <span class="precio" id="precio">$ 130</span>

                <div class="fila">
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/script2.js') }}"></script>
@endsection
