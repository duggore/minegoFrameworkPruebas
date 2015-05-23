<?php 
include "../../../../conexion/conexion.php";
require "../../../../clases/clsEmpleado.php";
require "../../../../clases/clsUsuario.php";

$idEmpleado = $_POST["idEmpleado"];

function devIdUsuario($idEmp)
{
	$sql = mysql_query("SELECT id_usuario FROM tbl_empleado WHERE id = '$idEmp'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}


$objEmpleado = new clsEmpleado();
$objUsuario = new clsUsuario();

if ($objEmpleado->eliminaEmpleado($idEmpleado) == true AND $objUsuario->eliminaUsuario(devIdUsuario($idEmpleado)) == true) 
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-success small'>Empleado eliminado con éxito</div>");
    exit;
}
else
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-danger small'>Algun error ocurrio, realizalo nuevamente</div>");
    exit;
}
?>