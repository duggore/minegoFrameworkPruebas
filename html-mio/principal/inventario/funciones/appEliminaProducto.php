<?php 
include "../../../../conexion/conexion.php";
require "../../../../clases/clsProducto.php";

$idProd = $_POST["idProd"];

$objProd = new clsProducto();

if ($objProd->eliminaProducto($idProd) == true) 
{
	header("Location: ../elimina.php?error_login=<div class='alert alert-success small'>Producto eliminado con éxito</div>");
    exit;
}
else
{
	header("Location: ../elimina.php?error_login=<div class='alert alert-danger small'>Algun error ocurrio, realizalo nuevamente</div>");
    exit;
}
?>