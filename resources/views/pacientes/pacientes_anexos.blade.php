<div class="tab-pane" id="anexos">
	<div class="box-generic">
		<h4>Agregar anexos</h4>
		{!! Form::open(['url' => '', 'id' => 'formAnexos']) !!}
			<div class="form-group">
				<label class="control-label">Anexo:</label>
				<input type="file" name="anexo" id="anexo">
			</div>

			<div class="form-group">
				<input type="button" id="agregar" value="Agregar" class="btn btn-primary">
			</div>
		{!! Form::close() !!}
	</div>
</div>