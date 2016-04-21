<div class="tab-pane" id="interconsultas">
	@if($expediente->tieneInterconsultas())
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Medico</th>
					<th>Referencia</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($expediente->getListaInterconsultas() as $interconsulta)
					<tr>
						<td>Fecha</td>
						<td>{{ $interconsulta->getMedico()->getNombreCompleto() }}</td>
						<td>{{ $interconsulta->getReferencia() }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h4>No se han generado interconsultas para el paciente actual</h4>
	@endif
</div>