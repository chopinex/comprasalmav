<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Compras</title>
</head>
<body>
<table>
	<thead>
		<tr>
			<th>Pertenencia</th>
			<th>Tipo Documento</th>
			<th>Numero Documento</th>
			<th>Fecha Documento</th>
			<th>Proveedor</th>
			<th>Area</th>
			<th>Servicio</th>
			<th>Proyecto</th>
			<th>Moneda</th>
			<th>Tipo de Cambio</th>
			<th>Total</th>
			<th>Pagado</th>
			<th>Fecha de pago</th>
			<th>Detalle de pago</th>
			<th>Comentario</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($compras as $buy)
			<tr>
				<td>{{$buy->pertenencia}}</td>
				<td>{{$buy->tipo_documento}}</td>
				<td>{{$buy->numero_documento}}</td>
				<td>{{$buy->fecha_documento}}</td>
				<td>{{$buy->proveedor}}</td>
				<td>{{$buy->area}}</td>
				<td>{{$buy->servicio}}</td>
				<td>{{$buy->proyecto}}</td>
				<td>{{$buy->moneda}}</td>
				<td>{{$buy->tipo_cambio}}</td>
				<td>{{$buy->total}}</td>
				<td>{{$buy->pagado}}</td>
				<td>{{$buy->fecha_pago}}</td>
				<td>{{$buy->detalle_pago}}</td>
				<td>{{$buy->comentario}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<a href="{{route('compras.create')}}">Crear</a>
</body>
</html>