<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro</title>
</head>
<body>
	<form action="/registrar" method="post">
		@csrf
		<h1>Registro</h1>
		@if(isset($errors) && count($errors) > 0)
			<div>
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if(Session::get('success',false))
			<?php $data=Session::get('success');?>
			@if(is_array($data))
				@foreach($data as $message)
					<div>{{ $message }}</div>
				@endforeach
			 @else
			 	<div>{{$data}}</div>
			@endif
		@endif
		<label for="email">Correo Electrónico</label>
		<input type="email" name="email" /><br />
		<label for="name">Nombre</label>
		<input type="text" name="name" /><br />
		<label for="password">Contraseña</label>
		<input type="password" name="password" /><br />
		<label for="password_confirmation">Confirmar Contraseña</label>
		<input type="password" name="password_confirmation" /><br />
		<input type="submit" value="Registrarse">
	</form>
</body>
</html>