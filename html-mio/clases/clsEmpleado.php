<?php 	 
	
class clsEmpleado
{

	//valores
	var $id;
	var $nombre;
	var $paterno;
	var $materno;
	var $idEstado;
	var $idMpo;
	var $idLoc;
	var $calle;
	var $numExt;
	var $numInt;
	var $cp;
	var $telFijo;
	var $telMovil;
	var $correo;
	var $idTipoEmpleado;
	var $idStatus;
	var $idUsuario;
	var $rfcEmpresa;

	//agrega empleado default admin
	public function agregaEmpleado($nom, $pat, $mat, $idEdo, $idMpo, $idLoc, $calle, $ne, $ni, $cp, $tf, $tm, $mail, $idTpE, $st, $idUsr, $rfcEmpresa)
	{
		$this->nombre = $nom;
		$this->paterno = $pat;
		$this->materno = $mat;
		$this->idEstado = $idEdo;
		$this->idMpo = $idMpo;
		$this->idLoc = $idLoc;
		$this->calle = $calle;
		$this->numExt = $ne;
		$this->numInt = $ni;
		$this->cp = $cp;
		$this->telFijo = $tf;
		$this->telMovil = $tm;
		$this->correo = $mail;
		$this->idTipoEmpleado = $idTpE;
		$this->idStatus = $st;
		$this->idUsuario = $idUsr;
		$this->rfcEmpresa = $rfcEmpresa;

		$sql = mysql_query("INSERT INTO tbl_empleado 
			(nombre,
			 paterno,
			 materno,
			 id_estado,
			 id_municipio,
			 id_localidad,
			 calle,
			 numero_exterior,
			 numero_interior,
			 codigo_postal,
			 telefono_fijo,
			 telefono_movil,
			 correo_electronico,
			 id_tipo_empleado,
			 id_status,
			 id_usuario,
			 rfcEmpresa) 
			VALUES 
			('$this->nombre',
			 '$this->paterno',
			 '$this->materno',
			 '$this->idEstado',
			 '$this->idMpo',
			 '$this->idLoc',
			 '$this->calle',
			 '$this->numExt',
			 '$this->numInt',
			 '$this->cp',
			 '$this->telFijo',
			 '$this->telMovil',
			 '$this->correo',
			 '$this->idTipoEmpleado',
			 '$this->idStatus',
			 '$this->idUsuario',
			 '$this->rfcEmpresa')")or die(mysql_error()."FALLA EMPLEADO");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//actualiza empleado
	public function actualizaEmpleado($idEmp, $nom, $pat, $mat, $idEdo, $idMpo, $idLoc, $calle, $ne, $ni, $cp, $tf, $tm, $mail, $idTpE, $st, $idUsr, $rfcEmpresa)
	{
		$this->id = $idEmp;
		$this->nombre = $nom;
		$this->paterno = $pat;
		$this->materno = $mat;
		$this->idEstado = $idEdo;
		$this->idMpo = $idMpo;
		$this->idLoc = $idLoc;
		$this->calle = $calle;
		$this->numExt = $ne;
		$this->numInt = $ni;
		$this->cp = $cp;
		$this->telFijo = $tf;
		$this->telMovil = $tm;
		$this->correo = $mail;
		$this->idTipoEmpleado = $idTpE;
		$this->idStatus = $st;
		$this->idUsuario = $idUsr;
		$this->rfcEmpresa = $rfcEmpresa;

		$sql = mysql_query("UPDATE tbl_empleado SET
			nombre = '$this->nombre',
			paterno = '$this->paterno',
			materno = '$this->materno',
			id_estado = '$this->idEstado',
			id_municipio = '$this->idMpo',
			id_localidad = '$this->idLoc',
			calle = '$this->calle',
			numero_exterior = '$this->numExt',
			numero_interior = '$this->numInt',
			codigo_postal = '$this->cp',
			telefono_fijo = '$this->telFijo',
			telefono_movil = '$this->telMovil',
			correo_electronico = '$this->correo',
			id_tipo_empleado = '$this->idTipoEmpleado',
			id_status = '$this->idStatus',
			id_usuario = '$this->idUsuario',
			rfcEmpresa = '$this->rfcEmpresa'
			WHERE
			id = '$this->id'")or die(mysql_error()."FALLA EMPRESA");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//eliminar empleado
	public function eliminaEmpleado($idEmp)
	{
		$this->id = $idEmp;
		
		$sql = mysql_query("DELETE FROM tbl_empleado 
		WHERE id = '$this->id'")or die(mysql_error()."FALLA QUITAR EMPLEADO");
		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>