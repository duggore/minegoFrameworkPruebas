<?php 	
include "../../conexion/conexion.php";
require "../../clases/clsUsuario.php";

//recibe datos usuario
$idUsuario = $_POST["idUsuario"];

//instanciar obj
$objUsr = new clsUsuario();

if ($objUsr->activaUsuario($idUsuario, 2) == true) 
{
	header("Location: ../redirecciona.php");
    exit;
}
else
{
	header("Location: ../.../login.php?error_login=<div class='alert alert-danger'>Algo ocurrio no se activo cuenta, intenta mas tarde</div>");
    exit;
}
?>