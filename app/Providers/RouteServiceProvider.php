<?php namespace App\Providers;

use Illuminate\Support\Facades\Redirect;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		Route::filter('filtro_admin', function() 
		{
		    if (Auth::user()->rol != 'Directivo')
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});

		Route::filter('filtro_analytics', function() 
		{
		    if ((Auth::user()->rol == 'Ejecutivo') || (Auth::user()->rol == 'Practicante'))
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});

		Route::filter('filtro_compromisos', function() 
		{
		    if ((Auth::user()->rol == 'Ejecutivo') || (Auth::user()->rol == 'Practicante'))
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});

		Route::filter('filtro_indicadores', function() 
		{
		    if ((Auth::user()->rol == 'Ejecutivo') || (Auth::user()->rol == 'Practicante'))
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});

		Route::filter('filtro_promocion', function() 
		{
		    if (Auth::user()->departamento != 'Direccion' && Auth::user()->departamento != 'Promocion')
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});

		Route::filter('filtro_reclamacion', function() 
		{
		    //in_array()
		    if (Auth::user()->departamento != 'Direccion' && Auth::user()->departamento != 'Promocion' &&  Auth::user()->departamento != 'Reclamacion')
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});

		Route::filter('filtro_juridico', function() 
		{
		    if (Auth::user()->departamento != 'Direccion' && Auth::user()->departamento != 'Juridico')
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});

		Route::filter('clientes', function() 
		{
		    if (Auth::user()->departamento == 'Clientes' && Auth::user()->rol == 'Responsable')
		    {
		        return Redirect::to('/documentacion');
		    }
		});

		Route::filter('noclientes', function() 
		{
		    if (Auth::user()->departamento != 'Clientes')
		    {
		        return Redirect::to('/')->with('mensaje', 'Necesitas Permisos Para Acceder');
		    }
		});


		Route::filter('auth', function()
		{
			if (Auth::guest())
			{
				if (Request::ajax())
				{
					return Response::make('Unauthorized', 401);
				}
				else
				{
					return Redirect::guest('login');
				}
			}
		});


		Route::filter('auth.basic', function()
		{
			return Auth::basic();
		});
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
