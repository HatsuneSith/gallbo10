<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class DirectorSiniestros extends Model {
    protected $table = 'DirectorSiniestros';
    protected $fillable = array('id_aseguradora',
    							'nombre',
                                'telefono', 
                                'email', 
                                'nextel'
                                );

    public function aseguradora(){
        return $this->belongsTo('App\Models\Aseguradora', 'id_aseguradora', 'id');
    }



}
?>