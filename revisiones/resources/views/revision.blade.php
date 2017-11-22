@extends('base')

@section('contenido')

<a  class="accion" href="/">Volver al menu</a>
<form method="post" action="/data">

	<div class="contenido">
		<div class="linea">
			<span>Evaluacion:</span>
			<select name="id_evaluacion">
				<option value="0"> -- Seleccione --</option>
				@foreach($evaluaciones as $ev)
				<option value="{{$ev->id}}">{{$ev->nombre}}</option>
				@endforeach	
			</select>
		</div>
		<div class="linea2">
			<span>Nota:</span><textarea name="nota" rows="5"></textarea>
		</div>
		<div class="linea">
			<span>Enlace:</span><input type="text" name="enlace" />
		</div>
	</div>

	<div class="contenido" id="rev1">
		<div class="linea">
			<span>Nombre:</span><input type="text" name="nombre[0]" />
		</div>
		<div class="linea">
			<span>Apellido:</span><input type="text" name="apellido[0]" />
		</div>
		<div class="linea">
			<span>Cedula:</span><input type="text" name="cedula[0]" />
		</div>
	</div>
	<div class="contenido" id="rev2">
		<div class="linea">
			<span>Nombre:</span><input type="text" name="nombre[1]" />
		</div>
		<div class="linea">
			<span>Apellido:</span><input type="text" name="apellido[1]" />
		</div>
		<div class="linea">
			<span>Cedula:</span><input type="text" name="cedula[1]" />
		</div>
	</div>
	<div class="contenido" id="rev3">
		<div class="linea">
			<span>Nombre:</span><input type="text" name="nombre[2]" />
		</div>
		<div class="linea">
			<span>Apellido:</span><input type="text" name="apellido[2]" />
		</div>
		<div class="linea">
			<span>Cedula:</span><input type="text" name="cedula[2]" />
		</div>
	</div>
	<div class="contenido" id="rev4">
		<div class="linea">
			<span>Nombre:</span><input type="text" name="nombre[3]" />
		</div>
		<div class="linea">
			<span>Apellido:</span><input type="text" name="apellido[3]" />
		</div>
		<div class="linea">
			<span>Cedula:</span><input type="text" name="cedula[3]" />
		</div>
	</div>
	<div class="contenido" id="rev5">
		<div class="linea">
			<span>Nombre:</span><input type="text" name="nombre[4]" />
		</div>
		<div class="linea">
			<span>Apellido:</span><input type="text" name="apellido[4]" />
		</div>
		<div class="linea">
			<span>Cedula:</span><input type="text" name="cedula[4]" />
		</div>
	</div>

	<input type="hidden" name="max" id="max" />

	<div class="contenido">
		<div class="linea">
			 <input type="submit" name="enviar" value="Guardar"/>
			 <input type="button" name="cancelar" value="Cancelar" onclick="ir_a_menu()" />
		</div>
	</div>


	<input type="hidden" name="hidden" value="revision" />

	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<!- este input es para enviar los formularios	-->
</form>
<a  class="accion" href="/">Volver al menu</a>

<script type="text/javascript">
//modificacion del maximo en codigo fuente	
var max = 2;

if(max>5)
max=5;
if(max<1)
max=1;

document.getElementById('max').value=max;

for(i=max+1;i<=5;i++)
{
	document.getElementById('rev'+i).style.display='none';
}

</script>


@endsection