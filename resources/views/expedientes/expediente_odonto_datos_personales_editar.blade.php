<!-- datos personales -->
<div class="tab-pane active" id="datosPersonales">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNombre', 'Nombre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombre', $expediente->getPaciente()->getNombre(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtPaterno', 'A. Paterno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtPaterno', $expediente->getPaciente()->getPaterno(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtMaterno', 'A. Materno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMaterno', $expediente->getPaciente()->getMaterno(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtFechaNac', 'Fecha de nacimiento:', ['class' => 'control-label', 'maxlength' => '10']) !!}
							{!! Form::text('txtFechaNac', $expediente->getFechaNacimiento(), ['class' => 'fecha form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtEdad', 'Edad:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEdad', $expediente->getEdadAnios(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtLugarNac', 'Lugar de nacimiento:', ['class' => 'control-label']) !!}
							{!! Form::text('txtLugarNac', $expediente->getLugarNacimiento(), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtDireccion', 'Dirección:', ['class' => 'control-label']) !!}
							{!! Form::text('txtDireccion', $expediente->getDireccion(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCP', 'C. P.:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCP', $expediente->getCP(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtMunicipio', 'Municipio:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMunicipio', $expediente->getMunicipio(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtTelefono', 'Teléfono local:', ['class' => 'control-label']) !!}
							{!! Form::text('txtTelefono', $expediente->getPaciente()->getTelefono(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCelular', 'Celular:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCelular', $expediente->getPaciente()->getCelular(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtEmail', 'E-mail:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEmail', $expediente->getPaciente()->getEmail(), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">

							{!! Form::label('automedicado', '¿Ha automedicado a su hijo?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->haAutomedicado())
										{!! Form::radio('automedicado', 1,  true, ['class' => 'automedicado']) !!} Sí
									@else 
					 					{!! Form::radio('automedicado', 1,  null, ['class' => 'automedicado']) !!} Sí
					 				@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->haAutomedicado() === false)
										{!! Form::radio('automedicado', 2,  true, ['class' => 'automedicado']) !!} No
									@else 
					 					{!! Form::radio('automedicado', 2,  null, ['class' => 'automedicado']) !!} No
					 				@endif
								</label>
							</div>

					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtConQueHaAutomedicado', '¿Con qué?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtConQueHaAutomedicado', $expediente->getConQueSeHaAutomedicado(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-6">
							{!! Form::label('alergico', '¿Es alérgico a algún medicamento?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->esAlergico())
										{!! Form::radio('alergico', 1, true, ['class' => 'alergico']) !!} Sí
									@else
										{!! Form::radio('alergico', 1, null, ['class' => 'alergico']) !!} Sí
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->esAlergico() === false)
										{!! Form::radio('alergico', 2, true, ['class' => 'alergico']) !!} No
									@else
										{!! Form::radio('alergico', 2, null, ['class' => 'alergico']) !!} No
									@endif
								</label>
							</div>

					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtACualEsAlergico', '¿Cuál?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtACualEsAlergico', $expediente->getAQueMedicamentoEsAlergico(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNombrePadre', 'Nombre del padre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombrePadre', $expediente->getNombrePadre(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtOcupacionPadre', 'Ocupación:', ['class' => 'control-label']) !!}
							{!! Form::text('txtOcupacionPadre', $expediente->getOcupacionPadre(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNombreMadre', 'Nombre de la madre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombreMadre', $expediente->getNombreMadre(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtOcupacionMadre', 'Ocupación:', ['class' => 'control-label']) !!}
							{!! Form::text('txtOcupacionMadre', $expediente->getOcupacionMadre(), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtPediatra', 'Nombre del pediatra:', ['class' => 'control-label']) !!}
							{!! Form::text('txtPediatra', $expediente->getNombrePediatra(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtRecomienda', '¿Quién lo recomienda?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtRecomienda', $expediente->getNombreRecomienda(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtMotivoConsulta', 'Motivo de consulta:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMotivoConsulta', $expediente->getMotivoConsulta(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtHistoriaEnfermedad', 'Historia de la enfermedad actual:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtHistoriaEnfermedad', $expediente->getHistoriaEnfermedad(), ['class' => 'form-control', 'rows' => '6']) !!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<a href="javascript:;" title="Guardar>>" class="guardar btn btn-primary"><i class="fa fa-save"></i> Guardar</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->