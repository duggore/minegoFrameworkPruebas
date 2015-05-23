<?php 
include "../../../../conexion/conexion.php";
require "../../../../clases/clsEmpresa.php";

$rfcEmpresa = $_POST["rfcEmpresa"];

function devIdUsuario($idEmp)
{
	$sql = mysql_query("SELECT id_usuario FROM tbl_empleado WHERE id = '$idEmp'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}


$objEmpresa = new clsEmpresa();

if ($objEmpresa->eliminaEmpesa($rfcEmpr) == true) 
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-success small'>Empresa eliminada con éxito</div>");
    exit;
}
else
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-danger small'>Algun error ocurrio, realizalo nuevamente</div>");
    exit;
}
?>