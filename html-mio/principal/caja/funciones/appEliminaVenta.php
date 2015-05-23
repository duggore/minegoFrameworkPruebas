<?php 
include "../../../conexion/conexion.php";
require "../../../clases/clsVenta.php";

$idVenta = $_POST["idVenta"];

$objVenta = new clsVenta();

if ($objVenta->cancelaProducto($idVenta, devIdProdVta($idVenta), devCantProdVta($idVenta)) == true)
{
	header("Location: ../index.php?error_login=<div class='alert alert-success small'>Producto quitado de la lista</div>");
    exit;
}
else
{
	header("Location: ../index.php?error_login=<div class='alert alert-danger small'>Algo ocurrio, intentalo de nuevo</div>");
    exit;
}

function devIdProdVta($id)
{
	$sql = mysql_query("SELECT id_producto FROM tbl_venta WHERE id_venta = '$id'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return  $dts[0];
	}
}

function devCantProdVta($id)
{
	$sql = mysql_query("SELECT cantidad FROM tbl_venta WHERE id_venta = '$id'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return  $dts[0];
	}
}
?>