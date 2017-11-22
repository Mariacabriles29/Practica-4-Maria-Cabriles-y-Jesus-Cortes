@extends('base')

@section('contenido')

<a  class="accion" href="/">Volver al menu</a>
<br/>
<table align="center">
	<thead>
		<tr>
			<td>Evaluacion</td>
			<td>Parcial</td>
			<td>Alumno(s)</td>
			<td>Estado</td>
			<td>Nota final</td>
			<td></td>
		</tr>
	</thead>
	
	@if( count($revisiones)==0 )
	<tr><td colspan="6"><h2 class="error"><b>No hay registros</b></h2></td></tr>
	@endif

	@for($i=0; $i < count($revisiones); $i++)
	<tr>
	<td>{{ $ev[$i]->nombre }}</td>
	<td>{{ $ev[$i]->parcial }}</td>
	<td>
		@for($j=0; $j < count($alumn[$i]); $j++)
			<span>{!! $alumn[$i][$j]->nombre.' '.$alumn[$i][$j]->apellido !!}</span><br/>
		@endfor
	</td>
	<td> @if($revisiones[$i]->calificacion != null ) Corregida: {{$revisiones[$i]->calificacion}} @else --------  @endif</td>
	<td>@if($revisiones[$i]->nota != null ) {{ $revisiones[$i]->nota }} @endif</td>
	<td>
	@if($revisiones[$i]->calificacion == null ) 
		<button name="corregir" onclick="corregir('{{ $revisiones[$i]->id }}')" />Corregir</button>
	@endif
	</td>
	</tr>
	@endfor


</table>

@if(Session::has('error'))
<h1 class="error"><b>
{!! Session::get('error') !!}
</b></h1>
@endif

@endsection