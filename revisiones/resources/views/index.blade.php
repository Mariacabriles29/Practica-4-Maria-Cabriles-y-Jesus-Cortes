@extends('base')

@section('contenido')



@if(Session::has('user'))
<a  class="accion" href="/logout">Cerrar Sesión</a>
<h1 class="bienvenida"><b>
Bienvenido(a): {!! Session::get('user')->nombre.' '.Session::get('user')->apellido !!}</b></h1>
<div class="menu" id="menu2">
	<ul>
		<li><a href="/evaluacion">Agregar Evaluacion</a></li>
		<li><a href="/corregir">Ver Listado</a></li>	
	</ul>
</div>
@else

<div class="contenido">
	<form method="post" action="/login">
		<div class="linea">
			<span>Usuario:</span><input type="text" name="usuario" />
		</div>
		<div class="linea">
			<span>Clave:</span><input type="password" name="clave" />
		</div>
		<div class="linea">
			 <input type="submit" name="boton" value="Iniciar Sesion"/>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<!- este input es para enviar los formularios	-->
	</form>
</div>


<div class="menu" id="menu1">
	<ul>
		<li><a href="/revision">Registrar Alumno(s)</a></li>
	</ul>
</div>
@endif

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