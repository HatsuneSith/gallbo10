<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class DirectorDespacho extends Model {
    protected $table = 'DirectorDespacho';
    protected $fillable = array('id_ajustadora',
    							'nombre',
                                'telefono_oficina', 
                                'telefono_celular', 
                                'email', 
                                'nextel'
                                );

    public function ajustadora(){
        return $this->belongsTo('App\Models\Ajustadora', 'id_ajustadora', 'id');
    }


}
?>