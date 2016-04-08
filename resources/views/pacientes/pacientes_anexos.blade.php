<div class="tab-pane" id="anexos">
	<div class="box-generic">
		{!! Form::open(['url' => url(''), 'id' => 'formAnexo', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
			<div class="form-group">
				<label class="control-label col-md-3">Nombre:</label>
				<div class="col-md-9">
					<input type="text" name="nombreAnexo" id="nombreAnexo" class="form-control required">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Anexo:</label>
				<div class="col-md-9">
					<input type="file" name="anexo" id="anexo" class="form-control required pdf">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-9 col-md-offset-3">
					<input type="button" value="Agregar" class="btn btn-primary">
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>