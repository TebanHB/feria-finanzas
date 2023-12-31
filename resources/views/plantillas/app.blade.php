<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('qrcode-solid.svg') }}">
    <title>PymeSecureQR</title>
    @stack('css')
    <!-- Custom fonts for this template-->
    <link href="{{ asset('libs/sbadmin/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PymeSecure<sup>QR</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Productos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Productos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opciones:</h6>
                        <a class="collapse-item" href="{{ route('admin.productos.index') }}">Productos</a>
                        <a class="collapse-item" href="{{ route('escoger.productos') }}">Vender Productos</a>
                        <a class="collapse-item" href="{{ route('admin.productos.create') }}">Agregar Producto</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Vender
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-cash-register"></i>
                    <span>Registrar Venta</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Metodo de cobro:</h6>
                        <a class="collapse-item" href="{{ route('pago.qr') }}">QR</a>
                        <a class="collapse-item" href="#">Efectivo</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a id="github" class="nav-link" href="#">
                    <i class="fab fa-github"></i>
                    <span>GitHub Update</span>
                </a>
            </li>
            <script>
                document.querySelector('#github').addEventListener('click', function(e) {
                    e.preventDefault();
                    fetch('/git-pull', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Git pull fue exitoso');
                            } else {
                                console.log('Git pull falló');
                            }
                        });
                });
            </script>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars">
                        </i>
                    </button>

                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart fa-fw"></i> <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">
                                    {{ count(session()->get('carrito', [])) }}
                                </span> </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Carrito de compras
                                </h6>
                                @foreach (session()->get('carrito', []) as $producto)
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-shopping-cart text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">{{ $producto['nombre'] }} </div>
                                            <span class="font-weight-bold">{{ $producto['cantidad'] }}</span>
                                        </div>
                                    </a>
                                @endforeach
                                <a id="vaciar-carrito" class="dropdown-item text-center small text-gray-500 bg-danger"
                                    href="#">Vaciar Carrito</a>

                                <script>
                                    var csrfToken = '{{ csrf_token() }}';

                                    document.getElementById('vaciar-carrito').addEventListener('click', function(event) {
                                        event.preventDefault();

                                        fetch('/carrito/vaciar', {
                                                method: 'GET',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'Content-Type': 'application/json'
                                                }
                                            }).then(response => response.json())
                                            .then(data => {
                                                console.log(data);
                                                if (data.success) {
                                                    alert('Carrito vaciado');
                                                    // Aquí puedes actualizar la interfaz de usuario para reflejar que el carrito está vacío
                                                } else {
                                                    alert('Hubo un error al vaciar el carrito');
                                                }
                                            })
                                            .catch((error) => {
                                                console.error('Error:', error);
                                            });
                                    });
                                </script>
                                <a id="vender-carrito"
                                    class="dropdown-item text-center small text-gray-500 bg-success text-white"
                                    href="#">Vender Carrito</a>
                                    <script>
                                        var csrfToken = '{{ csrf_token() }}';

                                        document.getElementById('vender-carrito').addEventListener('click', function(event) {
                                            event.preventDefault();

                                            fetch('/carrito/vender', {
                                                method: 'GET',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'Content-Type': 'application/json'
                                                }
                                            }).then(response => response.json())
                                            .then(data => {
                                                console.log(data);
                                                if (data.success) {
                                                    alert('Productos vendidos');
                                                    // Aquí puedes actualizar la interfaz de usuario para reflejar que el carrito está vacío
                                                } else {
                                                    alert('Hubo un error al vender los productos');
                                                }
                                            })
                                            .catch((error) => {
                                                console.error('Error:', error);
                                            });
                                        });
                                    </script>
                                
                                @php
                                    $carrito = session()->get('carrito', []);
                                    $total = 0;

                                    foreach ($carrito as $producto) {
                                        $total += $producto['precio'] * $producto['cantidad'];
                                    }
                                @endphp

                                <!-- Imprime todo el carrito -->
                                <a class="dropdown-item text-center small text-gray-500" href="#">
                                    Total: {{ $total }}
                                </a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="https://static.vecteezy.com/system/resources/previews/008/433/595/large_2x/person-icon-for-website-symbol-presentation-free-vector.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout.get') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libs/sbadmin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/sbadmin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
