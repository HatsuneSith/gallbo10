<!DOCTYPE html>
<html lang="es">
<head >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SIRE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href='http://fonts.googleapis.com/css?family=Ubuntu|Roboto|Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/mvpready-admin.css')}}
    {{HTML::style('css/jquery.dataTables.css')}}
    {{HTML::style('css/style.css')}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    {{HTML::script('js/funciones.js')}}


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">


    </script>
</head>
<body  class="index" data-spy="scroll" data-target="#navegador" data-offset="200">

        <header class="navbar navbar-default navbar-fixed-top shadow" id="header" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a href="{{url('/')}}" class="navbar-brand">HOME</a>
                    <!--<a href="{{url('/')}}"><img class="navbar-brand" src="img/logogallbo.png" alt="Logo Gallbo"></a>-->
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse" id="navegador">
                    <ul class="nav navbar-nav">
                        <!--<li></i>{{HTML::link('/', '<i class="fa fa-home fa-fw">Home')}}</li>-->
                        <!--<li><a href="{{url('/')}}"><i class="fa fa-home fa-fw"></i>Home</a></li>-->
                        @yield('menu')
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @yield('menu-derecha')
            
                        <!--<li>{{HTML::link('#', Auth::user()->nombre)}}</li>
                        <li>{{HTML::link('logout', 'Salir')}}</li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span><i class="fa fa-user fa-fw"></i></span>{{Auth::user()->nombre}} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('logout') }}"><span><i class="fa fa-sign-out fa-fw"></i></span> Salir</a></li>

                            </ul>
                        </li>


                    </ul>
                </div>
            </div>
        </header>

        <section class="principal" id="principal">
                <div class="contenido container">
                @yield('contenido')

                </div>
            </div>

        </section>




        <!--<footer class="clase-general" id="footer">
            <div class="container">
                <hr>
                <p>© 2015 Gallbo. Todos los derechos reservados</p>
                <br>
            </div>
        </footer>-->
                             
    <!-- jQuery -->
    {{HTML::script('js/jquery.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/jquery.dataTables.js')}}
    {{HTML::script('//cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js') }}
    {{HTML::script('js/datatable.js')}}



</body>
</html>
