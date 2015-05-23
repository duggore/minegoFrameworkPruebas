<?php  
/**
* 
*/
class clsNota
{
	var $idVenta;
	var $totalVenta;
	var $fechaVenta;
	var $pagoVenta;
	var $cambioVenta;
	var $rfcEmpresa;
	var $idStatus;

	public function agregaNota($total, $fecha, $pago, $cambio, $rfc, $status)
	{
		$this->totalVenta = $total;
		$this->fechaVenta = $fecha;
		$this->pagoVenta = $pago;
		$this->cambioVenta = $cambio;
		$this->rfcEmpresa = $rfc;
		$this->idStatus = $status;

		$sql = mysql_query("INSERT INTO tbl_nota 
		(total_venta, fecha_venta, pago_venta, cambio_venta, rfcEmpresa, id_status) 
		VALUES
		('$this->totalVenta','$this->fechaVenta','$this->pagoVenta','$this->cambioVenta','$this->rfcEmpresa', '$this->idStatus')")or die(mysql_error()."FALLA NOTA");

		$sql2 = mysql_query("UPDATE tbl_venta SET id_status = '$this->idStatus'")or die(mysql_error()."FALLA TERMINA VENTA");

		if ($sql == true) 
		{
			if ($sql2) 
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

	public function eliminaNota($id)
	{
		$this->id = $id;

		$sql = mysql_query("DELETE FROM tbl_nota WHERE id_nota = '$this->id'")or die(mysql_error()."FALLA ELIMINA NOTA");
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