<?php

/*
|--------------------------------------------------------------------------
| Default Laravel 5.0 Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



/*
|--------------------------------------------------------------------------
| Sire Routes
|--------------------------------------------------------------------------
|
| Estas son las mismas rutas que estaban antes en \app\Http\routes.php
| en el viejo proyecto.
| No se realizo ningun cambio, estan totalmente copy-pasteadas.
|
*/

Route::get('login', function()
{
    return View::make('auth.login');
});

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::group(array('before' => 'auth'), function()
{

	Route::group(array('before' => 'clientes'), function()
	{

		Route::get('/', function()
		{
			return View::make('inicio');
		});

		Route::group(array('before' => 'filtro_admin'), function(){
			
			Route::get('sire/configuracion', array('uses' => 'ConfiguracionController@inicio'));
			//Rutas de usuarios

			Route::get('sire/configuracion/usuarios', array('uses' => 'UsuariosController@mostrarUsuarios'));
			Route::get('sire/configuracion/usuarios/nuevo', array('uses' => 'UsuariosController@nuevoUsuario'));
			Route::post('sire/configuracion/usuarios/crear', array('uses' => 'UsuariosController@crearUsuario'));
			Route::get('sire/configuracion/usuarios/eliminar/{id}', array('uses' => 'UsuariosController@eliminarUsuario'));
			Route::get('sire/configuracion/usuarios/asignacion/{id}', array('uses' => 'UsuariosController@asignacionUsuario'));
			Route::post('sire/configuracion/usuarios/asignacion', array('uses' => 'UsuariosController@guardarAsignacionUsuario'));
			Route::post('sire/configuracion/usuarios/cambiopassword', array('uses' => 'UsuariosController@cambioPassword'));
			//Route::get('usuarios/ver/{id}', array('uses'=>'UsuariosController@verUsuario'));
			
		});

		Route::group(array('before' => 'filtro_analytics'), function(){
			
			Route::get('tareas/reportes', array('uses' => 'TareasController@reportesInicio'));
			Route::get('tareas/reportes/usuarios', array('uses'=>'TareasController@reportesUsuarios')); 
			Route::get('tareas/reportes/usuarios_ajax', array('uses'=>'TareasController@reportesUsuariosAjax')); 
			Route::get('tareas/reportes/departamento', array('uses'=>'TareasController@reportesDepartamento')); 
			Route::get('tareas/reportes/departamento_ajax', array('uses'=>'TareasController@reportesDepartamentoAjax')); 
			Route::get('tareas/reportes/array_usuarios', array('uses'=>'UsuariosController@arrayUsuarios'));
			Route::get('tareas/reportes/usuarios_ajax_pdf', array('uses'=>'TareasController@reportesUsuariosAjaxPDF')); 
			Route::get('tareas/reportes/departamento_ajax_pdf', array('uses'=>'TareasController@reportesDepartamentoAjaxPDF')); 

		});

		Route::get('usuario/perfil', array('uses'=>'UsuariosController@verPerfil'));
		Route::post('usuario/cambiarpassword', array('uses' => 'UsuariosController@cambiarPassword'));


		//Rutas de Tareas
		Route::get('tareas', array('uses' => 'TareasController@principal'));
		//Route::get('tareas', array('uses' => 'TareasController@mostrarTareas'));
		Route::get('tareas/nueva', array('uses' => 'TareasController@nuevaTarea'));
		Route::get('tareas/lista/', array('uses' => 'TareasController@listaTareas'));
		Route::post('tareas/crear', array('uses' => 'TareasController@crearTarea'));
		Route::post('tareas/comentar', array('uses' => 'TareasController@crearComentario'));
		Route::post('tareas/solicitarfecha', array('uses' => 'TareasController@crearProrroga'));
		Route::post('tareas/tareasinconcluir', array('uses' => 'TareasController@tareaSinConcluir'));

		//las siguientes rutas requieren una validacion para que un usuario cualquiera no pueda acceder a ellas
		Route::get('tareas/ver/{id}', array('uses'=>'TareasController@verTarea')); 
		Route::get('tareas/eliminar/{id}', array('uses'=>'TareasController@eliminarTarea')); 
		Route::get('tareas/editar/{id}', array('uses'=>'TareasController@editarTarea'));
		Route::post('tareas/actualizar/{id}', array('uses'=>'TareasController@actualizarTarea'));
		Route::get('tareas/actualizar/concluida/{id}', array('uses'=>'TareasController@actualizarConcluida')); 
		Route::get('tareas/ver/actualizar/concluida/{id}', array('uses'=>'TareasController@actualizarConcluida')); 
		Route::get('tareas/array_usuarios', array('uses'=>'UsuariosController@arrayUsuarios'));
		//huevo de pascua 8))
		Route::get('tareas/editar_eg/{id}', array('uses'=>'TareasController@editarTareaEG'));
		Route::post('tareas/actualizar_eg/{id}', array('uses'=>'TareasController@actualizarTareaEG'));
		


		//Sire
		Route::get('sire', array('uses' => 'SireController@inicio'));
		Route::group(array('before' => 'filtro_promocion'), function(){
			//Promocion
			Route::get('sire/promocion', array('uses' => 'PromocionController@inicio'));
			Route::get('sire/promocion/busqueda', array('uses' => 'PromocionController@busqueda'));
			//ruta que devuelve un json con los periodicos de la base de datos
			Route::get('sire/promocion/busqueda/periodicos/{id}', array('uses' => 'PromocionController@busquedaPeriodicos'));
			Route::get('sire/promocion/siniestros', array('uses' => 'PromocionController@siniestros'));
			Route::get('sire/promocion/siniestros/nuevo', array('uses' => 'PromocionController@siniestrosNuevo'));
			Route::post('sire/promocion/siniestros/nuevo', array('uses' => 'PromocionController@siniestrosGuardar'));
			Route::get('sire/promocion/siniestros/ver/{id}', array('uses' => 'PromocionController@siniestrosVer'));
			Route::post('sire/promocion/siniestros/actualizar/{id}', array('uses' => 'PromocionController@siniestrosActualizar'));
			Route::post('sire/promocion/siniestros/actualizar/cita/{id}', array('uses' => 'PromocionController@siniestrosCita'));
			Route::post('sire/promocion/siniestros/actualizar/estatus/{id}', array('uses' => 'PromocionController@siniestrosEstatus'));
			Route::post('sire/promocion/siniestros/ver/comentar/{id}', array('uses' => 'PromocionController@siniestrosComentar'));
			Route::get('sire/promocion/siniestros/nuevo/ciudades/{id}', array('uses' => 'PromocionController@busquedaCiudades'));
			Route::get('sire/promocion/siniestros/ver/propuesta/{id}', array('uses' => 'PromocionController@busquedaPropuesta'));
			Route::post('sire/promocion/siniestros/ver/propuesta', array('uses' => 'PromocionController@imprimirPropuesta'));
		});

		Route::get('sire/administracion', array('uses' => 'AdministracionController@inicio'));


		Route::get('pdf', array('uses' => 'SireController@pdf'));
		Route::get('word', array('uses' => 'SireController@word'));
		Route::get('example', array('uses' => 'SireController@exampleview'));
		Route::post('example', array('uses' => 'SireController@examplepost'));



		Route::group(array('before' => 'filtro_compromisos'), function(){
			Route::get('sire/compromisos/', array('as' => 'compromisos', 'uses' => 'CompromisosController@inicio'));
			Route::post('sire/compromisos/crear', array('uses' => 'CompromisosController@crear'));
			Route::post('sire/compromisos/creartarea', array('uses' => 'CompromisosController@crearTarea'));
			Route::get('sire/compromisos/tareas/{id}', array('uses' => 'CompromisosController@listaTareas'));
			Route::get('sire/compromisos/editar/{id}', array('uses' => 'CompromisosController@editarBusqueda'));
			Route::post('sire/compromisos/editar', array('uses' => 'CompromisosController@editar'));
			Route::get('sire/compromisos/reportes', array('uses'=>'CompromisosController@reportes')); 
			Route::get('sire/compromisos/reportes/ajax', array('uses'=>'CompromisosController@reportesAjax')); 
		});


		Route::group(array('before' => 'filtro_indicadores'), function(){
			Route::get('sire/indicadores/', array('as' => 'indicadores', 'uses' => 'IndicadoresController@inicio'));
			Route::get('sire/indicadores/ajax', array('uses' => 'IndicadoresController@indicadoresAjax'));
			Route::post('sire/indicadores/agregarobj', array('uses' => 'IndicadoresController@agregarObjetivos'));
			Route::get('sire/indicadores/editarobj', array('uses' => 'IndicadoresController@editarObjetivos'));
			Route::post('sire/indicadores/editarobjpost', array('uses' => 'IndicadoresController@editarObjetivosPost'));
			Route::get('sire/indicadores/addcumplido', array('uses' => 'IndicadoresController@addCumplido'));
			Route::post('sire/indicadores/addcumplido', array('uses' => 'IndicadoresController@addCumplidoPost'));
		});

		Route::group(array('before' => 'filtro_reclamacion'), function(){

			Route::get('sire/reclamacion', array('uses' => 'ReclamacionController@inicio'));
			Route::get('sire/reclamacion/siniestro/{id}', array('uses' => 'ReclamacionController@verSiniestro'));
			Route::get('sire/reclamacion/tablero', array('uses' => 'ReclamacionController@tablero'));
			//adds
			Route::post('sire/reclamacion/agregar', array('uses' => 'ReclamacionController@agregarSiniestro'));
			Route::post('sire/reclamacion/siniestro/agregar/apoderado', array('uses' => 'ReclamacionController@agregarApoderado'));
			Route::post('sire/reclamacion/siniestro/agregar/contacto', array('uses' => 'ReclamacionController@agregarContacto'));
			Route::post('sire/reclamacion/siniestro/agregar/acta_constitutiva', array('uses' => 'ReclamacionController@agregarActaConstitutiva'));
			Route::post('sire/reclamacion/siniestro/agregar/logo', array('uses' => 'ReclamacionController@agregarLogo'));
			Route::post('sire/reclamacion/siniestro/agregar/caracter', array('uses' => 'ReclamacionController@agregarCaracter'));
			Route::post('sire/reclamacion/siniestro/agregar/aseguradora', array('uses' => 'ReclamacionController@agregarAseguradora'));
			Route::post('sire/reclamacion/siniestro/agregar/director_siniestros', array('uses' => 'ReclamacionController@agregarDirectorSiniestros'));
			Route::post('sire/reclamacion/siniestro/agregar/gerencia_siniestros', array('uses' => 'ReclamacionController@agregarGerenciaSiniestros'));
			Route::post('sire/reclamacion/siniestro/agregar/agente_seguros', array('uses' => 'ReclamacionController@agregarAgenteSeguros'));
			Route::post('sire/reclamacion/siniestro/agregar/ajustadora', array('uses' => 'ReclamacionController@agregarAjustadora')); //
			Route::post('sire/reclamacion/siniestro/agregar/director_despacho', array('uses' => 'ReclamacionController@agregarDirectorDespacho'));
			Route::post('sire/reclamacion/siniestro/agregar/ajustador', array('uses' => 'ReclamacionController@agregarAjustador'));
			Route::post('sire/reclamacion/siniestro/agregar/averiguacion', array('uses' => 'ReclamacionController@agregarAveriguacion'));
			Route::post('sire/reclamacion/siniestro/agregar/poliza', array('uses' => 'ReclamacionController@agregarPoliza'));
			Route::post('sire/reclamacion/siniestro/agregar/medidas_seguridad', array('uses' => 'ReclamacionController@agregarMedidasSeguridad'));
			Route::post('sire/reclamacion/siniestro/agregar/endosos_convenios', array('uses' => 'ReclamacionController@agregarEndososConvenios'));
			Route::post('sire/reclamacion/siniestro/agregar/coberturas', array('uses' => 'ReclamacionController@agregarCoberturas'));
			Route::post('sire/reclamacion/siniestro/agregar/perdidas_consecuenciales', array('uses' => 'ReclamacionController@agregarPerdidasConsecuenciales'));
			Route::post('sire/reclamacion/siniestro/agregar/clausulas_especiales', array('uses' => 'ReclamacionController@agregarClausulasEspeciales'));
			Route::post('sire/reclamacion/siniestro/agregar/documentacion', array('uses' => 'ReclamacionController@agregarDocumentacion'));
			Route::post('sire/reclamacion/siniestro/agregar/comentario_bitacora', array('uses' => 'ReclamacionController@agregarComentarioBitacora'));
			Route::post('sire/reclamacion/siniestro/agregar/documento', array('uses' => 'ReclamacionController@agregarDocumento'));
			Route::post('sire/reclamacion/siniestro/agregar/ejecutivo_asignado', array('uses' => 'ReclamacionController@agregarEjecutivoAsignado'));
			Route::post('sire/reclamacion/siniestro/agregar/responsable', array('uses' => 'ReclamacionController@agregarResponsable'));
			Route::post('sire/reclamacion/siniestro/agregar/limitacion_valor_reposicion', array('uses' => 'ReclamacionController@agregarLimitacionVR'));

			Route::post('sire/reclamacion/siniestro/seleccionar/apoderado', array('uses' => 'ReclamacionController@seleccionarApoderado'));
			Route::post('sire/reclamacion/siniestro/seleccionar/contacto', array('uses' => 'ReclamacionController@seleccionarContacto'));
			Route::post('sire/reclamacion/siniestro/seleccionar/aseguradora', array('uses' => 'ReclamacionController@seleccionarAseguradora'));
			Route::post('sire/reclamacion/siniestro/seleccionar/agente_seguros', array('uses' => 'ReclamacionController@seleccionarAgenteSeguros'));
			Route::post('sire/reclamacion/siniestro/seleccionar/ajustadora', array('uses' => 'ReclamacionController@seleccionarAjustadora'));//
			Route::post('sire/reclamacion/siniestro/seleccionar/ajustador', array('uses' => 'ReclamacionController@seleccionarAjustador'));//

			//ediciones
			Route::post('sire/reclamacion/siniestro/actualizar/siniestro', array('uses' => 'ReclamacionController@actualizarSiniestro'));
			Route::post('sire/reclamacion/siniestro/actualizar/asegurado', array('uses' => 'ReclamacionController@actualizarAsegurado'));
			Route::post('sire/reclamacion/siniestro/actualizar/apoderado', array('uses' => 'ReclamacionController@actualizarApoderado'));
			Route::post('sire/reclamacion/siniestro/actualizar/contacto', array('uses' => 'ReclamacionController@actualizarContacto'));
			Route::post('sire/reclamacion/siniestro/actualizar/acta_constitutiva', array('uses' => 'ReclamacionController@actualizarActaConstitutiva'));
			Route::post('sire/reclamacion/siniestro/actualizar/caracter', array('uses' => 'ReclamacionController@actualizarCaracter'));
			Route::post('sire/reclamacion/siniestro/actualizar/aseguradora', array('uses' => 'ReclamacionController@actualizarAseguradora'));
			Route::post('sire/reclamacion/siniestro/actualizar/director_siniestros', array('uses' => 'ReclamacionController@actualizarDirectorSiniestros'));
			Route::post('sire/reclamacion/siniestro/actualizar/gerencia_siniestros', array('uses' => 'ReclamacionController@actualizarGerenciaSiniestros'));
			Route::post('sire/reclamacion/siniestro/actualizar/agente_seguros', array('uses' => 'ReclamacionController@actualizarAgenteSeguros'));
			Route::post('sire/reclamacion/siniestro/actualizar/ajustadora', array('uses' => 'ReclamacionController@actualizarAjustadora'));//
			Route::post('sire/reclamacion/siniestro/actualizar/director_despacho', array('uses' => 'ReclamacionController@actualizarDirectorDespacho'));
			Route::post('sire/reclamacion/siniestro/actualizar/ajustador', array('uses' => 'ReclamacionController@actualizarAjustador'));
			Route::post('sire/reclamacion/siniestro/actualizar/averiguacion', array('uses' => 'ReclamacionController@actualizarAveriguacion'));
			Route::post('sire/reclamacion/siniestro/actualizar/poliza', array('uses' => 'ReclamacionController@actualizarPoliza'));
			Route::post('sire/reclamacion/siniestro/actualizar/coberturas', array('uses' => 'ReclamacionController@actualizarCoberturas'));
			Route::post('sire/reclamacion/siniestro/actualizar/datos_coberturas', array('uses' => 'ReclamacionController@actualizarDatosCoberturas'));
			Route::post('sire/reclamacion/siniestro/actualizar/perdidas_consecuenciales', array('uses' => 'ReclamacionController@actualizarPerdidasConsecuenciales'));
			Route::post('sire/reclamacion/siniestro/actualizar/indemnizacion_perdidas_consecuenciales', array('uses' => 'ReclamacionController@actualizarIndemnizacionPerdidasConsecuenciales'));
			Route::post('sire/reclamacion/siniestro/actualizar/clausulas_especiales', array('uses' => 'ReclamacionController@actualizarClausulasEspeciales'));
			Route::post('sire/reclamacion/siniestro/actualizar/informacion_documentos', array('uses' => 'ReclamacionController@actualizarInformacionDocumentos'));
			Route::post('sire/reclamacion/siniestro/actualizar/ejecutivo_asignado', array('uses' => 'ReclamacionController@actualizarEjecutivoAsignado'));
			Route::post('sire/reclamacion/siniestro/actualizar/limitacion_valor_reposicion', array('uses' => 'ReclamacionController@actualizarLimitacionVR'));
			Route::post('sire/reclamacion/siniestro/actualizar/tablero', array('uses' => 'ReclamacionController@actualizarTablero'));
			Route::post('sire/reclamacion/siniestro/actualizar/sin_tablero', array('uses' => 'ReclamacionController@actualizarSinTablero'));
			Route::post('sire/reclamacion/siniestro/agregar/tablero', array('uses' => 'ReclamacionController@agregarSinTablero'));

			//busquedas ajax reclamacion
			Route::get('sire/reclamacion/busqueda/siniestro/{id}', array('uses' => 'ReclamacionController@busquedaSiniestro'));
			Route::get('sire/reclamacion/busqueda/asegurado/{id}', array('uses' => 'ReclamacionController@busquedaAsegurado'));
			Route::get('sire/reclamacion/busqueda/apoderados', array('uses' => 'ReclamacionController@busquedaApoderados'));
			Route::get('sire/reclamacion/busqueda/apoderado/{id}', array('uses' => 'ReclamacionController@busquedaApoderado'));
			Route::get('sire/reclamacion/busqueda/contactos', array('uses' => 'ReclamacionController@busquedaContactos'));
			Route::get('sire/reclamacion/busqueda/contacto/{id}', array('uses' => 'ReclamacionController@busquedaContacto'));
			Route::get('sire/reclamacion/busqueda/acta_constitutiva/{id}', array('uses' => 'ReclamacionController@busquedaActaConstitutiva'));
			Route::get('sire/reclamacion/busqueda/aseguradoras', array('uses' => 'ReclamacionController@busquedaAseguradoras')); 
			Route::get('sire/reclamacion/busqueda/aseguradora/{id}', array('uses' => 'ReclamacionController@busquedaAseguradora')); 
			Route::get('sire/reclamacion/busqueda/director_siniestros/{id}', array('uses' => 'ReclamacionController@busquedaDirectorSiniestros')); 
			Route::get('sire/reclamacion/busqueda/gerencia_siniestros/{id}', array('uses' => 'ReclamacionController@busquedaGerenciaSiniestros')); 
			Route::get('sire/reclamacion/busqueda/agentes_seguros', array('uses' => 'ReclamacionController@busquedaAgentesSeguros')); 
			Route::get('sire/reclamacion/busqueda/agente_seguro/{id}', array('uses' => 'ReclamacionController@busquedaAgenteSeguro'));
			Route::get('sire/reclamacion/busqueda/ajustadoras', array('uses' => 'ReclamacionController@busquedaAjustadoras')); //
			Route::get('sire/reclamacion/busqueda/ajustadora/{id}', array('uses' => 'ReclamacionController@busquedaAjustadora'));
			Route::get('sire/reclamacion/busqueda/director_despacho/{id}', array('uses' => 'ReclamacionController@busquedaDirectorDespacho'));
			Route::get('sire/reclamacion/busqueda/ajustadores', array('uses' => 'ReclamacionController@busquedaAjustadores')); 
			Route::get('sire/reclamacion/busqueda/ajustador/{id}', array('uses' => 'ReclamacionController@busquedaAjustador'));
			Route::get('sire/reclamacion/busqueda/averiguacion/{id}', array('uses' => 'ReclamacionController@busquedaAveriguacion'));
			Route::get('sire/reclamacion/busqueda/poliza/{id}', array('uses' => 'ReclamacionController@busquedaPoliza'));
			Route::get('sire/reclamacion/busqueda/tablero/{id}', array('uses' => 'ReclamacionController@busquedaTablero'));
			Route::get('sire/reclamacion/busqueda/sin_tablero/{id}', array('uses' => 'ReclamacionController@busquedaSinTablero'));

			Route::get('sire/reclamacion/formatos/contrato/{id}', array('uses' => 'FormatosController@contrato'));
			Route::post('sire/reclamacion/formatos/contrato/imprimir', array('uses' => 'FormatosController@imprimirContrato'));
			Route::get('sire/reclamacion/formatos/remocion_escombros/{id}', array('uses' => 'FormatosController@remocionEscombros'));
			Route::get('sire/reclamacion/formatos/descargar/remocion_escombros/{id}', array('uses' => 'FormatosController@descargarRemocionEscombros'));

			Route::get('sire/reclamacion/formatos/anticipo_indemnizacion/{id}', array('uses' => 'FormatosController@anticipoIndemnizacion'));
			Route::post('sire/reclamacion/formatos/descargar/anticipo_indemnizacion', array('uses' => 'FormatosController@descargarAnticipoIndemnizacion'));

			Route::get('sire/reclamacion/formatos/nombramiento_asesores/{id}', array('uses' => 'FormatosController@nombramientoAsesores'));
			Route::get('sire/reclamacion/formatos/descargar/nombramiento_asesores/{id}', array('uses' => 'FormatosController@descargarNombramientoAsesores'));

			Route::get('sire/reclamacion/formatos/duplicado_poliza/{id}', array('uses' => 'FormatosController@duplicadoPoliza'));
			Route::get('sire/reclamacion/formatos/descargar/duplicado_poliza/{id}', array('uses' => 'FormatosController@descargarDuplicadoPoliza'));

			Route::get('sire/reclamacion/formatos/asignacion_ajustadores/{id}', array('uses' => 'FormatosController@asignacionAjustadores'));
			Route::get('sire/reclamacion/formatos/descargar/asignacion_ajustadores/{id}', array('uses' => 'FormatosController@descargarAsignacionAjustadores'));

			Route::get('sire/reclamacion/formatos/solicitud_prorroga/{id}', array('uses' => 'FormatosController@solicitudProrroga'));
			Route::post('sire/reclamacion/formatos/descargar/solicitud_prorroga', array('uses' => 'FormatosController@descargarSolicitudProrroga'));

			Route::get('sire/reclamacion/formatos/aviso_siniestro/{id}', array('uses' => 'FormatosController@avisoSiniestro'));
			Route::get('sire/reclamacion/formatos/descargar/aviso_siniestro/{id}', array('uses' => 'FormatosController@descargarAvisoSiniestro'));

			Route::get('sire/reclamacion/formatos/solicitud_documentos/{id}', array('uses' => 'FormatosController@solicitudDocumentos'));
			Route::get('sire/reclamacion/formatos/descargar/solicitud_documentos/{id}', array('uses' => 'FormatosController@descargarSolicitudDocumentos'));

			Route::get('sire/reclamacion/formatos/averiguacion_previa/{id}', array('uses' => 'FormatosController@averiguacionPrevia'));
			Route::get('sire/reclamacion/formatos/descargar/averiguacion_previa/{id}', array('uses' => 'FormatosController@descargarAveriguacionPrevia'));

			Route::get('sire/reclamacion/formatos/cartas_reclamacion/{id}', array('uses' => 'FormatosController@cartasReclamacion'));
			Route::get('sire/reclamacion/formatos/descargar/cartas_reclamacion/{id}', array('uses' => 'FormatosController@descargarCartasReclamacion'));
			
			Route::get('sire/reclamacion/formatos/edificio_arrendado/{id}', array('uses' => 'FormatosController@edificioArrendado'));
			Route::get('sire/reclamacion/formatos/descargar/edificio_arrendado/{id}', array('uses' => 'FormatosController@descargarEdificioArrendado'));

			Route::get('sire/reclamacion/formatos/tercero_afectado/{id}', array('uses' => 'FormatosController@terceroAfectado'));
			Route::get('sire/reclamacion/formatos/descargar/tercero_afectado/{id}', array('uses' => 'FormatosController@descargarTerceroAfectado'));

			Route::get('sire/reclamacion/formatos/oferta_salvamento/{id}', array('uses' => 'FormatosController@ofertaSalvamento'));
			Route::get('sire/reclamacion/formatos/descargar/oferta_salvamento/{id}', array('uses' => 'FormatosController@descargarOfertaSalvamento'));
		});

		Route::group(array('before' => 'filtro_juridico'), function(){

			Route::get('sire/juridico', array('uses' => 'JuridicoController@inicio'));
			Route::get('sire/juridico/tablero', array('uses' => 'JuridicoController@tablero'));
			Route::post('sire/juridico/agregar', array('uses' => 'JuridicoController@agregarCliente'));
			Route::get('sire/juridico/juicio/{id}', array('uses' => 'JuridicoController@verJuicio'));
			Route::get('sire/juridico/busqueda/juicio/{id}', array('uses' => 'JuridicoController@busquedaJuicio'));
			Route::post('sire/juridico/actualizar/juicio', array('uses' => 'JuridicoController@actualizarFechasJuicio'));
			Route::post('sire/juridico/agregar/acuerdo', array('uses' => 'JuridicoController@agregarAcuerdo'));

			Route::get('sire/juridico/busqueda/acuerdo/{id}', array('uses' => 'JuridicoController@busquedaAcuerdo'));
			Route::post('sire/juridico/actualizar/acuerdo', array('uses' => 'JuridicoController@actualizarAcuerdo'));

		});


	});

	Route::group(array('before' => 'noclientes'), function(){
		Route::get('documentacion', array('uses' => 'ClientesController@inicio'));
		Route::post('documentacion/agregar/documento', array('uses' => 'ClientesController@agregarDocumento'));
	});



});
