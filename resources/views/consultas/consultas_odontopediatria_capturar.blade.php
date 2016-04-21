@extends('app')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/components/modules/admin/modals/assets/css/jquery.fancybox.css') }}">
@stop

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-unscrollable box col-separator-first">
				<div class="col-table">
					<div class="innerAll">
						<div class="media">
							<img src="{{ $expediente->getPaciente()->tieneFoto() ? asset($expediente->getPaciente()->getFotografia()->getRuta()) : '' }}" class="thumb pull-left" alt="" width="100">
							<div class="media-body innerAll half">
								<h4 class="media-heading">{{ $expediente->getPaciente()->getNombreCompleto() }}</h4>
								<p>{{ $expediente->getPaciente()->getEdadAnios() }} años<br/>Vive en: {{ $expediente->getPaciente()->getLugarNacimiento() }}<br/>Expediente {{ $expediente->numeroExpediente() }}</p>
							</div>
						</div>
					</div>

					<div class="col-separator-h"></div>

					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="relativeWrap">
									<div class="widget widget-tabs widget-tabs-responsive">
										<div class="widget-head">
											<ul>
												<li class="active">
													<a href="#consulta" data-toggle="tab"><i class="fa fa-user"></i> Consulta</a>
												</li>

												@if($expediente->primeraVez() === true)
													<li>
														<a href="#expediente" data-toggle="tab"><i class="fa fa-folder-open"></i> Expediente</a>
													</li>
												@endif
												@if($expediente->tienePlanesTratamiento())
													<?php $atendido = true; ?>
													@foreach($expediente->getListaPlanesTratamiento() as $plan)
														<?php
														if (!$plan->atendido()) {
															$atendido = false;
														}
														?>
													@endforeach

													@if ($atendido)
														<li>
															<a href="#odontograma" data-toggle="tab"><i class="fa fa-search"></i> Odontograma</a>
														</li>
													@endif
												@else
													<li>
														<a href="#odontograma" data-toggle="tab"><i class="fa fa-search"></i> Odontograma</a>
													</li>
												@endif
												<li>
													<a href="#plan" data-toggle="tab"><i class="fa fa-search"></i> Plan Tratamiento</a>
												</li>
											</ul>
										</div>
										<div class="widget-body">
											{!!
												Form::open([
													'url'   => 'consultas/guardar',
													'id'    => 'formConsulta'
												])
											!!}
												<div class="tab-content">
													@include('consultas.consultas_odontopediatria_consulta_agregar')
													@if($expediente->primeraVez())
														@include('consultas.consultas_odontopediatria_expediente_agregar')
													@endif
													@if($expediente->tienePlanesTratamiento())
														<?php $atendido = true; ?>
														@foreach($expediente->getListaPlanesTratamiento() as $plan)
															<?php
																if (!$plan->atendido()) {
																	$atendido = false;
																}
															?>
														@endforeach

														@if ($atendido)
															@include('consultas.consultas_odontopediatria_odontograma')
														@endif
													@else
														@include('consultas.consultas_odontopediatria_odontograma')
													@endif

													@include('consultas.consultas_odontopediatria_plan_atencion')

													<?php // @include('consultas.consultas_odontopediatria_historial') ?>
												</div>
												<input type="hidden" name="userMedico" id="userMedico" value="{{ base64_encode($expediente->getMedico()->getUsername()) }}">
												<input type="hidden" name="idPaciente" id="idPaciente" value="{{ base64_encode($expediente->getPaciente()->getId()) }}">

												<input type="hidden" id="generoReceta" value="0">
												<input type="hidden" id="generoPlan" value="0">
												<input type="hidden" id="generoInterconsulta" value="0">
												<input type="hidden" id="url" value="{{ url('consultas') }}">
											{!! Form::close() !!}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/additional-methods.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/modals/assets/js/jquery.fancybox.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/validaciones.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/consultas/consultas_odontopediatria_capturar.js') }}"></script>
@stop