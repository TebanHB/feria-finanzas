@extends('plantillas.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid py-5 container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 text-center">
                <h3>Generar cobro QR</h3>
                <div class="card">
                    <h5 class="text-center mb-4">Datos de venta</h5>
                    <form class="form-card" action="/consumirServicio" method="POST" target="QrImage">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Razon Social</label>
                                <input class="form-control" type="text" name="tcRazonSocial"
                                    placeholder="Nombre del Usuario">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">CI/NIT</label>
                                <input class="form-control" type="text" name="tcCiNit" placeholder="Número de CI/NIT">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Celular</label>
                                <input class="form-control" type="text" name="tnTelefono"
                                    placeholder="Número de Teléfono">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Correo</label>
                                <input class="form-control" type="text" name="tcCorreo" placeholder="Correo Electrónico">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Monto Total</label>
                                <input class="form-control" type="text" name="tnMonto" placeholder="Costo Total">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Tipo de Servicio</label>
                                <select class="form-control" name="tnTipoServicio" class="form-control">
                                    <option value="1">Servicio QR</option>
                                    <option value="2">Tigo Money</option>
                                </select>
                            </div>

                        </div>
                        <h5 class="text-center mt-4">Datos del Producto</h5>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Serial</label>
                                <input class="form-control" type="text" name="taPedidoDetalle[0][Serial]" placeholder="">
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Producto</label>
                                <input class="form-control" type="text" name="taPedidoDetalle[0][Producto]"
                                    placeholder="">
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Cantidad</label>
                                <input readonly class="form-control" type="text" name="taPedidoDetalle[0][Cantidad]" value="{{ count(session()->get('carrito', [])) }}" placeholder="">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Precio</label>
                                @php
                                    $total = 0;
                                    $carrito = session()->get('carrito', []);
                                    foreach ($carrito as $producto) {
                                        $total += $producto['precio'] * $producto['cantidad'];
                                    }
                                @endphp
                                <input class="form-control" type="text" name="taPedidoDetalle[0][Precio]" value="{{ $total }}" placeholder="" readonly>                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Descuento</label>
                                <input readonly value="0" class="form-control" type="text" name="taPedidoDetalle[0][Descuento]"
                                    placeholder="">
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Total</label>
                                <input value="{{ $total }}" readonly class="form-control" type="text" name="taPedidoDetalle[0][Total]" placeholder="">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6">
                                <button type="submit" class="btn-block btn-primary">Consumir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 py-5">
                <div class="row d-flex justify-content-center">
                    <iframe name="QrImage" style="width: 100%; height: 495px;"></iframe>
                </div>
                <div class="flex justify-center mt-4">
                    <div class="flex justify-center">
                        <button id="searchButton" class="flex justify-center">
                            {{ __('Consultar Pedido') }}
                        </button>
                        <div id="userModal"
                            class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center">
                            <div class="bg-white p-8 rounded shadow-lg">
                                <p id="mensaje" class="text-xl font-bold mb-4">Nombre de usuario encontrado</p>
                                <button id="closeModal"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 focus:outline-none focus:bg-gray-400">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            // Realizar la solicitud AJAX
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = xhr.responseText;
                        if (response.trim() === 'COMPLETADO-EN COLA') { // Ejemplo de cómo verificar la cadena
                            showModal('Su pedido no fue confirmado!');
                        } else if (response.trim() === 'COMPLETADO-PROCESADO') {
                            showModal('Su pedido fue pagado con Exito!');
                        } else {
                            showModal('Su pedido no fue encontrado!');
                        }
                    } else {
                        showModal('Error al buscar pedido!');
                    }
                }
            };

            xhr.open('GET', "#",
                true); // Reemplaza esto con tu ruta y método de búsqueda
            xhr.send();
        });

        function showModal(mensaje) {
            const modal = document.getElementById('userModal');
            const modalUserName = document.getElementById('mensaje');
            modalUserName.textContent = mensaje;
            modal.classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
@endsection
