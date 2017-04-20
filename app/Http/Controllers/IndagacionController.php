<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use Request;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


class IndagacionController extends Controller {


    public function mostrar()
    {
        $estados = DB::table('estados')->get();
        return View::make('indagacion.lista', array('estados' => $estados));

    }

    public function mostrarPeriodicos($id){
        if(Request::ajax()){
            $periodicos = DB::table('periodicos')->where('id_estado', '=', $id)->get();
            return Response::json(array('success' =>true, 'periodicos' => $periodicos));
        }
    }


}
?>


