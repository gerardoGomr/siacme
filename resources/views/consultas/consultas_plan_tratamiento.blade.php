@extends('app_no_sidebar')

@section('titulo')
    <i class="fa fa-search"></i> Plan de Tratamiento
@stop

@section('contenido')
    <div class="innerAll">
        {!! $dibujadorPlan->dibujar() !!}
    </div>
@stop