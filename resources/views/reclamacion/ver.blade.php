@extends('layouts.master')

@section('title')
    Detalles del Siniestro {{$siniestro->asegurado->nombre}}
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido') 
    <div class="row">

        <div class="col-md-12">
            <h2 aria-hidden="true"><a href="{{ url('sire/reclamacion') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Informacion del Siniestro {{$siniestro->asegurado->nombre}} <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2>
            @if(Session::get('info'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('info')}}
            </div>
            @endif
            @if(Session::get('danger'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('danger')}}
            </div>
            @endif
            <?php $tabName = Session::get('tabName');?>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="{{ empty($tabName) || $tabName == 'siniestro' ? 'active' : '' }}"><a href="#siniestro" data-toggle="tab">Siniestro</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'asegurado' ? 'active' : '' }}"><a href="#asegurado" data-toggle="tab">Asegurado</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'aseguradora' ? 'active' : '' }}"><a href="#aseguradora" data-toggle="tab">Aseguradora</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'ajustadora' ? 'active' : '' }}"><a href="#ajustadora" data-toggle="tab">Ajustadora</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'poliza' ? 'active' : '' }}"><a href="#poliza" data-toggle="tab">Poliza</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'averiguacion' ? 'active' : '' }}"><a href="#averiguacion" data-toggle="tab">Averiguacion</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'documentacion' ? 'active' : '' }}"><a href="#documentacion" data-toggle="tab">Documentacion</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'cronograma' ? 'active' : '' }}"><a href="#cronograma" data-toggle="tab">Cronograma</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'bitacora' ? 'active' : '' }}"><a href="#bitacora" data-toggle="tab">Bitacora</a></li>
                <li class="{{ !empty($tabName) && $tabName == 'formatos' ? 'active' : '' }}"><a href="#formatos" data-toggle="tab">Formatos</a></li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane {{ empty($tabName) || $tabName == 'siniestro' ? 'active' : '' }}" id="siniestro">
                    @include('reclamacion.sections.siniestro')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'asegurado' ? 'active' : '' }}" id="asegurado">
                    @include('reclamacion.sections.asegurado')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'aseguradora' ? 'active' : '' }}" id="aseguradora">
                    @include('reclamacion.sections.aseguradora')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'ajustadora' ? 'active' : '' }}" id="ajustadora">
                    @include('reclamacion.sections.ajustadora')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'poliza' ? 'active' : '' }}" id="poliza">
                    @include('reclamacion.sections.poliza')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'averiguacion' ? 'active' : '' }}" id="averiguacion">
                    @include('reclamacion.sections.averiguacion')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'documentacion' ? 'active' : '' }}" id="documentacion">
                    @include('reclamacion.sections.documentacion')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'cronograma' ? 'active' : '' }}" id="cronograma">
                    @include('reclamacion.sections.cronograma')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'bitacora' ? 'active' : '' }}" id="bitacora">
                    @include('reclamacion.sections.bitacora')
                </div>

                <div class="tab-pane {{ !empty($tabName) && $tabName == 'formatos' ? 'active' : '' }}" id="formatos">
                    @include('reclamacion.sections.formatos')
                </div>

            </div>

        </div>

    </div>


@stop

@section('modals')
    @include('reclamacion.modals.siniestro')
    @include('reclamacion.modals.asegurado')
    @include('reclamacion.modals.aseguradora')
    @include('reclamacion.modals.ajustadora')
    @include('reclamacion.modals.poliza')
    @include('reclamacion.modals.averiguacion')
    @include('reclamacion.modals.documentacion')
    @include('reclamacion.modals.cronograma')
    @include('reclamacion.modals.bitacora')
    @include('reclamacion.modals.formatos')
@stop

