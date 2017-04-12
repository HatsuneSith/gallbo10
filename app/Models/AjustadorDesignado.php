<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class AjustadorDesignado extends Model {
    protected $table = 'AjustadorDesignado';
    protected $fillable = array('id_ajustador',
    							'id_ajustadora'
                                );

    public function ajustador(){
        return $this->belongsTo('App\Models\Ajustadores', 'id_ajustador', 'id');
    }

    public function ajustadora(){
        return $this->belongsTo('App\Models\Ajustadora', 'id_ajustadora', 'id');
    }




}
?>