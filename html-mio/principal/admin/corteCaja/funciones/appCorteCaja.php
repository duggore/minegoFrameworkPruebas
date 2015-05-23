<?php  
include "../../../../conexion/conexion.php";
require "../../../../clases/clsCorteCaja.php";


$prodVendidos = $_POST["cantidad"];
$corteInicio = $_POST["corteInicio"];
$corteFinal = $_POST["corteTermino"];
$fechaCorte = date("Y-m-d");
$rfcEmpresa = $_POST["rfcEmpresa"];

$objCorteCaja = new clsCorteCaja();

function devIdCorte($rfcEmpresa)
{
	$sql = mysql_query("SELECT id_corte FROM tbl_corte WHERE rfcEmpresa = '$rfcEmpresa' AND id_status = '3' ORDER BY id_corte DESC")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}

if ($objCorteCaja->realizaCorte(devIdCorte($rfcEmpresa), $prodVendidos, $corteFinal, $fechaCorte, $rfcEmpresa) == true) 
{
	if($objCorteCaja->agregaCorteInicioDiaSig($corteFinal, $rfcEmpresa, date('Y-m-d', strtotime('+1 day'))) == true)
	{	
		header("Location: ../index.php?error_login=<div class='alert alert-success small'>Corte finalizado con exito, aparte las ganacias y guardelas en un lugar seguro</div>");
		exit;
	}
	else
	{
		header("Location: ../index.php?error_login=<div class='alert alert-danger small'>No se agrego corte</div>");
	    exit;
	}
}
else
{
	header("Location: ../index.php?error_login=<div class='alert alert-danger small'>Algo ocurrio</div>");
    exit;
}
?>