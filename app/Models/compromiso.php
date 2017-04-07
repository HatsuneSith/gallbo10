<?php 
class Compromiso extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'compromisos';
    protected $fillable = array('compromiso', 'responsable', 'fecha', 'cumplido', 'fecha_cumplimiento');

    public function scopeRespond($query, $responsable)
    {
        if($responsable != "")
        {
            $query->where('responsable', $responsable);
        }

        else{
            $query->where('responsable', Auth::user()->id);
        }
    }

}
?>