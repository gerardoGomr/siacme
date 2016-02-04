@extends('app_no_sidebar')

@section('titulo')
    <i class="fa fa-search"></i> Plan de Tratamiento
@stop

@section('contenido')
    <div class="innerAll" id="dvPlanTratamiento">
        {!! $dibujadorPlan->dibujar() !!}
    </div>
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="urlAgregarTratamientos" value="{{ url('consultas/plan/tratamientos/agregar') }}">
@stop

@section('js')
    <script src="{{ asset('public/js/ajax.js') }}"></script>
    <script src="{{ asset('public/js/consultas/consultas_plan_tratamiento.js') }}"></script>
@stop