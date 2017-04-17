<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use DateTime;
use App\Models\indicador;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class IndicadoresController extends Controller {




    public function inicio()
    {
        $now = new DateTime();
        $mes_actual = $now->format('m');
        $año_actual = $now->format('Y');

        $mes = Input::get('mes');
        $año = Input::get('año');

        if ($mes == NULL) {
            $mes = $mes_actual;
        }

        if ($año == NULL) {
            $año = $año_actual;
        }




        $indprom = DB::table('indicadorest')->where('id_departamento', '=', 2)->orderBy('id')->get();
        $indrecl = DB::table('indicadorest')->where('id_departamento', '=', 3)->orderBy('id')->get();   
        $indcobr = DB::table('indicadorest')->where('id_departamento', '=', 4)->orderBy('id')->get();   
        $indjur = DB::table('indicadorest')->where('id_departamento', '=', 5)->orderBy('id')->get();

        $ind_prom = DB::table('indicadores')
                                ->join('indicadorest', function($join)
                                {
                                    $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                            
                                })
                                ->where('indicadores.año', '=', $año)
                                ->where('indicadores.mes', '=', $mes)
                                ->where('indicadorest.id_departamento', '=', 2)
                                ->orderBy('indicadores.id_indicador')
                                ->get();

        $ind_prom_count = count($ind_prom);

        $ind_recl = DB::table('indicadores')
                                ->join('indicadorest', function($join)
                                {
                                    $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                            
                                })
                                ->where('indicadores.año', '=', $año)
                                ->where('indicadores.mes', '=', $mes)
                                ->where('indicadorest.id_departamento', '=', 3)
                                ->orderBy('indicadores.id_indicador')
                                ->get();

        $ind_recl_count = count($ind_recl);

        $ind_cobr = DB::table('indicadores')
                                ->join('indicadorest', function($join)
                                {
                                    $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                            
                                })
                                ->where('indicadores.año', '=', $año)
                                ->where('indicadores.mes', '=', $mes)
                                ->where('indicadorest.id_departamento', '=', 4)
                                ->orderBy('indicadores.id_indicador')
                                ->get();

        $ind_cobr_count = count($ind_cobr);

        $ind_jur = DB::table('indicadores')
                                ->join('indicadorest', function($join)
                                {
                                    $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                            
                                })
                                ->where('indicadores.año', '=', $año)
                                ->where('indicadores.mes', '=', $mes)
                                ->where('indicadorest.id_departamento', '=', 5)
                                ->orderBy('indicadores.id_indicador')
                                ->get();

        $ind_jur_count = count($ind_jur);

        
        return View::make('indicadores.inicio', array('indprom' => $indprom, 
                                                    'indrecl' => $indrecl, 
                                                    'indcobr' => $indcobr, 
                                                    'indjur' => $indjur,
                                                    'ind_prom' => $ind_prom, 
                                                    'ind_prom_count' => $ind_prom_count, 
                                                    'ind_recl' => $ind_recl, 
                                                    'ind_recl_count' => $ind_recl_count, 
                                                    'ind_cobr' => $ind_cobr, 
                                                    'ind_cobr_count' => $ind_cobr_count, 
                                                    'ind_jur' => $ind_jur, 
                                                    'ind_jur_count' => $ind_jur_count,
                                                    'año' => $año,
                                                    'mes' => $mes
                                                    ));
    }

    public function indicadoresAjax(){
        if(Request::ajax()){

            $mes =Input::get('mes');
            $año =Input::get('año');

            $ind_prom = DB::table('indicadores')
                                    ->join('indicadorest', function($join)
                                    {
                                        $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                                
                                    })
                                    ->where('indicadores.año', '=', $año)
                                    ->where('indicadores.mes', '=', $mes)
                                    ->where('indicadorest.id_departamento', '=', 2)
                                    ->orderBy('indicadores.id_indicador')
                                    ->get();

            $ind_prom_count = count($ind_prom);

            $ind_recl = DB::table('indicadores')
                                    ->join('indicadorest', function($join)
                                    {
                                        $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                                
                                    })
                                    ->where('indicadores.año', '=', $año)
                                    ->where('indicadores.mes', '=', $mes)
                                    ->where('indicadorest.id_departamento', '=', 3)
                                    ->orderBy('indicadores.id_indicador')
                                    ->get();

            $ind_recl_count = count($ind_recl);

            $ind_cobr = DB::table('indicadores')
                                    ->join('indicadorest', function($join)
                                    {
                                        $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                                
                                    })
                                    ->where('indicadores.año', '=', $año)
                                    ->where('indicadores.mes', '=', $mes)
                                    ->where('indicadorest.id_departamento', '=', 4)
                                    ->orderBy('indicadores.id_indicador')
                                    ->get();

            $ind_cobr_count = count($ind_cobr);

            $ind_jur = DB::table('indicadores')
                                    ->join('indicadorest', function($join)
                                    {
                                        $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                                
                                    })
                                    ->where('indicadores.año', '=', $año)
                                    ->where('indicadores.mes', '=', $mes)
                                    ->where('indicadorest.id_departamento', '=', 5)
                                    ->orderBy('indicadores.id_indicador')
                                    ->get();

            $ind_jur_count = count($ind_jur);


            return Response::json(array('success' =>true, 
                'ind_prom' => $ind_prom, 
                'ind_prom_count' => $ind_prom_count, 
                'ind_recl' => $ind_recl, 
                'ind_recl_count' => $ind_recl_count, 
                'ind_cobr' => $ind_cobr, 
                'ind_cobr_count' => $ind_cobr_count, 
                'ind_jur' => $ind_jur, 
                'ind_jur_count' => $ind_jur_count));
        }
    }

    public function agregarObjetivos()
    {
        $objetivo = Input::get('objetivo');
        $id_indicador = Input::get('id_indicador');
        $mes = Input::get('mes');
        $año = Input::get('año');
        $num = count($objetivo);
        if ($num != 0) {
            for ($n=0; $n < $num ; $n++) {
                $input = array('id_indicador' => $id_indicador[$n],
                                'mes' => $mes[$n],
                                'año' => $año[$n],
                                'objetivo' => $objetivo[$n],
                                'semana1' => 0,
                                'semana2' => 0,
                                'semana3' => 0,
                                'semana4' => 0,
                                'semana5' => 0
                        );
                indicador::create($input);
            }
            return Redirect::route('indicadores', array('mes' => $mes[0], 'año' => $año[0]));
        }
        else{
            return Redirect::route('indicadores', array('mes' => $mes[0], 'año' => $año[0]));
        }

    }

    public function editarObjetivos(){
        if(Request::ajax()){

            $mes =Input::get('mes');
            $año =Input::get('año');
            $id_departamento =Input::get('id_departamento');

            $ind_dpto = DB::table('indicadores')
                                    ->join('indicadorest', function($join)
                                    {
                                        $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                                
                                    })
                                    ->where('indicadores.año', '=', $año)
                                    ->where('indicadores.mes', '=', $mes)
                                    ->where('indicadorest.id_departamento', '=', $id_departamento)
                                    ->orderBy('indicadores.id_indicador')
                                    ->get();

            $nom_dpto = DB::table('departamento')->where('id', $id_departamento)->pluck('departamento');

            
            return Response::json(array('success' =>true, 
                'ind_dpto' => $ind_dpto,
                'nom_dpto' => $nom_dpto
                ));
        }
    }

    public function editarObjetivosPost()
    {
        $objetivo = Input::get('objetivo');
        $id_indicador = Input::get('id_indicador');
        $mes = Input::get('mes');
        $año = Input::get('año');
        $num = count($objetivo);

        for ($n=0; $n < $num ; $n++) {
            
            $actualizar = DB::update('UPDATE indicadores SET objetivo = ? WHERE id_indicador = ? AND mes = ? AND año = ?', array( $objetivo[$n], $id_indicador[$n], $mes, $año));
        }
        return Redirect::route('indicadores', array('mes' => $mes, 'año' => $año));

    }

    public function addCumplido(){
        if(Request::ajax()){

            $mes =Input::get('mes');
            $año =Input::get('año');
            $id_departamento =Input::get('id_departamento');

            $cumplido_dpto = DB::table('indicadores')
                                    ->join('indicadorest', function($join)
                                    {
                                        $join->on('indicadores.id_indicador', '=', 'indicadorest.id');
                                                
                                    })
                                    ->where('indicadores.año', '=', $año)
                                    ->where('indicadores.mes', '=', $mes)
                                    ->where('indicadorest.id_departamento', '=', $id_departamento)
                                    ->orderBy('indicadores.id_indicador')
                                    ->get();

            $nom_dpto_c = DB::table('departamento')->where('id', $id_departamento)->pluck('departamento');


            return Response::json(array('success' =>true, 
                'cumplido_dpto' => $cumplido_dpto,
                'nom_dpto_c' => $nom_dpto_c
                ));
        }
    }

    public function addCumplidoPost()
    {
        $id_indicador = Input::get('id_indicador');
        $mes = Input::get('mes');
        $año = Input::get('año');
        $s1 = Input::get('s1');
        $s2 = Input::get('s2');
        $s3 = Input::get('s3');
        $s4 = Input::get('s4');
        

        $num = count($id_indicador);

        for ($n=0; $n < $num ; $n++) {
            
            $actualizar = DB::update('UPDATE indicadores SET semana1 = ?, semana2= ?, semana3 = ?, semana4 = ? WHERE id_indicador = ? AND mes = ? AND año = ?', array( $s1[$n], $s2[$n], $s3[$n], $s4[$n], $id_indicador[$n], $mes, $año));
        }
        return Redirect::route('indicadores', array('mes' => $mes, 'año' => $año));

    }




}
?>