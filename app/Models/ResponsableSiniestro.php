<?php 
class ResponsableSiniestro extends Eloquent {
    protected $table = 'ResponsableSiniestro';
    protected $fillable = array('id_siniestro',
    							'id_usuario'
                                );

    public function siniestro(){
        return $this->belongsTo('Siniestro', 'id_siniestro', 'id');
    }

    public function usuario(){
        return $this->belongsTo('Usuario', 'id_usuario', 'id');
    }

    




}
?>