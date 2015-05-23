<?php 
include "../../../conexion/conexion.php";
require "../../../clases/clsNota.php";

$totalPagar = $_POST["totalPagar"];
$fechaVenta = date("Y-m-d H:m:s");
$pagoVenta = $_POST["pagoVenta"];
$cambio = $_POST["cambio"];
$rfcEmp = $_POST["rfcEmp"];

$objNota = new clsNota();

if ($objNota->agregaNota($totalPagar, $fechaVenta, $pagoVenta, $cambio, $rfcEmp, 7) == true) 
{
	header("Location: ../index.php?error_login=<div class='alert alert-success small'>Venta terminada con exito, gracias</div>");
    exit;
}
else
{
	header("Location: ../index.php?error_login=<div class='alert alert-danger small'>Algo ocurrio</div>");
    exit;
}
?>