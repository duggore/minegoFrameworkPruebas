<?php  
require "clsCorteCaja.php";
require "clsControlEmpresa.php";


class clsEmpresa
{
	//valores empleado
	var $rfcEmpresa;
	var $nombre;
	var $idGiro;
	var $idRazonSocial;
	var $idTipEmpresa;
	var $idEdo;
	var $idMpo;
	var $idLoc;
	var $calle;
	var $numExt;
	var $numInt;
	var $cp;
	var $telFijo;
	var $descripcion;

	var $idEmpleado;
	var $idPropietarioEmpresa;

	//agrega empresa default o matriz
	public function agregaEmpresaDefault($rfc, $nombre, $giro, $razon, $tipo, $desc)
	{
		//abre caja de inicio
		$objCaja = new clsCorteCaja();
		$objControl = new clsControlEmpresa();

		$this->rfcEmpresa = $rfc;
		$this->nombre = $nombre;
		$this->idGiro = $giro;
		$this->idRazonSocial = $razon;
		$this->idTipEmpresa = $tipo;
		$this->descripcion = $desc;

		$sql = mysql_query("INSERT INTO tbl_empresa 
		(rfcEmpresa, nombre_empresa, id_giro, id_razon_social,
		 id_tipo_empresa, id_estado, id_municipio, id_localidad,
		 calle, numero_exterior, numero_interior, codigo_postal,
		 telefono_fijo, descripcion)
		VALUES
		('$this->rfcEmpresa','$this->nombre',
		 '$this->idGiro','$this->idRazonSocial',
		 '$this->idTipEmpresa','1','1','1','1','1','1','1','1','$this->descripcion')")or die(mysql_error());

		if ($sql == true AND $objCaja->agregaCorteInicio(0, $this->rfcEmpresa) == true AND 
			$objControl->registraPago($this->rfcEmpresa, date("Y-m-d"), date("Y-m-d",strtotime("+30 day")), 7, 1) == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//agrega empresa sucursal
	public function agregaEmpresaSucursal($rfcEmpresa, $nombre_empresa, $id_giro, $id_razon_social, $id_tipo_empresa, $id_estado, $id_municipio, $id_localidad,
		$calle, $numero_exterior, $numero_interior, $codigo_postal, $telefono_fijo, $descripcion, $idEmp)
	{
		$this->rfcEmpresa = $rfcEmpresa;
		$this->nombre = $nombre_empresa;
		$this->idGiro = $id_giro;
		$this->idRazonSocial = $id_razon_social;
		$this->idTipEmpresa = $id_tipo_empresa;
		$this->idEdo = $id_estado;
		$this->idMpo = $id_municipio;
		$this->idLoc = $id_localidad;
		$this->calle = $calle;
		$this->numExt = $numero_exterior;
		$this->numInt = $numero_interior;
		$this->cp = $codigo_postal;
		$this->telFijo = $telefono_fijo;
		$this->descripcion = $descripcion;

		$this->idEmpleado = $idEmp;

		$sql = mysql_query("INSERT INTO tbl_empresa 
		(rfcEmpresa, nombre_empresa, id_giro, id_razon_social, id_tipo_empresa, id_estado, id_municipio, id_localidad,
		 calle, numero_exterior, numero_interior, codigo_postal, telefono_fijo, descripcion)
		VALUES
		('$this->rfcEmpresa','$this->nombre', '$this->idGiro','$this->idRazonSocial',
		 '$this->idTipEmpresa','$this->idEdo','$this->idMpo','$this->idLoc','$this->calle',
		 '$this->numExt','$this->numInt','$this->cp','$this->telFijo','$this->descripcion')")or die(mysql_error());

		if ($this->idTipEmpresa == 1) 
		{
			if ($sql == true) 
			{
				if ($this->defineNegoProp($this->idEmpleado, $rfcEmpresa) == true) 
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
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

	//actualiza empresa
	public function actualizaEmpresa($rfcEmpresa, $nombre_empresa, $id_giro, $id_razon_social, $id_tipo_empresa, $id_estado, $id_municipio, $id_localidad,
		$calle, $numero_exterior, $numero_interior, $codigo_postal, $telefono_fijo, $descripcion, $idEmp)
	{
		$this->rfcEmpresa = $rfcEmpresa;
		$this->nombre = $nombre_empresa;
		$this->idGiro = $id_giro;
		$this->idRazonSocial = $id_razon_social;
		$this->idTipEmpresa = $id_tipo_empresa;
		$this->idEdo = $id_estado;
		$this->idMpo = $id_municipio;
		$this->idLoc = $id_localidad;
		$this->calle = $calle;
		$this->numExt = $numero_exterior;
		$this->numInt = $numero_interior;
		$this->cp = $codigo_postal;
		$this->telFijo = $telefono_fijo;
		$this->descripcion = $descripcion;

		$sql = mysql_query("UPDATE tbl_empresa SET
		nombre_empresa = '$this->nombre', 
		id_giro = '$this->idGiro',
		id_razon_social = '$this->idRazonSocial',
		id_tipo_empresa = '$this->idTipEmpresa',
		id_estado = '$this->idEdo',
		id_municipio = '$this->idMpo',
		id_localidad = '$this->idLoc',
		calle = '$this->calle',
		numero_exterior = '$this->numExt',
		numero_interior = '$this->numInt',
		codigo_postal = '$this->cp',
		telefono_fijo = '$this->telFijo', 
		descripcion = '$this->descripcion'
		WHERE		 
		rfcEmpresa = '$this->rfcEmpresa'")or die(mysql_error());

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//elimina empresa
	public function eliminaEmpesa($rfcEmpr)
	{
		$this->rfcEmpresa = $rfcEmpr;

		$sql = mysql_query("DELETE FROM tbl_empresa WHERE rfcEmpresa = '$this->rfcEmpresa'")or die(mysql_error()."FALLA QUITAR EMPRESA");
		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function defineNegoProp($idEmp, $rfcEmpresa)
	{
		$this->idEmpleado = $idEmp; 
		$this->rfcEmpresa = $rfcEmpresa;

		$sql = mysql_query("INSERT INTO tbl_propietario_empresa 
		(id, rfcEmpresa) 
		VALUES 
		('$this->idEmpleado', '$this->rfcEmpresa')")or die(mysql_error()."FALLA ADD DUEÑO EMPRESA");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function actualizaNegoProp($id, $idEmp, $rfcEmpresa)
	{
		$this->idEmpleado = $idEmp; 
		$this->rfcEmpresa = $rfcEmpresa;

		$sql = mysql_query("UPDATE tbl_propietario_empresa SET
		id = '$this->idEmpleado', rfcEmpresa = '$this->rfcEmpresa' WHERE id_propietario_empresa = '$id'")or die(mysql_error()."FALLA UPDATE DUEÑO EMPRESA");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function devIdNegoProp($idEmp, $rfcEmpresa)
	{
		$this->idEmpleado = $idEmp; 
		$this->rfcEmpresa = $rfcEmpresa;

		$sql = mysql_query("SELECT id_propietario_empresa FROM tbl_propietario_empresa 
		WHERE id = '$this->idEmpleado' AND rfcEmpresa = '$this->rfcEmpresa'")or die(mysql_error()."FALLA SELECT DUEÑO EMPRESA");

		while ($dts = mysql_fetch_row($sql))
		{
			return $dts[0];
		}
	}
}
?>