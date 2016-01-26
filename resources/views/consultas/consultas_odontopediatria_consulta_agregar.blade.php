<div class="tab-pane active" id="consulta">
	<div class="form-group">
		<a href="javascript:;" id="btnGuardarConsulta" class="btn btn-primary btn-small"><i class="fa fa-save"></i> Guardar consulta</a>

		<a href="javascript:;" id="btnInterconsulta" class="btn btn-warning btn-small"><i class="fa fa-user-md"></i> Enviar a interconsulta</a>

		<a href="javascript:;" id="btnLaboratorio" class="btn btn-warning btn-small"><i class="fa fa-mail-forward"></i> Enviar a estudios de laboratorio</a>

		<a href="{{ url('consultas/receta/agregar') }}" id="btnReceta" class="btn btn-danger btn-small"><i class="fa fa-edit"></i> Generar receta</a>
	</div>
	<div class="separator"></div>
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="innerAll">
				<div class="box-generic">
					<div class="form-group">
						<label class="control-label">Padecimiento actual:</label>
						<textarea name="txtPadecimiento" id="txtPadecimiento" class="required form-control" rows="8"></textarea>
					</div>

					<div class="form-group">
						<label class="control-label">Interrogatorio por aparatos y sistemas:</label>
						<textarea name="txtInterrogatorio" id="txtInterrogatorio" class="required form-control" rows="8"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-6">
			<div class="innerAll">
				<div class="box-generic">
					<div class="form-group">
						<label class="control-label">Exploración física:</label>
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<label class="control-label">Peso:</label>
								<div class="input-group">
									<input type="text" name="txtPeso" id="txtPeso" value="" placeholder="" class="required numeros form-control">
									<span class="input-group-addon">Kg.</span>
								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<label class="control-label">Talla:</label>
								<div class="input-group">
									<input type="text" name="txtTalla" id="txtTalla" value="" placeholder="" class="required numeros form-control">
									<span class="input-group-addon">m.</span>
								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<div class="form-group">
									<label class="control-label">Pulso:</label>
									<input type="text" name="txtPulso" id="txtPulso" value="" placeholder="" class="required form-control">
								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<label class="control-label">Temperatura:</label>
								<div class="input-group">
									<input type="text" name="txtTemperatura" id="txtTemperatura" value="" placeholder="" class="required numeros form-control">
									<span class="input-group-addon">°C</span>
								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<label class="control-label">Tensión arterial:</label>
								<div class="input-group">
									<input type="text" name="txtTension" id="txtTension" value="" placeholder="" class="form-control">
									<span class="input-group-addon">mm/Hg</span>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group" style="display: none;">
						<label class="control-label">Resultados de estudios de laboratorio:</label>
						<textarea name="txtResultadosLaboratorio" rows="8" class="form-control"></textarea>
					</div>

					<div class="form-group" style="display: none;">
						<label class="control-label">Resultados de interconsulta:</label>
						<textarea name="txtResultadosInterconsulta" rows="8" class="form-control"></textarea>
					</div>
				</div>

				<div class="box-generic">
					<div class="form-group">
						<label class="control-label">Nota médica:</label>
						<textarea name="txtNota" id="txtNota" class="required form-control" rows="8"></textarea>
					</div>

					<div class="form-group">
						<label class="control-label">Comportamiento Frankl</label>
						@foreach ($listaComportamientosFrankl as $comportamientoFrankl)
							<div class="radio">
								<label>
									<input type="radio" name="comportamientoFrankl" value="{{ $comportamientoFrankl->getId() }}"> {{ $comportamientoFrankl->getComportamientoFrankl() }}
								</label>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>