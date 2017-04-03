<?php 
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


