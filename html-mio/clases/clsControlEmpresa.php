<?php  
/**
* 
*/
class clsControlEmpresa
{
	#variables
	var $id_control;
	var $rfcEmpresa;
	var $fecha_registro;
	var $fecha_ultimo_pago;
	var $fecha_vencimiento;
	var $id_status;
	var $id_plan;
	var $tipo_pago;

	public function registraPago($rfc, $fr, $fv, $plan, $pago)
	{
		$this->rfcEmpresa = $rfc;
		$this->fecha_registro = $fr;
		$this->fecha_vencimiento = $fv;
		$this->id_plan = $plan;
		$this->tipo_pago = $pago;

		$sql = mysql_query("INSERT INTO tbl_control_pago 
			(rfcEmpresa, fecha_registro, fecha_ultimo_pago, fecha_vencimiento, id_status, id_plan, tipo_pago)
			VALUES
			('$this->rfcEmpresa','$this->fecha_registro', '0000-00-00', '$this->fecha_vencimiento','8','$this->id_plan','$this->tipo_pago')")or die(mysql_error()."Falla control");
		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function cambiaPlan($control, $fup, $fv, $plan, $pago, $st)
	{
		$this->id_control = $control;
		$this->fecha_ultimo_pago = $fup;
		$this->fecha_vencimiento = $fv;
		$this->id_plan = $plan;
		$this->tipo_pago = $pago;
		$this->id_status = $st;

		$sql = mysql_query("UPDATE tbl_control_pago SET 
			fecha_ultimo_pago = '$this->fecha_ultimo_pago', 
			fecha_vencimiento = '$this->fecha_vencimiento', 
			id_plan = '$this->id_plan', 
			tipo_pago = '$this->tipo_pago',
			id_status = '$this->id_status'
			WHERE id_control = '$this->id_control'")or die(mysql_error()." falla cambia plan");
		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function cambiaStatus($control, $st)
	{
		$this->id_control = $control;
		$this->id_status = $st;

		$sql = mysql_query("UPDATE tbl_control_pago SET 
			id_status = '$this->id_status'
			WHERE id_control = '$this->id_control'")or die(mysql_error()." falla cambia plan");
		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function validaEstado($rfc)
	{
		$this->rfcEmpresa = $rfc;

		$sql = mysql_query("SELECT id_status FROM tbl_control_pago WHERE rfcEmpresa = '$this->rfcEmpresa'")or die(mysql_error());
		while ($dts = mysql_fetch_row($sql))  
		{
			return $dts[0];
		}
	}
}
?>