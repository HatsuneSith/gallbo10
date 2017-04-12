<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use App\Models\Siniestro;
use App\Models\DocumentosSiniestros;

class ClientesController extends Controller {


    public function inicio()
    {
        $usuario = Usuario::find(Auth::user()->id);
        $siniestro = $usuario->siniestro->siniestro;
        return View::make('clientes.inicio', array('siniestro' => $siniestro));
    }

    public function agregarDocumento()
    {

        $id_siniestro = Input::get('id_siniestro');
        $id_documento = Input::get('id_documento');
        $siniestro=Siniestro::find($id_siniestro);
        $documento = DocumentosSiniestros::where('id_siniestro', $id_siniestro)->where('id_documento', $id_documento)->first();
        $ruta = 'siniestros/'.$id_siniestro;
        
        if (Input::hasFile('documento')) {
        	if (($documento->entregado != Null || $documento->archivo != "") && File::exists($documento->archivo)) {
	        	File::delete($documento->archivo);
	        }

        	$extension = Input::file('documento')->getClientOriginalExtension();
        	$nombre = 'documento'.$id_documento.'.'.$extension;
        	$doc=$ruta.'/'.$nombre;
        	if (File::isDirectory($ruta)) {
        		Input::file('documento')->move($ruta, $nombre);
        		$siniestro->documentos()->updateExistingPivot($id_documento, array('entregado' => 'OK', 'archivo'=> $doc));
        		return Redirect::back();
        	}
        	else{
        		File::makeDirectory($ruta, 0777, true);
        		Input::file('documento')->move($ruta, $nombre);
        		$siniestro->documentos()->updateExistingPivot($id_documento, array('entregado' => 'OK', 'archivo'=> $doc));
        		return Redirect::back();
        	}	
        }  
    }


}
?>