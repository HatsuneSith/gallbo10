<?php 
class CoberturasAfectadas extends Eloquent {
    protected $table = 'CoberturasAfectadas';
    protected $fillable = array('id_poliza',
                                'id_coberturas', 
                                'suma_asegurada', 
                                'valor_declarado', 
                                'deducible', 
                                'coaseguro'
                                );




}
?>