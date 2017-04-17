<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class Asegurado extends Model {
    protected $table = 'Asegurado';
    protected $fillable = array('nombre',
                                'tipo_persona', 
                                'giro', 
                                'domicilio', 
                                'estado', 
                                'ciudad', 
                                'codigo_postal', 
                                'telefono', 
                                'fax', 
                                'email', 
                                'rfc', 
                                'sexo', 
                                'logo', 
                                'id_apoderado_legal',
                                'id_contacto'
                                );


    

    public function tipo_persona(){
        return $this->belongsTo('App\Models\TiposPersonas', 'tipo_persona', 'id');
    }

    public function giro(){
        return $this->belongsTo('App\Models\GirosEmpresas', 'giro', 'id');
    }

    public function estado(){
        return $this->belongsTo('App\Models\Estados', 'estado', 'id');
    }

    public function sexo(){
        return $this->belongsTo('App\Models\Sexos', 'sexo', 'id');
    }

    public function apoderado_legal(){
        return $this->belongsTo('App\Models\ApoderadoLegal', 'id_apoderado_legal', 'id');
    }

    public function contacto(){
        return $this->belongsTo('App\Models\Contacto', 'id_contacto', 'id');
    }

    public function acta_constitutiva(){
        return $this->hasOne('App\Models\ActaConstitutiva', 'id_asegurado');
    }

    public function caracteres(){
        return $this->belongsToMany('App\Models\CaracteresAsegurado', 'CaracterAsegurado', 'id_asegurado', 'id_caracter_asegurado');
    }



}
?>