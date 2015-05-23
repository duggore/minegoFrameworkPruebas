<?php  
//incluye librerias
include "../conexion/conexion.php";
require "../clases/clsUsuario.php";
require "../clases/clsEmpleado.php";
require "../clases/clsEmpresa.php";


//recibe datos usuario
$usuario = 	$_POST["usr"];
$pwd = 		$_POST["pwd2"];

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

//datos empresa
$rfcEmpresa = 	$_POST["rfcEmpr"];
$nombreNego = 	$_POST["nombNego"];
$giro = 		$_POST["idGiro"];
$razon = 		$_POST["idRazon"];
$tipo = 		$_POST["idTipo"];
$descripcion = 	$_POST["desc"];


//instanciar obj
$objUsr = new clsUsuario();
$objEmpleado = new clsEmpleado();
$objEmpresa = new clsEmpresa(); 

if ($objUsr->agregaUsuario($usuario, $pwd, 1, $correo) == true) 
{
	if ($objEmpresa->agregaEmpresaDefault($rfcEmpresa, $nombreNego, $giro, $razon, $tipo, $descripcion) == true) 
	{
		if ($objEmpleado->agregaEmpleado($nombre, $paterno, $materno, $edo, $mpo, $loc, $calle, $noEx, $noIn, $cp, 
		$telFijo, $telMovil, $correo, 1, 1, $objUsr-> devIdUsrSes($usuario, $pwd), $rfcEmpresa) == true) 
		{
			header("Location: ../login.php?error_login=<div class='alert alert-success'>Bienvenido puede iniciar sesión</div>");
        	exit;
		}
		else
		{
			header("Location: ../login.php?error_login=<div class='alert alert-danger'>Algo ocurrio con tus datos, intenta mas tarde</div>");
        	exit;
		}
	}
	else
	{
		header("Location: ../login.php?error_login=<div class='alert alert-danger'>Algo ocurrio con los datos de la empresa, intenta mas tarde</div>");
		exit;
	}
}
else
{
	header("Location: ../login.php?error_login=<div class='alert alert-danger'>Algo ocurrio con los datos de usuario, intenta mas tarde</div>");
    exit;
}
?>