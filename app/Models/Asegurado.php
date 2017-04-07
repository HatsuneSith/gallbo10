<?php 
class Asegurado extends Eloquent {
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
        return $this->belongsTo('TiposPersonas', 'tipo_persona', 'id');
    }

    public function giro(){
        return $this->belongsTo('GirosEmpresas', 'giro', 'id');
    }

    public function estado(){
        return $this->belongsTo('Estados', 'estado', 'id');
    }

    public function sexo(){
        return $this->belongsTo('Sexos', 'sexo', 'id');
    }

    public function apoderado_legal(){
        return $this->belongsTo('ApoderadoLegal', 'id_apoderado_legal', 'id');
    }

    public function contacto(){
        return $this->belongsTo('Contacto', 'id_contacto', 'id');
    }

    public function acta_constitutiva(){
        return $this->hasOne('ActaConstitutiva', 'id_asegurado');
    }

    public function caracteres(){
        return $this->belongsToMany('CaracteresAsegurado', 'CaracterAsegurado', 'id_asegurado', 'id_caracter_asegurado');
    }



}
?>