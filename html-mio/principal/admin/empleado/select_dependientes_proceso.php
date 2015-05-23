<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"institucion"=>"tblplanes",
"empleado"=>"tblalumno"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(($opcionSeleccionada)) return true;
	else return false;
}

function devCarrera($idCar)
{
	$c = mysql_query("SELECT carrera FROM tblplanes WHERE id_carrera = '$idCar'") or die(mysql_error());
	while($d = mysql_fetch_row($c))
	{
		return $d[0];
	}
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include ("../../../conexion/conexion.php");
	$consulta=mysql_query("SELECT control, nombre, paterno, materno, id_carrera, semestre FROM $tabla WHERE id_carrera='$opcionSeleccionada'") or die(mysql_error());	
	// Comienzo a imprimir el select
	echo "<table name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)' class='table table-striped table-bordered'>";
	echo "<tr>
          <th colspan='2'>Opciones</th>
          <th>#</th>
          <th colspan='3'>Nombre</th>
          <th>Responsabilidad</th>
          <th>Telefono Movil</th>
        </tr>";
      $i = 1;
      $sql = mysql_query("SELECT * FROM tbl_empleado WHERE rfcEmpresa = '$rfcNego'")or die(mysql_error());
      while ($dts = mysql_fetch_row($sql)) 
      {
        echo "
          <tr>
            <td>
              <form action='funciones/appEliminaEmpleado.php' method='post'>
                <input type='text' name='idEmpleado' value='".$dts[0]."' hidden='true'>
                <button class='btn btn-danger'><img src='../../../img/icoBco/cancel_icon16.png'></button>
              </form>
            </td>";
        echo "<td>
            <form action='actualiza.php' method='post' class=''>
              <input type='text' name='idEmpleado' value='".$dts[0]."' hidden='true'>
              <button class='btn btn-primary'><img src='../../../img/icoBco/refresh_icon16.png'></button>
            </form>
          </td>";
        echo "
        <td>".$i."</td>";
        echo "<td>".$dts[1]."</td>";
        echo "<td>".$dts[2]."</td>";
        echo "<td>".$dts[3]."</td>";
        echo "<td>".devCat($dts[14])."</td>";
        echo "<td>".$dts[12]."</td>
        </tr>";
        $i++;
      }

      function devCat($id)
      {
        $sql = mysql_query("SELECT tipo FROM tbl_tipo_empleado WHERE id_tipo_empleado = '$id'")or die(mysql_error());
        while ($dts = mysql_fetch_row($sql)) 
        {
          return utf8_encode($dts[0]);
        }
      }
    ?>
}
?>