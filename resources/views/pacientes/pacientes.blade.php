@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-4 col-lg-3">
			<div class="col-separator col-unscrollable col-separator-first box">
				<h3 class="innerAll border-bottom margin-none">Búsqueda de pacientes</h3>
				<div class="innerAll bg-gray border-bottom margin-none">
					{!! Form::open(['url' => url('pacientes/buscar'), 'id' => 'formPaciente']) !!}
						<label class="control-label">Nombre de paciente:</label>
						<input type="text" name="txtPaciente" id="txtPaciente" value="" placeholder="Escriba nombre o apellidos" class="form-control">
						<input type="hidden" name="username" id="username" value="{{ $medico->getUsername() }}">
					{!! Form::close() !!}
				</div>

				<div class="col-table">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<input type="hidden" id="urlClickCitas" value="{{ url('pacientes/detalle') }}">
								<span id="pacientesLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
								<ul class="list-group list-group-1 borders-none margin-none" id="listaPacientes">
									@include('pacientes.pacientes_lista')
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-lg-9">
			<div class="col-separator col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Detalles</h3>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<span id="detalleLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
								<div id="dvDetalles">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/additional-methods.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/validaciones.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/pacientes/pacientes.js') }}"></script>
@stop