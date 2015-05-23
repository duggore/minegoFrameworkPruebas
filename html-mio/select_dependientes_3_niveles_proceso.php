<?php
include ("conexion/conexion.php"); 
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"select1"=>"tbl_estados",
"select2"=>"tbl_municipios",
"select3"=>"tbl_localidades"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	$consulta=mysql_query("SELECT id, nombre FROM $tabla WHERE relacion='$opcionSeleccionada'") or die(mysql_error());
	
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id); esVacioMunicipio(); esVacioLocalidades();' onclick='esVacioMunicipio(); esVacioLocalidades();' onkeyup='esVacioMunicipio(); esVacioLocalidades();' class='form-control'>";
	echo "<option value='0'>--</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".utf8_encode(strtoupper($registro[1]))."</option>";
	}			
	echo "</select>";
}
?>