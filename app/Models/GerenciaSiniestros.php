<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class GerenciaSiniestros extends Model {
    protected $table = 'GerenciaSiniestros';
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