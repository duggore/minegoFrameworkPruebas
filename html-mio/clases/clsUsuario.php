<?php 

class clsUsuario
{
	//valores
	var $idUsr;
	var $nombre;
	var $pwd;
	var $nivel;
	var $correo;
	var $status;

	//agrega usuario
	public function agregaUsuario($usr, $pwd, $nv, $correo)
	{
		$this->nombre = $usr;
		$this->pwd = substr(md5($pwd),0,50);
		$this->nivel = $nv;
		$this->correo = $correo;
		$this->status = 2;

		$sql = mysql_query("INSERT INTO tbl_usuario 
		(nombre_usuario,password,nivel,correo_electronico) 
		VALUES 
		('$this->nombre','$this->pwd','$this->nivel','$this->correo')")or die(mysql_error()."FALLA DATOS USUARIO");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//agrega usuario
	public function actualizaUsuario($idUsr, $usr, $pwd, $nv, $correo)
	{
		$this->idUsr = $idUsr;
		$this->nombre = $usr;
		$this->pwd = substr(md5($pwd),0,50);
		$this->nivel = $nv;
		$this->correo = $correo;
		$this->status = 2;

		$sql = mysql_query("UPDATE tbl_usuario SET
		nombre_usuario = '$this->nombre',
		password = '$this->pwd',
		nivel = '$this->nivel',
		correo_electronico = '$this->correo',
		id_status = '$this->status'
		WHERE 
		id_usuario = '$this->idUsr'")or die(mysql_error()."FALLA DATOS USUARIO");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	#VALIDACION INICIO DE SESION
	//valida usuario
	public function validaNombreUsuario($nombre)
	{
		$this->nombre = $nombre;
		$con = mysql_query("SELECT nombre_usuario FROM tbl_usuario WHERE nombre_usuario = '$this->nombre'")or die(mysql_error()."FALLA NOMBRE USUARIO");
		while ($dts = mysql_fetch_row($con)) {
			if($dts[0] == $this->nombre)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	//valida contrase?a
	public function validaPasswordUsuario($password,$id)
	{
		$this->idUsr = $id;
		$this->pwd = substr(md5($password),0,50);

		$con = mysql_query("SELECT password FROM tbl_usuario WHERE id_usuario = '$this->idUsr'")or die(mysql_error()."FALLA PASSWORD");
		while ($dts = mysql_fetch_row($con)) {
			if($dts[0] == $this->pwd)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	//devolver nivel de usuario para acceso
	public function devIdRol($u,$p)
	{
		$this->nombre = $u;
		$this->password = substr(md5($p),0,50);
		$con = mysql_query("SELECT nivel FROM tbl_usuario WHERE nombre_usuario = '$this->nombre' AND password = '$this->password'")or die(mysql_error()."FALLA NIVEL USUARIO");
		while ($dts = mysql_fetch_row($con))  
		{
			return $dts[0];
		}
	}

	//eliminar usuario
	public function eliminaUsuario($id)
	{
		$this->idUsr = $id;

		$sql = mysql_query("DELETE FROM tbl_usuario WHERE id_usuario = '$this->idUsr'");
		if($sql == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//devuelve id usuario
	public function devIdUsrSes($u,$p)
	{
		$this->nombre = $u;
		$this->pwd = substr(md5($p),0,50);

		$con = mysql_query("SELECT id_usuario FROM tbl_usuario WHERE nombre_usuario = '$this->nombre' AND password = '$this->pwd'")or die(mysql_error());
		while ($dts = mysql_fetch_row($con))  
		{
			return $dts[0];
		}
	}

	//dev rfcEmpresa Usuario
	public function devRfcNego($id)
	{
		$this->idUsr = $id;

		$sql = mysql_query("SELECT rfcEmpresa FROM tbl_empleado WHERE id_usuario = '$this->idUsr'")or die(mysql_error()."FALLA RFC");
		while ($dts = mysql_fetch_row($sql)) 
		{
			return $dts[0];
		}
	}

	public function desactivaUsuario($usr, $sts)
	{
		$this->idUsr = $usr;
		$this->status = $sts;

		$sql = mysql_query("UPDATE tbl_usuario SET id_status = '$this->status' WHERE id_usuario = '$this->idUsr'")or die(mysql_error()."FALLA STATUS USR");
		
		if ($sql == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function activaUsuario($usr, $sts)
	{
		$this->idUsr = $usr;
		$this->status = $sts;

		$sql = mysql_query("UPDATE tbl_usuario SET id_status = '$this->status' WHERE id_usuario = '$this->idUsr'")or die(mysql_error()."FALLA STATUS USR");
		
		if ($sql == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function devStatus($id)
	{
		$sql = mysql_query("SELECT id_status FROM tbl_usuario WHERE id_usuario = '$id'")or die(mysql_error()."FALLA ID STATUS");
		while ($dts = mysql_fetch_row($sql)) 
		{
			return $dts[0];
		}
	}
}
?>