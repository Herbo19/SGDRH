<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset("vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset("css/sb-admin-2.min.css")}}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Custom styles for Tabelas page -->
    <link href="{{asset("vendor/datatables/dataTables.bootstrap4.min.css")}}" rel="stylesheet">

    <script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



</head>

<body id="page-top">



    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/home')}}">
                <div class="sidebar-brand-text mx-5">SGDRH</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Home -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('/home')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Principal</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Desempenho
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link" @if (auth()->user()->role == 'admin') href="{{ url('admin') }}" @else href="{{route('dashboard.index', auth()->user())}}" @endif>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Desempenho</span></a>
            </li>

            <!--Secção do Metas - Menu-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#metaMenu"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-bullseye"></i>
                    <span>Metas</span>
                </a>
                <div id="metaMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções:</h6>
                        @if (auth()->user()->role == 'admin')
                        <a class="collapse-item" href="{{url('metas')}}">Ver todos</a>
                        @endif
                        <a class="collapse-item" href="{{url('metas/create')}}">Adicionar novo</a>
                        <a class="collapse-item" href="{{route('minhameta')}}">Metas</a>
                    </div>
                </div>
            </li>
            <!-- FIM Secção do Metas - Menu-->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipaMenu"
                aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>Equipa</span>
                </a>
                <div id="equipaMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções:</h6>
                        <a class="collapse-item" href="{{ route('equipa.minhas_metas',auth()->user()->id) }}">Minhas Equipas</a>
                    </div>
                </div>
            </li>

            @if (auth()->user()->role == 'admin')
            <x-admin-sidebaronly></x-admin-sidebaronly>
            @endif


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


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
                        <i class="fa fa-bars"></i>
                    </button>

                    @if (auth()->user()->role == 'admin')
                    <!-- Topbar Search -->
                    <x-topbar-search-admin></x-topbar-search-admin>
                    @endif

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                            @include('components.navitem-alert', ['user' => Auth::user()])



                        <!-- Nav Item - Messages -->
                        <x-navitem-messages></x-navitem-messages>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <x-admin-top-navbar-user-information></x-admin-top-navbar-user-information>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Inicio Mian Page Content -->
                <div class="container-fluid">
                  @yield('content')
                </div>
                <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container mt-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SGDRH 2023</span>
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



    <!-- Bootstrap core JavaScript-->

    <script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset("vendor/jquery-easing/jquery.easing.min.js")}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset("js/sb-admin-2.min.js")}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset("vendor/chart.js/Chart.min.js")}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset("js/demo/chart-area-demo.js")}}"></script>
    <script src="{{asset("js/demo/chart-pie-demo.js")}}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript">

        var path = "{{ route('autocomplete') }}";

        var pathFunc = "{{ route('index.index') }}";

        $( "#search" ).autocomplete({

            source: function( request, response ) {

              $.ajax({

                url: path,

                type: 'GET',

                dataType: "json",

                data: {

                   search: request.term

                },

                success: function( us ) {

                   response( us );

                }

              });

            },

            select: function (event, ui) {

               $('#search').val(ui.item.label);

               console.log(ui.item);

               return false;

            }

          });





          var route = "{{ url('autocomplete-search') }}";
        $('#searchFunc').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });


    </script>

    <!-- Page level plugins Tabelas -->
    <script src="{{asset("vendor/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>

    <!-- Page level custom scripts Tabelas-->
    <script src="{{asset("js/demo/datatables-demo.js")}}"></script>



</body>

</html>
