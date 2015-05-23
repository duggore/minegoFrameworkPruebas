<?php  
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=Inventario_General.xls");
header("Pragma: no-cache");header("Expires: 0");

//iniciamos session
include "../../../../conexion/conexion.php";

session_start();
$usr = $_SESSION["usuario"];
$rol = $_SESSION["rol"];
$rfcNego = $_SESSION["rfcNego"];

while ($rol != 'Administrador' OR $usr == "") 
{
  Header ("Location: ../../../login.php");
  exit;
}
$fechaActual = date("Y-m-d");
?>
<table>
    <tr>
        <th colspan="14"><h1>TABLA DE INVENTARIO <?php echo $fechaActual; ?></h1></th>
    </tr>
    <tr>
        <th>#</th>
        <th>Codigo Producto</th>
        <th>Nombre Producto</th>
        <th>Marca Producto</th>
        <th>Categoria Producto</th>
        <th>Descripcion Producto</th>
        <th>Piezas Caja</th>
        <th>Peso Pieza</th>
        <th>Existentcia</th>
        <th>Precio Compra</th>
        <th>Precio Venta</th>
        <th>Precio Mayoreo</th>
        <th>% Descuento</th>
        <th>Fecha Entrada</th>
    </tr>                                 
    <?php

        $c = 1;
        $sql = mysql_query("SELECT * FROM tbl_producto WHERE rfcEmpresa = '$rfcNego'")or die(mysql_error());
        while ($dts = mysql_fetch_row($sql)) 
        {
           echo "        
                <tr class='odd gradeX'>
                    <td>".$c."</td> 
                    <td>".$dts[1]."</td> 
                    <td>".$dts[2]."</td> 
                    <td>".$dts[3]."</td>
                    <td>".devCat($dts[4])."</td>
                    <td>".$dts[6]."</td> 
                    <td>".$dts[7]."</td>
                    <td>".$dts[8]."</td>
                    <td>$ ".$dts[9]."</td>
                    <td>$ ".$dts[10]."</td> 
                    <td>$ ".$dts[11]."</td>
                    <td>".$dts[12]." %</td>
                    <td>".$dts[13]."</td>
                    <td>".date("d/m/Y",strtotime($dts[5]))."</td>
                </tr>";
            $c++;
        }
        function devCat($id)
        {
          $sql = mysql_query("SELECT categoria FROM tbl_categoria_producto WHERE id_categoria = '$id'")or die(mysql_error());
          while ($dts = mysql_fetch_row($sql)) 
          {
            return $dts[0];
          }
        }
    ?>
</table>