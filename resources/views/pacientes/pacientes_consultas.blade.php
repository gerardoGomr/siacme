<div class="tab-pane" id="consultas">
    @if($expediente->tieneConsultas())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nota médica</th>
                </tr>
            </thead>
            <tbody>
            @foreach($expediente->consultas() as $consulta)
                <tr>
                    <td>{{ $consulta->getFecha() }}</td>
                    <td>{{ $consulta->getNotaMedica() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4>No se han generado consultas para el paciente actual</h4>
    @endif
</div>