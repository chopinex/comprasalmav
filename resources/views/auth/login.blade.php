<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<div>
		<a href="/auth/google/redirect">Ingresar con Google</a>
	</div>
	<form action="/ingresar" method="post">
		@csrf
		<h1>Acceso</h1>
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
		<label for="email">email</label>
		<input type="email" name="email"><br />
		<label for="password">password</label>
		<input type="password" name="password"><br />
		<input type="submit" value="Ingresar">
	</form>
</body>
</html>