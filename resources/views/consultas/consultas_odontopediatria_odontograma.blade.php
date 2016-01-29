<div class="tab-pane" id="odontograma">
	<input type="hidden" id="urlOdontograma" value="{{ url('consultas/odontograma/dibujar') }}">

	<div id="dvOdontograma" class="table-responsive">
		{!! $dibujadorOdontograma->dibujar() !!}
	</div>

	@include('consultas.consultas_odontopediatria_seleccion_diente_padecimiento')
</div>