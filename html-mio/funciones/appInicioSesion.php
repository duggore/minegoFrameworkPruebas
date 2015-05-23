<?php
session_start();
require "../conexion/conexion.php";
require "../clases/clsUsuario.php";
require "../clases/clsControlEmpresa.php";

//recibe valores de login
$usuario = $_POST['usuario'];
$pwd = $_POST['password'];
$error_login=isset($_POST['error_login']) ? $_POST['error_login'] : NULL;


//creamos objeto usuario
$objUsr = new clsUsuario();
$objControl = new clsControlEmpresa();

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
                if ($objControl->validaEstado($objUsr->devRfcNego($objUsr->devIdUsrSes($usuario,$pwd))) == 14)
                {
                    header ("Location: ../login.php?error_login=<div class='alert alert-danger small'>Tu cuenta ha sido desactivada, contacta al proveedor</div>");
                    exit();
                }
                else
                {
                    if($objUsr->devIdRol($usuario,$pwd) == 1)
                    {
                        $_SESSION["usuario"] = $usuario;
                        $_SESSION["rol"] = "Administrador";
                        $_SESSION["rfcNego"] = $objUsr->devRfcNego($objUsr->devIdUsrSes($usuario,$pwd));
                        $_SESSION['idUsuario'] = $objUsr->devIdUsrSes($usuario,$pwd);
                        header ("Location: ../principal/redirecciona.php");
                        exit();
                    }
                    if($objUsr->devIdRol($usuario,$pwd) == 2)
                    {
                        $_SESSION["usuario"] = $usuario;
                        $_SESSION["rol"] = "Inventario";
                        $_SESSION["rfcNego"] = $objUsr->devRfcNego($objUsr->devIdUsrSes($usuario,$pwd));
                        $_SESSION['idUsuario'] = $objUsr->devIdUsrSes($usuario,$pwd);
                        header ("Location: ../principal/redirecciona.php");
                        exit();
                    }
                    if($objUsr->devIdRol($usuario,$pwd) == 3)
                    {
                        $_SESSION["usuario"] = $usuario;
                        $_SESSION["rol"] = "Caja";
                        $_SESSION["rfcNego"] = $objUsr->devRfcNego($objUsr->devIdUsrSes($usuario,$pwd));
                        $_SESSION['idUsuario'] = $objUsr->devIdUsrSes($usuario,$pwd);
                        header ("Location: ../principal/redirecciona.php");
                        exit();
                    }
                    if($objUsr->devIdRol($usuario,$pwd) == 4)
                    {
                        $_SESSION["usuario"] = $usuario;
                        $_SESSION["rol"] = "Admin";
                        $_SESSION["rfcNego"] = $objUsr->devRfcNego($objUsr->devIdUsrSes($usuario,$pwd));
                        $_SESSION['idUsuario'] = $objUsr->devIdUsrSes($usuario,$pwd);
                        header ("Location: ../principal/redirecciona.php");
                        exit();
                    }   
                }
            }
        }
    }
}
?>
