<?php 
class JuridicoController extends Controller {

    public function inicio()
    {
    	$juicios1 = ClientesJuridico::where('tipo_juicio', '1')->get();
        $juicios2 = ClientesJuridico::where('tipo_juicio', '2')->get();
        return View::make('juridico.inicio', array('juicios1'   => $juicios1,
                                                    'juicios2'  => $juicios2
                                                    ));
    }

    public function tablero()
    {
/*    	echo "hola juridico";
    	$siniestros = Siniestro::all();
        $estados = Estados::all();
        $giros_empresas = GirosEmpresas::all();
        $tipos_siniestros = TiposSiniestros::all();
        $tipos_personas = TiposPersonas::all();*/
        return View::make('juridico.tablero', array());
    }

    public function agregarCliente()
    {
        $inputCliente = array('cliente'         => Input::get('cliente'),
                                'aseguradora'   => Input::get('aseguradora'),
                                'juzgado'       => Input::get('juzgado'),
                                'expediente'    => Input::get('expediente'),
                                'tipo_juicio'   => Input::get('tipo_juicio')
                            );

        $cliente = ClientesJuridico::create($inputCliente);
        return Redirect::back()->with('info', $info="Cliente Agregado Correctamente");
    }

    public function verJuicio($id)
    {
        $cliente = ClientesJuridico::find($id);
        return View::make('juridico.ver', array('cliente'   => $cliente));
    }

    public function busquedaJuicio($id){
        if(Request::ajax()){
            $clientes = ClientesJuridico::find($id);
            $juicio = $clientes->juicio()->first();
            if (isset($juicio)) {
                return Response::json(array('success' =>true, 'juicio' => $juicio));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function actualizarFechasJuicio()
    {
        $id_cliente                                                 = Input::get('id');
        $fecha_contrato_rechazo                                     = Input::get('fecha_contrato_rechazo');
        $fecha_presentacion_demanda                                 = Input::get('fecha_presentacion_demanda');
        $fecha_radicacion_demanda                                   = Input::get('fecha_radicacion_demanda');
        $fecha_emplazamiento                                        = Input::get('fecha_emplazamiento');
        $fecha_contestacion_demanda                                 = Input::get('fecha_contestacion_demanda');
        $fecha_notificacion_contestacion_demanda                    = Input::get('fecha_notificacion_contestacion_demanda');
        $fecha_desahogo_vista                                       = Input::get('fecha_desahogo_vista');
        $fecha_apertura_periodo_probatorio                          = Input::get('fecha_apertura_periodo_probatorio');
        $fecha_ofrecimiento_pruebas                                 = Input::get('fecha_ofrecimiento_pruebas');
        $observaciones                                              = Input::get('observaciones');
        $fecha_presentacion_alegatos                                = Input::get('fecha_presentacion_alegatos');
        $fecha_citacion_sentencia                                   = Input::get('fecha_citacion_sentencia');
        $fecha_sentencia_primera_instancia                          = Input::get('fecha_sentencia_primera_instancia');
        $fecha_notificacion_sentencia                               = Input::get('fecha_notificacion_sentencia');
        $fecha_presentacion_recursos_apelacion                      = Input::get('fecha_presentacion_recursos_apelacion');
        $fecha_recepcion_expediente_supremo_tribunal                = Input::get('fecha_recepcion_expediente_supremo_tribunal');
        $fecha_ejecutoria                                           = Input::get('fecha_ejecutoria');
        $fecha_notificacion_ejecutoria                              = Input::get('fecha_notificacion_ejecutoria');
        $fecha_presentacion_amparo_directo                          = Input::get('fecha_presentacion_amparo_directo');
        $fecha_resolucion_amparo                                    = Input::get('fecha_resolucion_amparo');
        $fecha_interposicion_incidente_liquidacion_suerte_principal = Input::get('fecha_interposicion_incidente_liquidacion_suerte_principal');
        $fecha_pago_suerte_principal                                = Input::get('fecha_pago_suerte_principal');
        $fecha_interposicion_incidente_liquidacion_intereses        = Input::get('fecha_interposicion_incidente_liquidacion_intereses');
        $fecha_pago_intereses                                       = Input::get('fecha_pago_intereses');
        $fecha_interposicion_incidente_costas                       = Input::get('fecha_interposicion_incidente_costas');
        $fecha_pago_incidente_costas                                = Input::get('fecha_pago_incidente_costas');
        $fecha_ultimo_seguimiento                                   = Input::get('fecha_ultimo_seguimiento');
        $observaciones_ultimo_seguimiento                           = Input::get('observaciones_ultimo_seguimiento');
        $actividad_realizar_ultimo_seguimiento                      = Input::get('actividad_realizar_ultimo_seguimiento');
        $fecha_conclusion                                           = Input::get('fecha_conclusion');

        $input = array(
            'id_cliente'                                                 => $id_cliente,
            'fecha_contrato_rechazo'                                     => $fecha_contrato_rechazo,
            'fecha_presentacion_demanda'                                 => $fecha_presentacion_demanda,
            'fecha_radicacion_demanda'                                   => $fecha_radicacion_demanda,
            'fecha_emplazamiento'                                        => $fecha_emplazamiento,
            'fecha_contestacion_demanda'                                 => $fecha_contestacion_demanda,
            'fecha_notificacion_contestacion_demanda'                    => $fecha_notificacion_contestacion_demanda,
            'fecha_desahogo_vista'                                       => $fecha_desahogo_vista,
            'fecha_apertura_periodo_probatorio'                          => $fecha_apertura_periodo_probatorio,
            'fecha_ofrecimiento_pruebas'                                 => $fecha_ofrecimiento_pruebas,
            'observaciones'                                              => $observaciones,
            'fecha_presentacion_alegatos'                                => $fecha_presentacion_alegatos,
            'fecha_citacion_sentencia'                                   => $fecha_citacion_sentencia,
            'fecha_sentencia_primera_instancia'                          => $fecha_sentencia_primera_instancia,
            'fecha_notificacion_sentencia'                               => $fecha_notificacion_sentencia,
            'fecha_presentacion_recursos_apelacion'                      => $fecha_presentacion_recursos_apelacion,
            'fecha_recepcion_expediente_supremo_tribunal'                => $fecha_recepcion_expediente_supremo_tribunal,
            'fecha_ejecutoria'                                           => $fecha_ejecutoria,
            'fecha_notificacion_ejecutoria'                              => $fecha_notificacion_ejecutoria,
            'fecha_presentacion_amparo_directo'                          => $fecha_presentacion_amparo_directo,
            'fecha_resolucion_amparo'                                    => $fecha_resolucion_amparo,
            'fecha_interposicion_incidente_liquidacion_suerte_principal' => $fecha_interposicion_incidente_liquidacion_suerte_principal,
            'fecha_pago_suerte_principal'                                => $fecha_pago_suerte_principal,
            'fecha_interposicion_incidente_liquidacion_intereses'        => $fecha_interposicion_incidente_liquidacion_intereses,
            'fecha_pago_intereses'                                       => $fecha_pago_intereses,
            'fecha_interposicion_incidente_costas'                       => $fecha_interposicion_incidente_costas,
            'fecha_pago_incidente_costas'                                => $fecha_pago_incidente_costas,
            'fecha_ultimo_seguimiento'                                   => $fecha_ultimo_seguimiento,
            'observaciones_ultimo_seguimiento'                           => $observaciones_ultimo_seguimiento,
            'actividad_realizar_ultimo_seguimiento'                      => $actividad_realizar_ultimo_seguimiento,
            'fecha_conclusion'                                           => $fecha_conclusion,
            );

        $cliente = ClientesJuridico::find($id_cliente);

        if ($cliente->juicio()->first() != Null) {
            $fechas = FechasJuicios::where('id_cliente', $id_cliente)->update(array(
                    'fecha_contrato_rechazo'                                     => $fecha_contrato_rechazo,
                    'fecha_presentacion_demanda'                                 => $fecha_presentacion_demanda,
                    'fecha_radicacion_demanda'                                   => $fecha_radicacion_demanda,
                    'fecha_emplazamiento'                                        => $fecha_emplazamiento,
                    'fecha_contestacion_demanda'                                 => $fecha_contestacion_demanda,
                    'fecha_notificacion_contestacion_demanda'                    => $fecha_notificacion_contestacion_demanda,
                    'fecha_desahogo_vista'                                       => $fecha_desahogo_vista,
                    'fecha_apertura_periodo_probatorio'                          => $fecha_apertura_periodo_probatorio,
                    'fecha_ofrecimiento_pruebas'                                 => $fecha_ofrecimiento_pruebas,
                    'observaciones'                                              => $observaciones,
                    'fecha_presentacion_alegatos'                                => $fecha_presentacion_alegatos,
                    'fecha_citacion_sentencia'                                   => $fecha_citacion_sentencia,
                    'fecha_sentencia_primera_instancia'                          => $fecha_sentencia_primera_instancia,
                    'fecha_notificacion_sentencia'                               => $fecha_notificacion_sentencia,
                    'fecha_presentacion_recursos_apelacion'                      => $fecha_presentacion_recursos_apelacion,
                    'fecha_recepcion_expediente_supremo_tribunal'                => $fecha_recepcion_expediente_supremo_tribunal,
                    'fecha_ejecutoria'                                           => $fecha_ejecutoria,
                    'fecha_notificacion_ejecutoria'                              => $fecha_notificacion_ejecutoria,
                    'fecha_presentacion_amparo_directo'                          => $fecha_presentacion_amparo_directo,
                    'fecha_resolucion_amparo'                                    => $fecha_resolucion_amparo,
                    'fecha_interposicion_incidente_liquidacion_suerte_principal' => $fecha_interposicion_incidente_liquidacion_suerte_principal,
                    'fecha_pago_suerte_principal'                                => $fecha_pago_suerte_principal,
                    'fecha_interposicion_incidente_liquidacion_intereses'        => $fecha_interposicion_incidente_liquidacion_intereses,
                    'fecha_pago_intereses'                                       => $fecha_pago_intereses,
                    'fecha_interposicion_incidente_costas'                       => $fecha_interposicion_incidente_costas,
                    'fecha_pago_incidente_costas'                                => $fecha_pago_incidente_costas,
                    'fecha_ultimo_seguimiento'                                   => $fecha_ultimo_seguimiento,
                    'observaciones_ultimo_seguimiento'                           => $observaciones_ultimo_seguimiento,
                    'actividad_realizar_ultimo_seguimiento'                      => $actividad_realizar_ultimo_seguimiento,
                    'fecha_conclusion'                                           => $fecha_conclusion
                ));
        }
        else{
            FechasJuicios::create($input);
        }

        return Redirect::back()->with('info', $info="Informacion actualizada correctamente");
    }

    public function agregarAcuerdo()
    {
        $input = array('id_cliente'                     => Input::get('id'),                   
                        'mes'                           => Input::get('mes'),
                        'año'                           => Input::get('año'),
                        'acuerdo'                       => Input::get('acuerdo'),
                        'detalle'                       => Input::get('detalle'),
                        'fecha_publicacion'             => Input::get('fecha_publicacion'),
                        'fecha_surte_efecto'            => Input::get('fecha_surte_efecto'),
                        'fecha_vencimiento_impulso'     => Input::get('fecha_vencimiento_impulso'),
                        'fecha_impulso'                 => Input::get('fecha_impulso'),
                        'fecha_limite_acuerdo_impulso'  => Input::get('fecha_limite_acuerdo_impulso'),
                        'fecha_acuerdo_impulso'         => Input::get('fecha_acuerdo_impulso')
                        );

        $acuerdo = AcuerdosJuridico::create($input);
        return Redirect::back()->with('info', $info="Acuerdo Agregado Correctamente");
    }

    public function busquedaAcuerdo($id){
        if(Request::ajax()){
            $acuerdo = AcuerdosJuridico::find($id);
            if (isset($acuerdo)) {
                return Response::json(array('success' =>true, 'acuerdo' => $acuerdo));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function actualizarAcuerdo()
    {

            $acuerdo = AcuerdosJuridico::where('id', Input::get('id'))->update(array(
                    'mes'                           => Input::get('mes'),
                    'año'                           => Input::get('año'),
                    'acuerdo'                       => Input::get('acuerdo'),
                    'detalle'                       => Input::get('detalle'),
                    'fecha_publicacion'             => Input::get('fecha_publicacion'),
                    'fecha_surte_efecto'            => Input::get('fecha_surte_efecto'),
                    'fecha_vencimiento_impulso'     => Input::get('fecha_vencimiento_impulso'),
                    'fecha_impulso'                 => Input::get('fecha_impulso'),
                    'fecha_limite_acuerdo_impulso'  => Input::get('fecha_limite_acuerdo_impulso'),
                    'fecha_acuerdo_impulso'         => Input::get('fecha_acuerdo_impulso')
                ));

        return Redirect::back()->with('info', $info="Informacion actualizada correctamente");
    }


}
?>