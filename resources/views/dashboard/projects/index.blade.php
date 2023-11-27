<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projects</title>
</head>
<body>
<table>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Año</th>
			<th>Area</th>
			<th>Ámbito</th>
			<th>Tipo</th>
			<th>Ver Carpeta</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($projects as $prj)
			<tr>
				<td>{{$prj->project_name}}</td>
				<td>{{$prj->year}}</td>
				<td>{{$prj->area}}</td>
				<td>{{$prj->scope}}</td>
				<td>{{$prj->type}}</td>
				<td> <a href={{$prj->drive_folder}}>Ver carpeta </a></td>
			</tr>
		@endforeach
	</tbody>
</table>
<a href="{{route('projects.create')}}">Crear</a>
</body>
</html>