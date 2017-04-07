<?php 
class AjustadorDesignado extends Eloquent {
    protected $table = 'AjustadorDesignado';
    protected $fillable = array('id_ajustador',
    							'id_ajustadora'
                                );

    public function ajustador(){
        return $this->belongsTo('Ajustadores', 'id_ajustador', 'id');
    }

    public function ajustadora(){
        return $this->belongsTo('Ajustadora', 'id_ajustadora', 'id');
    }




}
?>