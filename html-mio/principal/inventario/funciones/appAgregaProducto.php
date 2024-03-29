<?php 	
include "../../../../conexion/conexion.php";
require "../../../../clases/clsProducto.php";

$codProd = $_POST["codigoProducto"];
$nomProd = $_POST["nombreProducto"];
$marca = $_POST["marca"];
$idCat = $_POST["categoria"];
$descripcion = $_POST["descripcion"];
$piezasCaja = $_POST["piezasCaja"];
$pesoPieza = $_POST["pesoPieza"];
$existencia = $_POST["exist"];
$precioProv = $_POST["prepro"];
$precioVta = $_POST["prevta"];
$precioMayo = $_POST["premay"];
$descuento = $_POST["descuento"];
$fechaEnt = $_POST["fechaEnt"];
$rfcEmpresa = $_POST["rfc"];

$objProd = new clsProducto();

if ($objProd->agregaProducto($codProd, $nomProd, $marca, $idCat, $descripcion, 
	$piezasCaja, $pesoPieza, $existencia, $precioProv, $precioVta, 
	$precioMayo, $descuento, $fechaEnt, $rfcEmpresa) == true) 
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-success small'>Producto agregado con éxito</div>");
    exit;
}
else
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-danger small'>Algun error ocurrio, realizalo nuevamente</div>");
    exit;
}
?>