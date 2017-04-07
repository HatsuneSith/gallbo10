<!DOCTYPE html>
<html lang="es">
<head >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        @yield('title')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/fileinput.min.css')}}
    {{HTML::style('css/mvpready-admin.css')}}
    {{HTML::style('css/jasny-bootstrap.min.css')}}
    {{HTML::style('css/jquery.dataTables.css')}}
    {{HTML::style('css/kendo.common.min.css')}}
    {{HTML::style('css/kendo.default.min.css')}}
    {{HTML::style('css/bootstrap-datetimepicker.min.css')}}
    {{HTML::style('css/style.css')}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    {{HTML::script('js/fileinput.min.js')}}
    
    {{HTML::script('js/fileinput_locale_es.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    
    
    {{HTML::script('js/funciones.js')}}
    @yield('js')


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body >

    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
        <a class="navmenu-brand" href="{{url('/')}}">HOME</a>
        
        <ul class="nav navmenu-nav">
            <li class="dropdown-header"><span><i class="fa fa-user fa-fw"></i></span>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</li>
            <li><a href="{{ url('logout') }}"><span><i class="fa fa-sign-out fa-fw"></i></span> Salir</a></li>
            
        </ul>         
    </div>

    <div class="navbar navbar-default navbar-fixed-top">
        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" tabindex="-1"  aria-hidden="true">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>


    <section class="principal" id="principal">
            <div class="contenido container">
            @yield('contenido')

            </div>
    </section>

    @yield('modals')

                             
    <!-- jQuery -->
    {{HTML::script('js/jquery.js')}}
    {{HTML::script('js/moment-with-locales.min.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/bootstrap-datetimepicker.min.js')}}
    {{HTML::script('js/jquery.dataTables.js')}}
    {{HTML::script('js/datatable.js')}}
    {{HTML::script('js/jasny-bootstrap.min.js')}}
    {{HTML::script('js/kendo.ui.core.min.js')}}

    @yield('jsfoot')


    


</body>
</html>
