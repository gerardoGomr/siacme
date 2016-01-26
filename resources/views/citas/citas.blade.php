@extends('app')

@section('css')
    <link type="text/css" href="{{ asset('public/assets/components/modules/admin/modals/assets/css/jquery.fancybox.css') }}" rel="stylesheet" />
@stop

@section('titulo')
	<i class="fa fa-calendar"></i> Agenda del Dr(a). {{ $medico->getNombreCompleto() }}
@stop

@section('contenido')

	<div class="row">
		<!-- col -->
		<div class="col-md-12 col-lg-9">
			<div class="widget">
				<div class="widget-body innerAll inner-2x">
					<div data-component>
						<div><a href="javascript:;" class="btn btn-success" id="generarLista" target="_blank"><i class="fa fa-file"></i>&nbsp;<i class="fa fa-print"></i> Generar lista</a></div>
						<div class="separator bottom"></div>
						<div id="calendario"></div>
						<input type="hidden" id="medico" value="{{ $medico->getUsername() }}" />
						<input type="hidden" id="rutaCitas" value="{!! url('citas/') !!}" />
						<input type="hidden" id="rutaPdf" value="{{ url('citas/lista/pdf') }}" />
						<input type="hidden" id="reprogramar" value="0" />
						<input type="hidden" id="_token" value="{{ csrf_token() }}" />
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-3">
			<div class="widget">
				<div class="widget-body innerAll inner-2x">

				</div>
			</div>

		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/assets/components/library/jquery-ui/js/jquery-ui.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/calendar/assets/lib/js/fullcalendar.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/modals/assets/js/jquery.fancybox.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/citas/citas.js') }}"></script>
@stop