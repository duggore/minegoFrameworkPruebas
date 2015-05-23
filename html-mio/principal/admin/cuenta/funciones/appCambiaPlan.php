<?php 	
include "../../../../conexion/conexion.php";
require "../../../../clases/clsControlEmpresa.php";

$id_control = $_POST["control"];
$id_plan = $_POST["plan"];
$fup = date("Y-m-d");


function devDiasVencimiento($id)
{
	$sql = mysql_query("SELECT dias FROM tbl_plazos WHERE id_plazo = '$id'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}
function devIdPlazoPlan($id)
{
	$sql = mysql_query("SELECT id_plazo FROM tbl_planes WHERE id_plan = '$id'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}

$fv = date("Y-m-d",strtotime("+".devDiasVencimiento(devIdPlazoPlan($id_plan))." day"));

//instanciar obj
$objControl = new clsControlEmpresa();

if($objControl->cambiaPlan($id_control, $fup, $fv, $id_plan, 2, 12) == true)
{
	header("Location: ../control.php?error_login=<div class='alert alert-success'>Plan contratado, espera a que se valide tu pago para continuar usando 'MiNego'</div>");
    exit;
}
else
{
	header("Location: ../control.php?error_login=<div class='alert alert-danger'>Algo ocurrio</div>");
    exit;
}
?>