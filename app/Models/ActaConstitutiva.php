<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActaConstitutiva extends Model {
    protected $table = 'ActaConstitutiva';
    protected $fillable = array('id_asegurado',
                                'escritura_publica', 
                                'fecha', 
                                'notario_publico', 
                                'objeto',
                                'administrador'
                                );


}
?>