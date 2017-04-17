<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class Compromiso extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'compromisos';
    protected $fillable = array('compromiso', 'responsable', 'fecha', 'cumplido', 'fecha_cumplimiento');

    public function scopeRespond($query, $responsable)
    {
        if($responsable != "")
        {
            $query->where('App\Models\responsable', $responsable);
        }

        else{
            $query->where('App\Models\responsable', Auth::user()->id);
        }
    }

}
?>