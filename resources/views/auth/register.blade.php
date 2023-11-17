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
		<input type="email" name="email" />
		<input type="text" name="nombre" />
		<input type="password" name="password" />
		<input type="password" name="password_confirmation" />
		<input type="submit" value="Registrarse">
	</form>
</body>
</html>