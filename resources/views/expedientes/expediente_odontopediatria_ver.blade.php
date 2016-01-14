@extends('app_no_sidebar')

@section('titulo')
	<i class="fa fa-plus"></i> Expediente
@stop

@section('contenido')

		<div class="wizard">
			<div class="widget widget-tabs widget-tabs-double widget-tabs-vertical row row-merge">
				@include('expedientes.expediente_odontopediatria_pestanias')

				<div class="widget-body col-md-9 col-lg-9">
					<div class="innerAll">
						<a href="javascript:;" id="firmar" class="btn btn-primary"><i class="fa fa-check"></i> Aceptar y firmar expediente</a>
						<a href="{{ url('expediente/agregar/odont/'.base64_encode($expediente->getId())) }}" class="btn btn-danger"><i class="fa fa-edit"></i> Editar expediente</a>

						<input type="hidden" name="idExpediente" id="idExpediente" value="{{ base64_encode($expediente->getId()) }}">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="urlFirmar" value="{{ url('expediente/firmar/odont') }}">
						{{-- <input type="hidden" id="urlDetalles" value="{{ url('citas/detalle/'.base64_encode($cita->getId()).'/'.base64_encode($cita->getMedico()->getUsername())) }}"> --}}
					</div>
					<div class="tab-content">
						@include('expedientes.expediente_odonto_datos_personales_ver')
						@include('expedientes.expediente_odonto_antecedentes_heredofamiliares_ver')
						@include('expedientes.expediente_odonto_antecedentes_patologicos_ver')
						@include('expedientes.expediente_odonto_antecedentes_odontopatologicos_ver')
						@include('expedientes.expediente_odonto_trastornos_lenguaje_ver')
						@include('expedientes.expediente_odonto_antecedentes_odontalgicos_ver')
						@include('expedientes.expediente_odonto_higiene_bucodental_ver')
						@include('expedientes.expediente_odonto_habitos_orales_ver')
					</div>
				</div>
			</div>
		</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/modals/assets/js/bootbox.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/expediente_odontopediatria_ver.js') }}"></script>
@stop