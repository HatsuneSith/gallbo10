<?php 
class ActaConstitutiva extends Eloquent {
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