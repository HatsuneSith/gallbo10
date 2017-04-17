<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class ResponsableSiniestro extends Model {
    protected $table = 'ResponsableSiniestro';
    protected $fillable = array('id_siniestro',
    							'id_usuario'
                                );

    public function siniestro(){
        return $this->belongsTo('App\Models\Siniestro', 'id_siniestro', 'id');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario', 'id_usuario', 'id');
    }

    




}
?>