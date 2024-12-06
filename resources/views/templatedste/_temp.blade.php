<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>DOSSIERS </title>
    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="16x16" href="logo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="cssdste/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="cssdste/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="cssdste/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="cssdste/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="cssdste/css/themes/all-themes.css" rel="stylesheet" />

    @yield('css')

</head>

<body class="theme-brown">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Patienté...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a class="navbar-brand" href="">{{ config('app.name') }}</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">



                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i
                                class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>


        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">PRINCIPAL</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">PARAMETRES</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="skins">
                    <ul class="demo-choose-skin">

                        @php($p = 0)
                        @php($pr = 0)
                        @if (count(session('auto_menu')) != 0)
                            @for ($i = 0; $i < count(session('auto_menu')); $i++)
                                @php($libelle = App\Providers\InterfaceServiceProvider::infomenu(session('auto_menu')[$i]))
                                @php($chv = App\Providers\InterfaceServiceProvider::verifie_ss(session('auto_menu')[$i]))

                                @if ($libelle->num_ordre != '500')
                                    @if ($pr == 0)
                                        @php($pr = 1)
                                    @endif
                                    <li>
                                        @if ($libelle->route != '#')
                                            <a href="{{ route($libelle->route) }}" style="color:#000"><i
                                                    class="large material-icons"
                                                    style="color:#001e60">insert_chart</i><span>{{ $libelle->libelleMenu }}</span></a>
                                        @endif
                                    </li>
                                @endif
                            @endfor
                        @endif
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade in " id="settings">
                    <div class="demo-settings">
                        <ul class="setting-list">
                            @php($p = 0)
                            @php($pr = 0)
                            @if (count(session('auto_menu')) != 0)
                                @for ($i = 0; $i < count(session('auto_menu')); $i++)
                                    @php($libelle = App\Providers\InterfaceServiceProvider::infomenu(session('auto_menu')[$i]))
                                    @php($chv = App\Providers\InterfaceServiceProvider::verifie_ss(session('auto_menu')[$i]))

                                    @if ($libelle->num_ordre == '500')
                                        @if ($p == 0)
                                            @php($p = 1)
                                        @endif
                                        <li>
                                            @if ($libelle->route != '#')
                                                <a href="{{ route($libelle->route) }}"
                                                    style="color:#000"><span>{{ $libelle->libelleMenu }}</span></a>
                                            @endif
                                        </li>
                                    @endif
                                @endfor
                            @endif
                            <li>
                                <div class="image">
                                    <center> <img src="cssdste/images/user.png" style="border-radius: 50%"
                                            width="88" height="88" alt="User" /> </center>
                                </div> <br>
                                <center><span>{{ session('utilisateur')->nom }}
                                        {{ session('utilisateur')->prenom }}</span> </center>
                                <br>
                                <center><span>(
                                        {{ App\Providers\InterfaceServiceProvider::LibelleRole(session('utilisateur')->Role) }}
                                        )</span> </center>
                            </li>

                            <li>
                                <center><a href="{{ route('logout') }}"><span>Déconnecter</span></a></center>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

    </section>

    <section class="content">
        @yield('content')

    </section>

    @yield('model')


    @yield('js')

    <!-- Jquery Core Js -->
    <script src="cssdste/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="cssdste/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="cssdste/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="cssdste/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="cssdste/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="cssdste/js/admin.js"></script>

    <script src="cssdste/js/pages/index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>

    <!-- Demo Js -->
    <script src="cssdste/js/demo.js"></script>
</body>

</html>
