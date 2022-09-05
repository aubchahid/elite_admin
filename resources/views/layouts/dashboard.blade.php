<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>DMPRO - {{ $title }}</title>
    <link href="{{ asset('dist/css/pages/ecommerce.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    @livewireStyles
    <style>
        #swal2-title {
            font-size: 14px;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            color: #1e2022;
            line-height: 20px !important;
        }

        .swal2-popup.swal2-toast {
            box-sizing: border-box;
            grid-column: 1/4 !important;
            grid-row: 1/4 !important;
            grid-template-columns: 1fr 99fr 1fr;
            padding: 1em;
            overflow-y: hidden;
            background: #fff;
            border-radius: 25px;
            box-shadow: none !important;
            pointer-events: all;
        }
    </style>

</head>

<body class="skin-default fixed-layout">

    <!-- Start Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">DMPRO</p>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Main wrapper -->
    <div id="main-wrapper">
        <!-- Topbar header -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark" style="background-color: #7BC2B8">
                <!-- Start Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('dist/images/logo-light-icon.png') }}" alt="here-1"
                                class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="dist/images/logo-light-icon.png" alt="here-2" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <!-- dark Logo text -->
                            <img src="{{ asset('dist/images/logo-light-text.png') }}" alt="here-3"
                                class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="dist/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"> <a
                                class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark text-white"
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a
                                class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark text-white"
                                href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- End Topbar header -->

        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div>
                            <img src="{{ asset('dist/images/' . Auth::user()->photo) }}" alt="user-img"
                                class="img-circle" style="width: 45px;height:45px;object-fit:cover">
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu"
                                data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">{{ Auth::user()->name }}
                            </a>

                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">--- Menu principal </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/" aria-expanded="false">
                                <i class="icon-grid"></i>
                                <span class="hide-menu">Page d'accueil</span></a>
                        </li>

                        <li>
                            <a class="waves-effect waves-dark" href="/factures" aria-expanded="false"><i
                                    class="icon-docs"></i>
                                <span class="hide-menu">Factures</span></a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/clients" aria-expanded="false"><i
                                    class="icon-people"></i>
                                <span class="hide-menu">Clients</span></a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/products" aria-expanded="false"><i
                                    class="icon-social-dropbox"></i>
                                <span class="hide-menu">Produits</span></a>
                        </li>
                        <li class="nav-small-cap">--- Menu secondaire </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/profile" aria-expanded="false"><i
                                    class="icon-user"></i>
                                <span class="hide-menu">Profil</span></a>
                        </li>

                        <li>
                            <a class="waves-effect waves-dark" href="/logout" aria-expanded="false"><i
                                    class="icon-logout"></i>
                                <span class="hide-menu">Se déconnecter</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        {{ $slot }}
    </div>
    <!-- End Wrapper -->

    <!-- scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    <script>
        window.livewire.on('success', () => {
            $("#newClient").modal('hide');
            $("#deleteClient").modal('hide');
            $("#editClient").modal('hide');
            $("#newProduct").modal('hide');
            $("#deleteProduct").modal('hide');
            $("#editProduct").modal('hide');
            $("#rechargeProduct").modal('hide');
            $("#deleteFacture").modal('hide');
            $("#payer").modal('hide');
        });
        window.addEventListener('contentChanged', e => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: event.detail.item,
            })
        });
        window.addEventListener('failedTask', e => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'error',
                title: event.detail.item,
            })
        })
    </script>
    <!-- Jquery files -->
    <script src="{{ asset('dist/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('dist/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('dist/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/ecom-dashboard.js"></script>
</body>

</html>
