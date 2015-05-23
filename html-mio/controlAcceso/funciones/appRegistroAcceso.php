<?php  
include "../../conexion/conexion.php";
require "../../clases/clsControlEmpleado.php";
require "../../clases/clsUsuario.php";

//recibe valores de login
$usuario = $_POST['usuario'];
$pwd = $_POST['password'];
$error_login=isset($_POST['error_login']) ? $_POST['error_login'] : NULL;

$fechaActual = date("Y-m-d");

$fechaControl = date("Y-m-d");
$horaControl = date("Y-m-d H:m:s");

$objControl = new clsControlEmpleado();
$objUsr = new clsUsuario();

$idUsuario = $objUsr->devIdUsrSes($usuario,$pwd);
$idEmpleado = $objControl->devIdEmpleado($idUsuario);

//validamos usuario
if ($usuario == "") {//Si no agrega el usuario regresar la notificacion
    header("Location: ../login.php?error_login=<div class='alert alert-danger small'>Debe colocar nombre  usuario</div>");
    exit;
}
else
{
    if ($pwd == "") {//Si no existe el usuario regresar la notificacion
	    header("Location: ../login.php?error_login=<div class='alert alert-danger small'>Debe colocar una contraseña</div>");
        exit;
    }
    else
    {
	
        if($objUsr->validaNombreUsuario($usuario) == false) 
        {
            header ("Location: ../login.php?error_login=<div class='alert alert-danger small'>El usuario es incorrecto</div>");
            exit();//Salir
        }
        else
        {
            if($objUsr->validaPasswordUsuario($pwd,$objUsr->devIdUsrSes($usuario,$pwd)) == false)
            {
                header ("Location: ../login.php?error_login=<div class='alert alert-danger small'>La contraseña es incorrecta</div>");
				exit();//Salir
            }
            else
            {
                if ($objControl->validaEntrada($fechaActual,$idEmpleado) == null) 
                {
                    if ($objControl->agregaEntrada($idEmpleado, $fechaControl, $horaControl)) 
                    {
                        header("Location: ../index.php?error_login=<div class='alert alert-success'>ENTRADA <br> ".$horaControl."</div>");
                        exit;
                    }
                    else
                    {
                        header("Location: ../index.php?error_login=<div class='alert alert-danger'>ERROR INTENTA DE NUEVO</div>");
                        exit;
                    }
                }
                else
                {
                    if ($objControl->agregaSalida($idEmpleado, $fechaControl, $horaControl) != null) 
                    {
                        header("Location: ../index.php?error_login=<div class='alert alert-danger'>SALIDA <br> ".$horaControl."</div>");
                        exit;
                    }
                    else
                    {
                        header("Location: ../index.php?error_login=<div class='alert alert-danger'>ERROR INTENTA DE NUEVO</div>");
                        exit;
                    }
                } 
            }
        }
    }
}
?>
