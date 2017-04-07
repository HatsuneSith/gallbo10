@extends('layouts.master')

@section('title')
    SIRE
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido') 


{{ Form::open(array('url' => 'example', 'files'=>true)) }}
  <div class="form-group">
    <label class="control-label">Select File</label>
	<input id="fileex" name="fileex" type="file" class="file" data-allowed-file-extensions='["png", "jpg"]'>
  </div>
{{ Form::close() }}


@stop

@section('jsfoot')
    <script type="text/javascript">
    	$("#fileex").fileinput({
    		language: "es",
    	});
    </script>
@stop



