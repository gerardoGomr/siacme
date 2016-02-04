@extends('app_no_sidebar')

@section('loginClass')
	loginWrapper
@stop

@section('titulo')
	<i class="fa fa-lock"></i> Inicio de sesión
@stop

@section('contenido')
	<div class="login">
		<!--<div class="placeholder text-center"><i class="fa fa-user-md"></i></div>-->
		<div class="placeholder text-center"><img src="{{ asset('public/img/boka.jpg') }}" width="100">&nbsp;<img src="{{ asset('public/img/orl.jpg') }}" width="150"></div>
		<div class="separator bottom"></div>
		<div class="panel panel-default col-sm-6 col-sm-offset-3">
			<div class="panel-body">
				@if (isset($error))
                    <div class="alert alert-danger">
                        <strong>Error de acceso</strong>
                        {{ $error }}
                    </div>
                @endif

				{!! Form::open([
					'url'    => 'login',
					'name' 	 => 'formLogin',
					'method' => 'post'
				]) !!}

					<div class="form-group">
						{!! Form::text('txtUsername', null, [
								'id'		   => 'txtUsername',
								'class'        => 'form-control',
								'placeholder'  => 'Nombre de usuario',
								'autocomplete' => 'off'
							])
						!!}
					</div>

					<div class="form-group">
						{!! Form::password('txtPassword', [
								'class'       => 'form-control',
								'placeholder' => 'Contraseña'
							])
						!!}
					</div>

					{!! Form::submit('Ingresar>>', ['class' => 'btn btn-primary btn-block']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop

@section('js')
	<script src="{{ asset('public/js/login.js') }}"></script>
@stop