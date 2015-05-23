<?php  
/**
* 
*/
class clsCorteCaja
{
	var $id;
	var $prodVendidos;
	var $corteInicio;
	var $corteFinal;
	var $fechaCorte;
	var $rfcEmpresa;
	var $status;

	function agregaCorteInicio($corIni, $rfcEmp)
	{
		$this->corteInicio = $corIni;
		$this->rfcEmpresa = $rfcEmp;
		$this->fechaCorte = date("Y-m-d");

		$sql = mysql_query("INSERT INTO tbl_corte 
			(productos_vendidos, corte_inicio, corte_final, fecha_corte, rfcEmpresa, id_status) 
			VALUES 
			('0','$this->corteInicio','0','$this->fechaCorte','$this->rfcEmpresa','3')")or die(mysql_error()."FALLA CORTE FINAL");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function agregaCorteInicioDiaSig($corIni, $rfcEmp, $feC)
	{
		$this->corteInicio = $corIni;
		$this->rfcEmpresa = $rfcEmp;
		$this->fechaCorte = $feC;

		$sql = mysql_query("INSERT INTO tbl_corte 
			(productos_vendidos, corte_inicio, corte_final, fecha_corte, rfcEmpresa, id_status) 
			VALUES 
			('0','$this->corteInicio','0','$this->fechaCorte','$this->rfcEmpresa','3')")or die(mysql_error()."FALLA CORTE FINAL");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function realizaCorte($id, $prodVend, $corFin, $fecha, $rfcEmp)
	{
		$this->id = $id;
		$this->prodVendidos = $prodVend;
		$this->corteFinal = $corFin;
		$this->fechaCorte = $fecha;
		$this->rfcEmpresa = $rfcEmp;

			$sql = mysql_query("UPDATE tbl_corte 
				SET productos_vendidos = '$this->prodVendidos', corte_final = '$this->corteFinal', fecha_corte = '$this->fechaCorte',
				id_status = '7'
				WHERE id_corte = '$this->id' AND rfcEmpresa = '$this->rfcEmpresa'")or die(mysql_error()."FALLA CORTE INICIO");

			if ($sql == true) 
			{
				return true;
			}
			else
			{
				return false;
			}
				
	}

	public function devCorteAbierto($fe, $rfcEmp)
	{
		$this->fechaCorte = $fe;
		$this->rfcEmpresa = $rfcEmp;

		$sql= mysql_query("SELECT fecha_corte FROM tbl_corte WHERE rfcEmpresa = '$this->rfcEmpresa'")or die(mysql_error()." No funciona consulta");
		while ($dts = mysql_fetch_row($sql)) 
		{
			if ($dts[0] == $this->fechaCorte) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}

?>