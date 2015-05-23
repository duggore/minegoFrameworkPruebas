<?php 	 
include "../../../conexion/conexion.php";
require "../../../clases/clsVenta.php";

$codProd = $_POST["cod"];
$cantidad = $_POST["cant"];
$rfcEmp = $_POST["rfcEmp"];
$fechaVta = date("Y-m-d");


function devPrecioXCant($cod, $cant)
{
	$sql = mysql_query("SELECT precio_venta FROM tbl_producto WHERE codigo_producto = '$cod'")or die(mysql_error()."FALLA PRECIO VTA");
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0] * $cant;
	}
}

function devIdProd($cod)
{
	$sql = mysql_query("SELECT id_producto FROM tbl_producto WHERE codigo_producto = '$cod'")or die(mysql_error()."FALLA PRECIO VTA");
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}


$objVta = new clsVenta();

if ($objVta->agregaProducto(devIdProd($codProd), $cantidad, devPrecioXCant($codProd, $cantidad), 1, 3, $rfcEmp, $fechaVta) == true) 
{
	header("Location: ../index.php?error_login=<div class='alert alert-success small'>Agrega otro producto o termina venta</div>");
    exit;
}
else
{
	header("Location: ../index.php?error_login=<div class='alert alert-danger small'>El producto no esta en existencia, o algo ocurrio</div>");
    exit;
}
?>