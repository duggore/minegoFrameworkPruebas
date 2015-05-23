<?php 	
include "../../../../conexion/conexion.php";
require "../../../../clases/clsEmpleado.php";
require "../../../../clases/clsUsuario.php";

//recibe datos usuario
$idEmpleado = $_POST["idEmpleado"];
$idUsuario = $_POST["idUsuario"];

$usuario = 	$_POST["usr"];
$pwd = 		$_POST["pwd2"];
$tipoEmp = $_POST["tipoEmpleado"];

//recibe datos empleado
$nombre = 	$_POST["nombre"];
$paterno = 	$_POST["pat"];
$materno = 	$_POST["mat"];
$edo = 		$_POST["select1"];
$mpo = 		$_POST["select2"];
$loc = 		$_POST["select3"];
$calle = 	$_POST["calle"];
$noEx = 	$_POST["noEx"];
$noIn = 	$_POST["noIn"];
$cp = 		$_POST["cp"];
$telFijo = 	$_POST["tf"];
$telMovil = $_POST["tm"];
$correo = 	$_POST["mail"];

$rfcEmpresa = $_POST["rfcEmp"];

//instanciar obj
$objUsr = new clsUsuario();
$objEmpleado = new clsEmpleado();

if ($objUsr->actualizaUsuario($idUsuario, $usuario, $pwd, $tipoEmp, $correo) == true) 
{
	if ($objEmpleado->actualizaEmpleado($idEmpleado, $nombre, $paterno, $materno, $edo, $mpo, $loc, $calle, $noEx, $noIn, $cp, 
	$telFijo, $telMovil, $correo, $tipoEmp, 1, $objUsr->devIdUsuario($usuario, $pwd, $tipoEmp, $correo), $rfcEmpresa) == true) 
	{
		header("Location: ../agrega.php?error_login=<div class='alert alert-success'>Empleado actualizado con éxito</div>");
        exit;
	}
	else
	{
		header("Location: ../agrega.php?error_login=<div class='alert alert-danger'>Algo ocurrio con los datos, intenta mas tarde</div>");
        exit;
	}
}
else
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-danger'>Algo ocurrio con los datos de usuario, intenta mas tarde</div>");
    exit;
}
?>