<!DOCTYPE html>
<html lang="es">
<head >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        @yield('title')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/fileinput.min.css')}}
    {{HTML::style('css/mvpready-admin.css')}}
    {{HTML::style('css/jasny-bootstrap.min.css')}}
    {{HTML::style('css/jquery.dataTables.css')}}
    {{HTML::style('css/kendo.common.min.css')}}
    {{HTML::style('css/kendo.default.min.css')}}
    {{HTML::style('css/bootstrap-datetimepicker.min.css')}}
    {{HTML::style('css/style.css')}}

    <script src="https://use.fontawesome.com/69b42211ae.js"></script>
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
            <li class="dropdown-header"><span><i class="fa fa-user fa-fw"></i></span>{{Auth::user()->nombre}}</li>
            <li><a href="{{ url('usuario/perfil') }}"><span><i class="fa fa-user fa-fw"></i></span> Perfil</a></li>
            <li><a href="{{ url('logout') }}"><span><i class="fa fa-sign-out fa-fw"></i></span> Salir</a></li>
            
        </ul>
        <ul class="nav navmenu-nav" style="background-color: gainsboro;">
            <li class="dropdown-header">Tareas</li>
            <li><a href="{{ url('tareas/nueva') }}">Crear Tarea</a></li>
            <li><a href="{{ url('tareas/lista') }}">Ver Tareas</a></li>
        </ul>

        <ul class="nav navmenu-nav">
            <li class="dropdown-header">Compromisos y Metas</li>
            <li><a href="{{ url('sire/compromisos') }}">Crear y Ver Compromisos</a></li>
            <!-- <li><a href="{{ url('sire/metas_markoptic') }}">Metas Markoptic</a></li> -->
            <li><a href="{{ url('sire/indicadores') }}">Metas Gallbo</a></li>
        </ul>

        <ul class="nav navmenu-nav" style="background-color: gainsboro;">
            <li class="dropdown-header">Analytics</li>
            <li><a href="{{url('tareas/reportes/usuarios')}}"> Reporte de Tareas por Usuario</a></li>
            <li><a href="{{url('tareas/reportes/departamento')}}">Reporte de Tareas por Depto.</a></li>
            <li><a href="{{url('sire/compromisos/reportes')}}">Reporte de Compromisos</a></li>
        </ul>
        <ul class="nav navmenu-nav">
            <li class="divider"></li>
            <li class="dropdown-header">SIRE</li>
            <li class="dropdown-header">Promocion</li>
            <li><a href="{{url('sire/promocion/busqueda')}}">Búsqueda de Siniestros</a></li>
            <li><a href="{{url('sire/promocion/siniestros')}}">Siniestros Encontrados</a></li>
            <li class="dropdown-header">Reclamacion</li>
            <li><a href="{{url('sire/reclamacion')}}">Siniestros</a></li>
            <li class="dropdown-header">Jurídico</li>
            <li><a href="{{url('sire/juridico')}}">Juicios</a></li>
            <li class="dropdown-header">Configuración</li>
            <li><a href="{{ url('sire/configuracion/usuarios') }}">Usuarios</a></li>
            
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


        <!--<footer class="clase-general" id="footer">
            <div class="container">
                <hr>
                <p>© 2015 Gallbo. Todos los derechos reservados</p>
                <br>
            </div>
        </footer>-->
                             
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
