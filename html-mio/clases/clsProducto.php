<?php  

/**
* 
*/
class clsProducto
{
	#variables
	var $id;
	var $codigo;
	var $nombre;
	var $marca;
	var $idCategoria;
	var $desc;
	var $pzasCaja;
	var $pesoPza;
	var $exist;
	var $precioProv;
	var $precioVta;
	var $precioMayo;
	var $descuento;
	var $fechaEnt;
	var $rfcEmpresa;

	#agregar producto
	public function agregaProducto($cod, $nom, $marca, $idCat, $desc, $pza, $pso, $exs, $pProv, $pVta, $pMayo, $dto, $fe, $rfcEmp)
	{
		$this->codigo = $cod;
		$this->nombre = $nom;
		$this->marca = $marca;
		$this->idCategoria = $idCat; 
		$this->pzasCaja = $pza;
		$this->pesoPza = $pso;
		$this->exist = $exs;
		$this->desc = $desc;
		$this->precioProv = $pProv;
		$this->precioVta = $pVta;
		$this->precioMayo = $pMayo;		
		$this->descuento = $dto;
		$this->fechaEnt = $fe;
		$this->rfcEmpresa = $rfcEmp;

		$sql = mysql_query("INSERT INTO tbl_producto 
		(codigo_producto, nombre_producto, marca, id_categoria, descripcion, piezas_caja, peso_pieza, existencia,
		 precio_proveedor, precio_venta, precio_mayoreo, descuento, fecha_entrada, rfcEmpresa) 
		VALUES 
		('$this->codigo', '$this->nombre', '$this->marca', '$this->idCategoria','$this->desc', '$this->pzasCaja', '$this->pesoPza', '$this->exist',
		 '$this->precioProv', '$this->precioVta', '$this->precioMayo', '$this->descuento',
		 '$this->fechaEnt', '$this->rfcEmpresa')")or die(mysql_error()."FALLA AGREGAR PRODUCTO");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	#actualizar productos
	public function actualizaProducto($idP, $cod, $nom, $marca, $idCat, $desc, $pza, $pso, $exs, $pProv, $pVta, $pMayo, $dto, $fe, $rfcEmp)
	{
		$this->id = $idP;
		$this->codigo = $cod;
		$this->nombre = $nom;
		$this->marca = $marca;
		$this->idCategoria = $idCat; 
		$this->pzasCaja = $pza;
		$this->pesoPza = $pso;
		$this->exist = $exs;
		$this->desc = $desc;
		$this->precioProv = $pProv;
		$this->precioVta = $pVta;
		$this->precioMayo = $pMayo;		
		$this->descuento = $dto;
		$this->fechaEnt = $fe;
		$this->rfcEmpresa = $rfcEmp;

		$sql = mysql_query("UPDATE tbl_producto  SET 
		codigo_producto = '$this->codigo', 
		nombre_producto = '$this->nombre',  
		marca = '$this->marca',
		id_categoria = '$this->idCategoria', 
		descripcion = '$this->desc', 
		piezas_caja = '$this->pzasCaja', 
		peso_pieza = '$this->pesoPza', 
		existencia  = '$this->exist',
		precio_proveedor = '$this->precioProv', 
		precio_venta  = '$this->precioVta', 
		precio_mayoreo  = '$this->precioMayo',
		descuento = '$this->descuento', 
		fecha_entrada ='$this->fechaEnt'    
		WHERE 
		id_producto = '$this->id' AND rfcEmpresa = '$this->rfcEmpresa'")or die(mysql_error()."FALLA ACTUALIZAR PRODUCTO");

		if ($sql == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	#eliminar producto
	public function eliminaProducto($id)
	{
		$this->id = $id;

		$sql = mysql_query("DELETE FROM tbl_producto 
		WHERE id_producto = '$this->id'")or die(mysql_error()."FALLA ELIMINA PRODUCTO");
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