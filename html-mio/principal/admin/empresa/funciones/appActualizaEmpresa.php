<?php 	
include "../../../../conexion/conexion.php";
require "../../../../clases/clsEmpresa.php";

//recibe datos empleado
$rfcEmpresa = $_POST["rfcNegoAdd"];
$idUsr = $_POST["idUsuario"];
$nombre_empresa = $_POST["nombreNego"];
$id_giro = $_POST["giro"];
$id_razon_social = $_POST["razonSocial"]; 
$id_tipo_empresa = $_POST["tipoEmpresa"];
$id_estado = $_POST["select1"];
$id_municipio = $_POST["select2"];
$id_localidad = $_POST["select3"];
$calle = $_POST["calle"];
$numero_exterior = $_POST["noEx"];
$numero_interior = $_POST["noIn"];
$codigo_postal = $_POST["cp"];
$telefono_fijo = $_POST["tf"];
$descripcion = $_POST["desc"];

function devIdEmpleado($id)
{
	$sql = mysql_query("SELECT id FROM tbl_empleado WHERE id_usuario = '$id'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}

//instanciar obj
$objEmpresa = new clsEmpresa();
if ($objEmpresa->actualizaEmpresa($rfcEmpresa, $nombre_empresa, $id_giro, $id_razon_social, $id_tipo_empresa, $id_estado, $id_municipio, $id_localidad,
		$calle, $numero_exterior, $numero_interior, $codigo_postal, $telefono_fijo, $descripcion, devIdEmpleado($idUsr)) == true) 
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-success'>Empresa actualizada con éxito</div>");
    exit;
}
else
{
	header("Location: ../agrega.php?error_login=<div class='alert alert-danger'>Algo ocurrio con los datos, intenta mas tarde</div>");
    exit;
}		
?>