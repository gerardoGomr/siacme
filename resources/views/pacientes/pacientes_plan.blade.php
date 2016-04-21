<div class="tab-pane" id="plan">
    @if($expediente->tienePlanesTratamiento())
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Atendido</th>
                <th>Costo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($expediente->getListaPlanesTratamiento() as $plan)
                <tr>
                    <td>-</td>
                    <td>{{ $plan->atendido() ? 'Atendido' : 'Activo' }}</td>
                    <td>{{ '$' . number_format($plan->getCosto(), 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4>No se han generado planes de tratamiento para el paciente actual</h4>
    @endif
</div>