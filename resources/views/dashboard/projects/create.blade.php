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
		<input type="text" name="folder" placeholder="Nombre de carpeta" size="50"/><br />
		<label for="area">Area de proyecto:</label>
		<select name="area">
			<option value="AlmaV" selected>AlmaV</option>
			<option value="Mapachio">Mapachio</option>
			<option value="Hache1">Hache1</option>
			<option value="Admin">Admin</option>
		</select><br />
		<label for="scope">Ámbito:</label>
		<select name="scope">
			<option value="Interno" selected>Interno</option>
			<option value="Externo" selected>Externo</option>
		</select><br />
		<label for="type">Tipo:</label>
		<select name="type">
			<option value="Web">Web</option>
			<option value="Diseño">Diseño</option>
			<option value="Campaña digital">Campaña digital</option>
		</select><br />
		<input	type="submit" value="Crear">

	</form>
</body>
</html>