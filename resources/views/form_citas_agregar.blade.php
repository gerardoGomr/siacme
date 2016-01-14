

	{!! Form::open([
		'url'   => 'citas/agregar',
		'id'    => 'formCita',
		'style' => 'display:none;'
	]) !!}
		<div class="row">
			<div class="col-xs-6 col-md-4 col-lg-6">
				<div class="form-group">
					{!! Form::label('txtNombre', 'Nombre:', ['class' => 'control-label']) !!}
					{!! Form::text('txtNombre', null, ['class' => 'form-control']) !!}
				</div>
			</div>

			<div class="col-xs-6 col-md-4 col-lg-6">
				<div class="form-group">
					{!! Form::label('txtPaterno', 'Paterno:', ['class' => 'control-label']) !!}
					{!! Form::text('txtPaterno', null, ['class' => 'form-control']) !!}
				</div>
			</div>

			<div class="col-xs-6 col-md-4 col-lg-6">
				<div class="form-group">
					{!! Form::label('txtMaterno', 'Materno:', ['class' => 'control-label']) !!}
					{!! Form::text('txtMaterno', null, ['class' => 'form-control']) !!}
				</div>
			</div>

			<div class="col-xs-6 col-md-4 col-lg-6">
				<div class="form-group">
					{!! Form::label('', '&nbsp;', ['class' => 'control-label']) !!}

				</div>
			</div>
		</div>
		<div class="separator bottom"></div>
		<div class="row">
			<div class="col-xs-6 col-md-4 col-lg-6">
				<div class="form-group">
					{!! Form::label('txtTelefono', 'Teléfono:', ['class' => 'control-label']) !!}
					{!! Form::text('txtTelefono', null, ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
				</div>
			</div>

			<div class="col-xs-6 col-md-4 col-lg-6">
				<div class="form-group">
					{!! Form::label('txtCelular', 'Celular:', ['class' => 'control-label']) !!}
					{!! Form::text('txtCelular', null, ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
				</div>
			</div>

			<div class="col-xs-6 col-md-4 col-lg-6">
				<div class="form-group">
					{!! Form::label('txtEmail', 'E-mail:', ['class' => 'control-label']) !!}
					{!! Form::text('txtEmail', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@ejemplo.com']) !!}
				</div>
			</div>
		</div>

		<div class="innerAll bg-gray">
			<div class="form-group">
				{!! Form::button('Agendar >>', ['class' => 'btn btn-primary', 'id' => 'btnAgendar']) !!}
				{!! Form::hidden('opcion', '1', ['id' => 'opcion']) !!}
				{!! Form::hidden('fecha', $fecha, ['id' => 'fecha']) !!}
				{!! Form::hidden('hora', $hora, ['id' => 'hora']) !!}
				{!! Form::hidden('medico', $medico, ['id' => 'medico']) !!}
			</div>
		</div>
	{!! Form::close() !!}
