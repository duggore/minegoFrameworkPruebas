<?php  
/**
* 
*/
class clsControlEmpleado
{
	var $idControl;
	var $fechaEntrada;
	var $horaEntrada;
	var $fechaSalida;
	var $horaSalida;
	var $idEmpleado;
	var $fechaActual;
	var $idUsuario;

	public function agregaEntrada($idEmp, $feEnt, $hoEnt)
	{
		$this->idEmpleado = $idEmp;
		$this->fechaEntrada = $feEnt;
		$this->horaEntrada = $hoEnt;

		$sql = mysql_query("INSERT INTO tbl_control_empleado 
		(fecha_entrada, hora_entrada, fecha_salida, hora_salida, id_empleado) 
		VALUES 
		('$this->fechaEntrada','$this->horaEntrada','0000-00-00','00:00:00','$this->idEmpleado')")or die(mysql_error()."FALLA ADD CONTROL");
		
		if ($sql == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function agregaSalida($idEmp, $feSa, $hoSa)
	{
		$this->idEmpleado = $idEmp;
		$this->fechaSalida = $feSa;
		$this->horaSalida = $hoSa;

		$sql = mysql_query("UPDATE tbl_control_empleado SET 
		fecha_salida = '$this->fechaSalida', hora_salida = '$this->horaSalida'
		WHERE id_empleado = '$this->idEmpleado' AND fecha_salida = '0000-00-00' AND hora_salida = '00:00:00'")or die(mysql_error()."FALLA UPDATE CONTROL");
		if ($sql == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function validaEntrada($feAct,$idEmp)
	{
		$this->fechaActual = $feAct;
		$this->idEmpleado = $idEmp;

		$sql = mysql_query("SELECT * FROM tbl_control_empleado WHERE 
		id_empleado = '$this->idEmpleado' AND fecha_entrada = '$this->fechaActual'")or die(mysql_error()."FALLA VALIDA ENT");

		while ($dts = mysql_fetch_row($sql))
		{
			return $dts[0];
		}
	}

	public function devIdEmpleado($idUsr)
	{
		$this->idUsuario = $idUsr;

		$sql = mysql_query("SELECT id FROM tbl_empleado WHERE id_usuario = '$this->idUsuario'")or die(mysql_error()."FALLA ID EMP");
		while ($dts = mysql_fetch_row($sql)) 
		{
			return $dts[0];
		}
	}
}
?>