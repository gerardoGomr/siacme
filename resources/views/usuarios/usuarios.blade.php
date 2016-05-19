@extends('app_')

@section('contenido')
	<div class="row row-app widget-employees">
		<div class="col-md-4 col-lg-3">
			<div class="col-separator col-unscrollable col-separator-first box">
				<h4 class="innerAll border-bottom margin-none">Búsqueda de usuarios</h4>
				<div class="innerAll bg-gray border-bottom margin-none">
					{!! Form::open(['url' => url('usuarios/buscar'), 'id' => 'formUsuarios']) !!}
						<label class="control-label">Nombre de usuario:</label>
						<input type="text" name="nombre" id="nombre" value="" placeholder="Escriba nombre, apellidos o clave de usuario" class="form-control">
					{!! Form::close() !!}
				</div>

				<div class="col-table">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<input type="hidden" id="urlClickCitas" value="{{ url('pacientes/detalle') }}">
								<span id="usuariosLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
								<ul class="list-group list-group-1 borders-none margin-none" id="listaUsuarios">
									@include('usuarios.usuarios_busqueda_resultados')
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
					<h4 class="innerAll border-bottom margin-none">Detalles</h4>
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
	<script src="{{ asset('public/js/usuarios/usuarios.js') }}"></script>
@stop