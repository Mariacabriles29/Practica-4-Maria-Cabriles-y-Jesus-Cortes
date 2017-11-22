
function ir_a_menu()
{
	document.location="/";
}

function corregir(id)
{
	val = prompt("Ingrese calificacion:");
	if(parseInt(val)!=NaN)
	{
		document.location="asignar/"+id+"/"+parseInt(val);
	}
}