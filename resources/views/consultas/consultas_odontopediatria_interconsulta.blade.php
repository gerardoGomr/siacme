<!-- crear la estructura html para la selección de un médico para interconsultas -->
<div id="dvInterconsulta" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Envío a interconsulta</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: scroll;">
                <div class="form-group">
                    <label class="control-label">Médico:</label>
                    <select name="receta" id="receta" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($listaMedicos as $medicoReferencia)
                            <option value="{{ $medicoReferencia->getId() }}">{{ $medicoReferencia->getNombreCompleto() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Detalles</label>
                    <textarea name="txtReceta" id="txtReceta" class="form-control" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <a href="{{ url('consultas/capturar/interconsulta') }}" class="btn btn-success" id="btnGuardarInterconsulta"><i class="fa fa-check"></i> Aceptar</a>
                </div>
            </div>
        </div>
    </div>
</div>