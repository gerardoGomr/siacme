<div class="tab-pane" id="expediente">
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Examen extraoral</h4>
				</div>
				<div class="widget-body">
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Morfología craneofacial</label>
								@foreach($listaMorfologiasCraneofacial as $morfologiaCraneofacial)
									<div class="radio">
										<label>
											<input type="radio" name="craneofacial" value="{{ $morfologiaCraneofacial->getId() }}"> {{ $morfologiaCraneofacial->getMorfologiaCraneoFacial() }}
										</label>
									</div>
								@endforeach
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Morfología facial</label>
								@foreach($listaMorfologiasFacial as $morfologiaFacial)
									<div class="radio">
										<label>
											<input type="radio" name="facial" value="{{ $morfologiaFacial->getId() }}"> {{ $morfologiaFacial->getMorfologiaFacial() }}
										</label>
									</div>
								@endforeach
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Convexividad facial</label>
								@foreach($listaConvexividades as $convexividadFacial)
									<div class="radio">
										<label>
											<input type="radio" name="convexividad" value="{{ $convexividadFacial->getId() }}"> {{ $convexividadFacial->getConvexividadFacial() }}
										</label>
									</div>
								@endforeach
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">ATM</label>
								@foreach($listaAtms as $atm)
									<div class="radio">
										<label>
											<input type="radio" name="atm" value="{{ $atm->getId() }}"> {{ $atm->getATM() }}
										</label>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Examen intraoral</h4>
				</div>
				<div class="widget-body">
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Labios:</label>
								<input type="text" name="txtLabios" id="txtLabios" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Carrillos:</label>
								<input type="text" name="txtCarrillos" id="txtCarrillos" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Frenillos:</label>
								<input type="text" name="txtFrenillos" id="txtFrenillos" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Paladar:</label>
								<input type="text" name="txtPaladar" id="txtPaladar" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Lengua:</label>
								<input type="text" name="txtLengua" id="txtLengua" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Piso de boca:</label>
								<input type="text" name="txtPisoBoca" id="txtPisoBoca" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Parodonto:</label>
								<input type="text" name="txtParodonto" id="txtParodonto" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Úvula:</label>
								<input type="text" name="txtUvula" id="txtUvula" value="" placeholder="" class="required form-control">
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="control-label">Orofaringe:</label>
								<input type="text" name="txtOrofaringe" id="txtOrofaringe" value="" placeholder="" class="required form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-6">
			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Tejidos duros</h4>
				</div>

				<div class="widget-body">
					<div class="form-group">
						<label class="control-label">Tipo de arco:</label>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="arcoTipoI">Tipo I
							</label>
						</div>

						<div class="checkbox">
							<label>
								<input type="checkbox" name="arcoTipoII">Tipo II
							</label>
						</div>
					</div>

					<div class="separator"></div>

					<div class="row">
						<div class="col-xs-12">
							<h4 class="text-small">Dentinción temporal</h4>
							<table class="table table-bordered">
								<thead class="bg-gray">
									<tr>
										<th>Planos terminales</th>
										<th>Der</th>
										<th>Izq</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Escalón mesial</td>
										<td><input type="checkbox" name="mesialDer"></td>
										<td><input type="checkbox" name="mesialIzq"></td>
									</tr>

									<tr>
										<td>Escalón distal</td>
										<td><input type="checkbox" name="distalDer"></td>
										<td><input type="checkbox" name="distalIzq"></td>
									</tr>

									<tr>
										<td>Escalón recto</td>
										<td><input type="checkbox" name="rectoDer"></td>
										<td><input type="checkbox" name="rectoIzq"></td>
									</tr>

									<tr>
										<td>Mesial exagerado</td>
										<td><input type="checkbox" name="exageradoDer"></td>
										<td><input type="checkbox" name="exageradoIzq"></td>
									</tr>

									<tr>
										<td>No determinado</td>
										<td><input type="checkbox" name="noDeterminadoDer"></td>
										<td><input type="checkbox" name="noDeterminadoIzq"></td>
									</tr>

									<tr>
										<td>Relación canina</td>
										<td><input type="checkbox" name="caninaDer"></td>
										<td><input type="checkbox" name="caninaIzq"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-xs-12">
							<h4 class="text-small">Dentinción mixta o permanente</h4>
							<table class="table table-bordered">
								<thead class="bg-gray">
									<tr>
										<th rowspan="2">&nbsp;</th>
										<th colspan="3">Der</th>
										<th colspan="3">Izq</th>
									</tr>
									<tr>
										<th>I</th>
										<th>II</th>
										<th>III</th>
										<th>I</th>
										<th>II</th>
										<th>III</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Relación molar</td>
										<td><input type="checkbox" name="relacionMolarDerI"></td>
										<td><input type="checkbox" name="relacionMolarDerII"></td>
										<td><input type="checkbox" name="relacionMolarDerIII"></td>
										<td><input type="checkbox" name="relacionMolarIzqI"></td>
										<td><input type="checkbox" name="relacionMolarIzqII"></td>
										<td><input type="checkbox" name="relacionMolarIzqIII"></td>
									</tr>

									<tr>
										<td>Relación canina</td>
										<td><input type="checkbox" name="relacionCaninaDerI"></td>
										<td><input type="checkbox" name="relacionCaninaDerII"></td>
										<td><input type="checkbox" name="relacionCaninaDerIII"></td>
										<td><input type="checkbox" name="relacionCaninaIzqI"></td>
										<td><input type="checkbox" name="relacionCaninaIzqII"></td>
										<td><input type="checkbox" name="relacionCaninaIzqIII"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="mordidaBordeBorde"> Mordida borde a borde
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="sobremordidaVertical"> Sobremordida vertical (overbite)
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="sobremordidaHorizontal"> Sobremordida horizontal (overjet)
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="mordidaAbiertaAnterior"> Mordida abierta anterior en mm
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="mordidaCruzadaAnterior"> Mordida cruzada anterior
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="mordidaCruzadaPosterior"> Mordida cruzada posterior
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lineaMediaDental"> Línea media dental
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lineaMediaEsqueletica"> Línea media esquelética
									</label>
								</div>
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="alteracionTamanio"> Alteraciones de tamaño
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="alteracionForma"> Alteraciones de forma
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="alteracionNumero"> Alteraciones de número
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="alteracionEstructura"> Alteraciones de estructura
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="alteracionTextura"> Alteraciones de textura
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="alteracionColor"> Alteraciones de color
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>