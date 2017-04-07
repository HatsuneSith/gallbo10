<?php 
class AveriguacionPrevia extends Eloquent {
    protected $table = 'AveriguacionPrevia';
    protected $fillable = array('num_averiguacion',
    							'dependencia_judicial',
    							'titular_dependencia'
                                );




}
?>