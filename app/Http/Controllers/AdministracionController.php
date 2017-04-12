<?php namespace App\Http\Controllers;
use View;
use Auth;
class AdministracionController extends Controller {


    public function inicio()
    {
        
        return View::make('administracion.inicio');
    }
}
?>