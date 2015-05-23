<?php 	
include "../../../../conexion/conexion.php";
require "../../../../clases/clsControlEmpresa.php";

//recibe datos usuario
$control = $_POST["control"];

//instanciar obj
$objControl = new clsControlEmpresa();

if ($objControl->cambiaStatus($control, 14) == true) 
{
	header("Location: ../../../../login.php?error_login=<div class='alert alert-success'>Cuenta Desactivada</div>");
    exit;
}
else
{
	header("Location: ../../../../login.php?error_login=<div class='alert alert-danger'>Algo ocurrio con los datos de usuario, intenta mas tarde</div>");
    exit;
}
?>