<?php namespace App\Models;
use View;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model {
    protected $table = 'tareas';
    protected $fillable = array('id_compromiso', 'tarea', 'objetivo', 'fecha', 'estado', 'indicador', 'id_responsable', 'nombre_responsable', 'id_asignador', 'nombre_asignador', 'fecha_concluida');

    public function comentariosTareas(){
    	return $this->hasMany('App\Models\ComentarioTarea', 'id_tarea');
    }

    public function prorrogas(){
    	return $this->hasMany('App\Models\Prorroga', 'id_tarea');
    }

    public function usuarios(){
    	return $this->belongsTo('App\Models\Usuario', 'id');
    }

    public function scopeResponsable($query, $id_responsable)
    {
        if($id_responsable != "")
        {
            $query->where('id_responsable', $id_responsable);
        }

    }

    public function scopeResponsablec($query, $id_responsable, $departamento)
    {

        $responsables = DB::table('usuarios')->where('departamento', $departamento)->orWhere('departamento', 'Sistemas')->lists('id', 'id');
        if($id_responsable != "" && isset($responsables[$id_responsable]))
        {
            $query->where('id_responsable', $id_responsable);
        }

        else{
            $query->join('usuarios', function($join)
                {
                    $join->on('tareas.id_responsable', '=', 'usuarios.id');
                })
                ->where('usuarios.departamento', '=', $departamento);
        }
    }



    public function scopeResponsablee($query, $id_responsable)
    {
        $responsables = DB::table('usuarios')->where('departamento', $departamento)->lists('id', 'id');
        if($id_responsable != "" && isset($responsables[$id_responsable]))
        {
            $query->where('id_responsable', $id_responsable);
        }

        else{
            $query->where('id_responsable', Auth::user()->id);
        }
    }

    public function scopeResponsablex($query, $id_responsable)
    {
        $asignados = DB::table('asignacion')->where('id_coordinador', Auth::user()->id)->lists('id_personal', 'id_personal');
        if($id_responsable != "" && isset($asignados[$id_responsable]))
        {
            $query->where('id_responsable', $id_responsable);
        }

        else{
            $query->where('id_responsable', Auth::user()->id);
        }
    }

    


    public function scopeEstado($query, $estado, $indicador)
    {
        if($estado != "")
        {
            $query->where('estado', $estado);
        }
        elseif (($estado == "") && ($indicador == "")) {
            $query->where('estado', '!=', 'Concluida A Tiempo')->Where('estado', '!=', 'Concluida A Destiempo');
        }
        
    }
    public function scopeIndicador($query, $estado, $indicador)
    {
        if($indicador != "")
        {
            $query->where('indicador', $indicador);
        }
        elseif (($estado == "") && ($indicador == "")) {
            $query->where('indicador', '!=', 'Verde');
        }
        
    }
}
?>