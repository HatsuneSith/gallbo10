<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class promSiniestro extends Model {
    protected $table = 'prom_siniestros';
    protected $fillable = array('fecha_siniestro', 'empresa', 'director_general', 'asistente_director_general', 'tipo_siniestro', 'magnitud_siniestro', 'giro_empresa', 'estado', 'ciudad', 'direccion', 'telefonos', 'email', 'fecha_cita_agendada', 'fecha_cita_realizada', 'lugar_cita', 'estatus');

    public function ComentarioPromSiniestro(){
    	return $this->hasMany('App\Models\comentarioPromSiniestro', 'id_promSiniestro');
    }

    

}
?>