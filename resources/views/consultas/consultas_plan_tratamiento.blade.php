@extends('app_no_sidebar')

@section('titulo')
    <i class="fa fa-search"></i> Plan de Tratamiento
@stop

@section('contenido')
    <div class="row">
        <div class="col-md-9">
            <div class="innerAll border-right" id="dvPlanTratamiento">
                {!! $dibujadorPlan->dibujar() !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="innerAll">
                <div class="form-group">
                    <label class="control-label">Otros tratamientos:</label>
                    <select name="otrosTratamientos" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($listaOtrosTratamientos as $otroTratamiento)
                            <option value="{{ $otroTratamiento->getId() }}">{{ $otroTratamiento->getTratamiento() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <a href="" class="btn btn-primary btn-small"><i class="fa fa-plus"></i> Agregar a plan</a>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="urlAgregarTratamientos" value="{{ url('consultas/plan/tratamientos/agregar') }}">
@stop

@section('js')
    <script src="{{ asset('public/js/ajax.js') }}"></script>
    <script src="{{ asset('public/js/consultas/consultas_plan_tratamiento.js') }}"></script>
@stop