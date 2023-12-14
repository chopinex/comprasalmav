<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Editar</title>
</head>
<body>
	<style>
  		.hide{
  			display:none;
		}
  		.show {
  			display: inline;
		}
	</style>

	<form action="{{route('compras.update',$compra)}}" method="post">
		<h2>Compras</h2>
		@csrf
		@method('PUT')
		<input type="radio" id="almav" name="pertenencia" value="ALMAV" {{ $compra->pertenencia == "ALMAV" ? 'checked' : '' }}>
		<label for="almav">ALMAV</label>
		<input type="radio" id="JoseCarlos" name="pertenencia" value="Jose Carlos" {{ $compra->pertenencia == "Jose Carlos" ? 'checked' : '' }}>
		<label for="JoseCarlos">Jose Carlos</label>
		<input type="radio" id="ninguna" name="pertenencia" value="NINGUNA" {{ $compra->pertenencia == "NINGUNA" ? 'checked' : '' }}>
		<label for="ninguna">Ninguna</label><br>
		<label for="tipo_documento">Tipo de Documento</label>
		<select name="tipo_documento">
			<option value="Recibo por honorarios" {{ $compra->tipo_documento == "Recibo por honorarios" ? 'selected' : '' }}>Recibo por honorarios</option>
			<option value="Factura" {{ $compra->tipo_documento == "Factura" ? 'selected' : '' }}>Factura</option>
			<option value="Boleta" {{ $compra->tipo_documento == "Boleta" ? 'selected' : '' }}>Boleta</option>
			<option value="Nota de Crédito" {{ $compra->tipo_documento == "Nota de Crédito" ? 'selected' : '' }}>Nota de Crédito</option>
			<option value="Invoice" {{ $compra->tipo_documento == "Invoice" ? 'selected' : '' }}>Invoice</option>
			<option value="Factura faltante" {{ $compra->tipo_documento == "Factura faltante" ? 'selected' : '' }}>Factura faltante</option>
			<option value="Documento de banco" {{ $compra->tipo_documento == "Documento de banco" ? 'selected' : '' }}>Documento de banco</option>
			<option value="Otro" {{ $compra->tipo_documento == "Otro" ? 'selected' : '' }}>Otro</option>
			<option value="Nada" {{ $compra->tipo_documento == "Nada" ? 'selected' : '' }}>Nada</option>
		</select><br>
		<label for="numero_documento">Nro. de Documento</label>
		<input type="text" name="numero_documento" required value="{{$compra->numero_documento}}"><br>
		<label for="fecha_documento">Fecha de Documento</label>
		<input type="datetime-local" name="fecha_documento" id="fecha_documento" value="{{$compra->fecha_documento}}"><br>
		<label for="proveedor">Proveedor</label>
		<input type="text" name="proveedor" size=50 required value="{{$compra->proveedor}}"><br>
		<label for="area">Area</label>
		<select name="area" id="area" required>
			@foreach ($areas as $area)
				<option value="{{$area->nombre_area}}" {{ $area->nombre_area == $compra->area ? 'selected' : '' }}>{{$area->nombre_area}}</option>
			@endforeach
		</select><br>
		<label for="servicio">Servicio</label>
		<input list="servicios" name="servicio" placeholder="Click para desplegar lista" size=50 required value="{{$compra->servicio}}"><br>
		<datalist id="servicios">
		</datalist>
		<label for="proyecto">Proyecto</label>
		<input type="text" name="proyecto" size=50 required value="{{$compra->proyecto}}"><br>
		<input type="radio" id="soles" name="moneda" value="soles" {{ $compra->moneda == "soles" ? 'checked' : '' }}>
		<label for="soles">Soles</label>
		<input type="radio" id="dolares" name="moneda" value="dólares" {{ $compra->moneda == "dólares" ? 'checked' : '' }}>
		<label for="dolares">Dólares</label><br>
		<div id="para_tipo" class="{{ $compra->moneda == 'dólares' ? 'show' : 'hide' }} ">
		<label for="tipo_cambio" id="label_tipo_cambio">Tipo de cambio</label>
		<input type="text" name="tipo_cambio" id="tipo_cambio" placeholder="0.00" required value="{{$compra->tipo_cambio}}" pattern="^\d+(?:\.\d{2})?$"><br>
		</div>
		<label for="total">Total</label>
		<input type="text" name="total" placeholder="0.00" required pattern="^\d+(?:\.\d{2})?$" id="total" value="{{$compra->total}}"><br>
		<label for="pagado">Pagado</label>
		<input type="text" name="pagado" placeholder="0.00" required pattern="^\d+(?:\.\d{2})?$" id="pagado" value="{{$compra->pagado}}"><br>
		<label for="fecha_pago">Fecha de Pago</label>
		<input type="datetime-local" name="fecha_pago" id="fecha_pago" value="{{$compra->fecha_pago}}"><br>
		<label for="detalle_pago">Detalle de pago</label>
		<input type="text" name="detalle_pago" size=50 value="{{$compra->detalle_pago}}"><br>
		<label for="comentario">Comentario</label>
		<input type="text" name="comentario" size=50 value="{{$compra->comentario}}"><br>
		<input	type="submit" value="Actualizar">
	</form>
	<a href="/compras">Volver</a>
	<script>
	
    document.addEventListener('DOMContentLoaded', function () {
        const select1 = document.getElementById('area');
        const select2 = document.getElementById('servicios');
        const check1 = document.getElementById('dolares');
        const check2 = document.getElementById('soles');
        const tipo = document.getElementById('para_tipo');
        const total = document.getElementById('total');
        const pagado = document.getElementById('pagado');
        const cambio = document.getElementById('tipo_cambio');

        select1.addEventListener('change', function () {
            const selectedValue = select1.value;
            // Realizar la llamada AJAX
            fetch(`/obtener-opciones/${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    // Limpiar las opciones actuales en el segundo select
                    select2.innerHTML = '';

                    // Agregar las nuevas opciones al segundo select
                    data.forEach(option => {
                        const optionElement = document.createElement('option');
                        console.log(option);
                        optionElement.value = option.servicio;
                        optionElement.text = option.servicio;
                        select2.appendChild(optionElement);
                    });
                })
                .catch(error => console.error('Error:', error));
        });

        check1.addEventListener('change', function() {
        	 if(this.checked){
    			tipo.classList.remove( "hide" );
    			tipo.classList.add( "show" );
    		}
    	});
    	check2.addEventListener('change', function() {
  			if(this.checked){
			    tipo.classList.remove( "show" );
			    tipo.classList.add("hide");
  			}
        });
        cambio.addEventListener('blur',e=>{
    		e.currentTarget.value = parseFloat(e.currentTarget.value).toFixed(2);
    		if(isNaN(e.currentTarget.value))
    			e.currentTarget.value="0.00";
    	});
    	total.addEventListener('blur',e=>{
    		e.currentTarget.value = parseFloat(e.currentTarget.value).toFixed(2);
    		if(isNaN(e.currentTarget.value))
    			e.currentTarget.value="0.00";
    	});
    	pagado.addEventListener('blur',e=>{
    		e.currentTarget.value = parseFloat(e.currentTarget.value).toFixed(2);
    		if(isNaN(e.currentTarget.value))
    			e.currentTarget.value="0.00";
    	});
    });
	</script>
</body>
</html>