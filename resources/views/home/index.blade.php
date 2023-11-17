<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bienvenido</title>
</head>
<body>
	<h1>Hola</h1>

	@auth
		<p>Bienvenido {{auth()->user()->name}}, estás autenticado</p>
		<p><a href="/logout">Cerrar Sesión</a></p>
	@endauth
	@guest
		<p>Para ver el contenido <a href="/ingresar">Inicia sesión</a></p>
	@endguest
</body>
</html>