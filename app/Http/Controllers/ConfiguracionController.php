<?php namespace App\Http\Controllers;
use View;
use Auth;
class ConfiguracionController extends Controller {


    public function inicio()
    {
        
        return View::make('configuracion.inicio');
    }




}
?>