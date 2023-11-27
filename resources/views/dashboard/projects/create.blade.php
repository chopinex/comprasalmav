<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crear Proyecto</title>
</head>
<body>
	<form action="{{route('projects.store')}}" method="post">
		@csrf
		<label for="folder">Carpeta de proyecto:</label>
		<input type="text" name="folder" placeholder="Nombre de carpeta" size="50"/>
		<input	type="submit" value="Crear">

	</form>
</body>
</html>