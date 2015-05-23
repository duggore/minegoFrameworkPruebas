<?php  
require "clsNota.php";
/**
* 
*/
class clsVenta
{
	var $id;
	var $idProd;
	var $cantidad;
	var $precio;
	var $idNota;
	var $idStatus;
	var $emp;
	var $fechaVenta;

	public function agregaProducto($idpro,$cant,$precio,$idNota, $status, $emp, $fv)
	{
		$this->idProd = $idpro;
		$this->cantidad = $cant;
		$this->precio = $precio;
		$this->idNota = $idNota;
		$this->idStatus = $status;
		$this->emp = $emp;
		$this->fechaVenta = $fv;

	
		if ($this->validaExistencia($this->idProd, $this->emp) > 0) 
		{
			$sql = mysql_query("INSERT INTO tbl_venta 
			(id_producto, cantidad, precio, id_nota, id_status, rfcEmpresa, fecha_venta) 
			VALUES 
			('$this->idProd','$this->cantidad','$this->precio','$this->idNota', '$this->idStatus', '$this->emp', '$this->fechaVenta')")or die(mysql_error()."FALLA VENTA");

			$sql2 = mysql_query("UPDATE tbl_producto SET existencia = existencia - '$this->cantidad' 
			WHERE id_producto = '$this->idProd' AND rfcEmpresa = '$this->emp'")or die(mysql_error()."FALLA QUITAR EXISTENCIA");

			if ($sql == true) 
			{
				if ($sql2 == true) 
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
			return false;
		}
	}

	public function cancelaProducto($id, $idProd,$cant)
	{
		$this->id = $id;
		$this->idProd = $idProd;
		$this->cantidad = $cant;

		$sql = mysql_query("UPDATE tbl_producto SET existencia = existencia + '$this->cantidad' 
		WHERE id_producto = '$this->idProd'")or die(mysql_error()."FALLA AGREGAR EXISTENCIA");

		$sql2 = mysql_query("DELETE FROM tbl_venta WHERE id_venta = '$this->id'")or die(mysql_error()."FALLA QUITAR VENTA");

		if ($sql == true) 
		{
			if ($sql2 == true) 
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

	public function validaExistencia($cod, $rfcEmp)
	{
		$this->idProd = $cod;
		$this->emp = $rfcEmp;

		$sql = mysql_query("SELECT existencia FROM tbl_producto WHERE id_producto = '$this->idProd' AND rfcEmpresa = '$this->emp'")or die(mysql_error()."FALLA PRECIO VTA");
		while ($dts = mysql_fetch_row($sql)) 
		{
			return $dts[0];
		}
	}
}
?>