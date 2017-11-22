@extends('base')

@section('contenido')

<a  class="accion" href="/">Volver al menu</a>
<div class="contenido">
	<form method="post" action="/data">
		<div class="linea">
			<span>Nombre:</span><input type="text" name="nombre" />
		</div>
		<div class="linea">
			<span>Fecha:</span><input type="date" name="fecha" />
		</div>
		<div class="linea">
			<span>Puntos (MAX):</span><input type="number" name="puntos_max" />
		</div>	
		<div class="linea">
			<span>Parcial:</span>
			<select name="parcial">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
		</div>
		<div class="linea">
			<span>Activo:</span>
			<select name="activa">
				<option value="1">SI</option>
				<option value="0">NO</option>
			</select>
		</div>
		<div class="linea">
			 <input type="submit" name="enviar" value="Guardar"/>
			 <input type="button" name="cancelar" value="Cancelar" onclick="ir_a_menu()" />
		</div>

		<input type="hidden" name="hidden" value="evaluacion" />

		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<!- este input es para enviar los formularios	-->
	</form>
</div>

@if(Session::has('error'))
<h1 class="error"><b>
{!! Session::get('error') !!}
</b></h1>
@endif

@if(Session::has('exito'))
<h1 class="exito"><b>
{!! Session::get('exito') !!}
</b></h1>
@endif

@endsection