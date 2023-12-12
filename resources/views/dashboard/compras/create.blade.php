<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrar compra</title>
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

	<form action="{{route('compras.store')}}" method="post">
		<h2>Compras</h2>
		@csrf
		<input type="radio" id="almav" name="pertenencia" value="ALMAV" checked>
		<label for="almav">ALMAV</label>
		<input type="radio" id="JoseCarlos" name="pertenencia" value="Jose Carlos">
		<label for="JoseCarlos">Jose Carlos</label>
		<input type="radio" id="ninguna" name="pertenencia" value="NINGUNA">
		<label for="ninguna">Ninguna</label><br>
		<label for="tipo_documento">Tipo de Documento</label>
		<select name="tipo_documento">
			<option value="Recibo por honorarios" selected>Recibo por honorarios</option>
			<option value="Factura">Factura</option>
			<option value="Boleta">Boleta</option>
			<option value="Nota de Crédito">Nota de Crédito</option>
			<option value="Invoice">Invoice</option>
			<option value="Factura faltante">Factura faltante</option>
			<option value="Documento de banco">Documento de banco</option>
			<option value="Otro">Otro</option>
			<option value="Nada">Nada</option>
		</select><br>
		<label for="numero_documento">Nro. de Documento</label>
		<input type="text" name="numero_documento" required><br>
		<label for="fecha_documento">Fecha de Documento</label>
		<input type="datetime-local" name="fecha_documento" id="fecha_documento"><br>
		<label for="proveedor">Proveedor</label>
		<input type="text" name="proveedor" size=50 required><br>
		<label for="area">Area</label>
		<select name="area" id="area" required>
				<option value="" selected>Seleccione</option>
			@foreach ($areas as $area)
				<option value="{{$area->nombre_area}}">{{$area->nombre_area}}</option>
			@endforeach
		</select><br>
		<label for="servicio">Servicio</label>
		<input list="servicios" name="servicio" placeholder="Click para desplegar lista" size=50 required><br>
		<datalist id="servicios">
		</datalist>
		<label for="proyecto">Proyecto</label>
		<input type="text" name="proyecto" size=50 required><br>
		<input type="radio" id="soles" name="moneda" value="soles" checked>
		<label for="soles">Soles</label>
		<input type="radio" id="dolares" name="moneda" value="dólares">
		<label for="dolares">Dólares</label><br>
		<div id="para_tipo" class="hide">
		<label for="tipo_cambio" id="label_tipo_cambio">Tipo de cambio</label>
		<input type="text" name="tipo_cambio" id="tipo_cambio" placeholder="0.00" required min="0.00" value="0.00" step="0.05" pattern="^\d+(?:\.\d{2})?$"><br>
		</div>
		<label for="total">Total</label>
		<input type="text" name="total" placeholder="0.00" required pattern="^\d+(?:\.\d{2})?$" id="total"><br>
		<label for="pagado">Pagado</label>
		<input type="text" name="pagado" placeholder="0.00" required pattern="^\d+(?:\.\d{2})?$" id="pagado"><br>
		<label for="fecha_pago">Fecha de Pago</label>
		<input type="datetime-local" name="fecha_pago" id="fecha_pago"><br>
		<label for="detalle_pago">Detalle de pago</label>
		<input type="text" name="detalle_pago" size=50><br>
		<label for="comentario">Comentario</label>
		<input type="text" name="comentario" size=50><br>
		<input	type="submit" value="Crear">
	</form>

	<script>
	window.addEventListener('load', () => {
	  var now = new Date();
	  now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

	  /* remove second/millisecond if needed - credit ref. https://stackoverflow.com/questions/24468518/html5-input-datetime-local-default-value-of-today-and-current-time#comment112871765_60884408 */
	  now.setMilliseconds(null)
	  now.setSeconds(null)

	  document.getElementById('fecha_documento').value = now.toISOString().slice(0, -1);
	  document.getElementById('fecha_pago').value = now.toISOString().slice(0, -1);
	});


    document.addEventListener('DOMContentLoaded', function () {
        const select1 = document.getElementById('area');
        const select2 = document.getElementById('servicios');
        const check1 = document.getElementById('dolares');
        const check2 = document.getElementById('soles');
        const tipo = document.getElementById('para_tipo');
        const total = document.getElementById('total');
        const pagado = document.getElementById('pagado');

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