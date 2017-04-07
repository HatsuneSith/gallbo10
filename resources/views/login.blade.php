<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SIRE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/style.css')}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>



	<div class="container">
		
		{{ Form::open(array('url' => 'login', 'class' => 'form-signin')) }}
			<div class="signin-img" >
			<img  src="http://www.gallbo.com/img/gallbo_reclamacion_estrategica.png">
			</div>
			<label for="" class="sr-only">Correo</label>
			<input type="text" id="email" name="email" class="form-control" placeholder="Correo" required autofocus>
			<label for="" class="sr-only">Password</label>
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			<div class="checkbox">
				<label>
				<input type="checkbox" name="recordar"> Recuérdame
				</label>
			</div>
			@if (Session::has('mensaje_login'))
			 	<br>
			 	<div class="alert alert-danger">
			 		{{ Session::get('mensaje_login') }}
			 	</div>
			@endif
			<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesion</button>

		{{ Form::close() }}

	</div>

    <!-- jQuery -->
    {{HTML::script('js/jquery.js')}}
    {{HTML::script('js/bootstrap.min.js')}}

</body>

</html>
