<?php namespace App\Http\Controllers;
use Auth;
use View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller {

	
	public function login()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$remember = (Input::has('recordar')) ? true : false;

		


		if (Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password') ), true ))
		{
			return Redirect::to('/');
		}
		else{
			return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido');
		}

	}


	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');
	}
}
?>