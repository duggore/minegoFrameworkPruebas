<?php 
include "../../../conexion/conexion.php";
include "../../../clases/clsControlEmpresa.php";
$objControl = new clsControlEmpresa();

session_start();
$usr = $_SESSION["usuario"];
$rol = $_SESSION["rol"];
$rfcNego = $_SESSION["rfcNego"];
$hoy = date("Y-m-d");

while ($rol != 'Administrador' OR $usr == "") 
{
  Header ("Location: ../../../login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../../img/icono.png">

    <title>Mi nego</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../../css/carousel.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="../../../img/logo.png" width="90px"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="../index.php">Inicio</a></li>
            <li><a href="#about">Acerca</a></li>
            <li><a href="#contact">Contacto</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href=""><img src="../../../img/icoBco/user_icon16.png"><?php echo " ".$usr; ?></a></li>
            <li><a href=""><img src="../../../img/icoBco/layers_1_icon16.png"><?php echo " ".$rol; ?></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="../../../img/icoBco/cog_icon16.png"> Opciones<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Empleados</li>
                <li><a href="#"><img src="../../../img/icoNgo/users_icon16.png"> Agregar Empleado</a></li>
                <li><a href="#"><img src="../../../img/icoNgo/contact_card_icon16.png"> Eliminar Empleado</a></li>
                <li><a href="#"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Empleado</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Empresa</li>
                <li><a href="#"><img src="../../../img/icoNgo/import_icon16.png"> Agregar Negocio</a></li>
                <li><a href="#"><img src="../../../img/icoNgo/app_window_cross16.png"> Eliminar Negocio</a></li>
                <li><a href="#"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Negocio</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Mi perfil</li>
                <li><a href="#"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar datos</a></li>
                <li><a href="#"><img src="../../../img/icoNgo/delete_server_icon16.png"> Desactivar cuenta</a></li>
                <li><a href="../../../login.php"><img src="../../../img/icoNgo/on-off_icon16.png"> Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <br>
    <br>
    <br>
    <div class="container">
      <div class="col-lg-12">
        <h1>Corte de Caja <small>Mi Nego</small></h1>      
      </div>
      <div class="col-lg-12">
        <div class="col-lg-6"> 
          <div class="col-lg-6">
            <h4 class="alert alert-warning">Prod Vendidos: </h4>
          </div>
          <div class="col-lg-6">
            <h4 class="alert alert-warning"><?php echo productosVendidosCant($hoy, $rfcNego);?></h4>
          </div>
          <div class="col-lg-6">
            <h4 class="alert alert-success">Total Ventas:</h4>
          </div>
          <div class="col-lg-6">
            <h4 class="alert alert-success"> $ <?php echo devTotalVentas($hoy, $rfcNego); ?></h4>
          </div>
          <div class="col-lg-6">
            <h4 class="alert alert-info">Caja Inicio: </h4>
          </div>
          <div class="col-lg-6">
            <h4 class="alert alert-info"> $ <?php echo devCorteInicio($rfcNego); ?></h4>
          </div>
        </div>
        <div class="col-lg-6">
          <br>
          <br>
          <br>
          <form action="funciones/appCorteCaja.php" method="post">
            <input type="number" name="cantidad" value="<?php echo productosVendidosCant($hoy, $rfcNego);?>" hidden>
            <input type="number" name="corteTermino" value="<?php echo devTotalVentas($hoy, $rfcNego) - devCorteInicio($rfcNego);?>" hidden>
            <input type="text" name="rfcEmpresa" value="<?php echo $rfcNego; ?>" hidden>
            <div align="center">
              <br>
              <button class="btn btn-success btn-lg" <?php echo devExisteCorteManana(); 
              if ($objControl->validaEstado($rfcNego) != 8){ echo "disabled"; } else { echo "enabled"; } ?> >Terminar Corte<br><?php echo date("d-m-Y"); ?></button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="col-lg-12">
          <?php //obteniendo la pagina
            if (isset($_REQUEST['error_login'])) { //si "si" tiene dato
              echo "<p></p>".$error_login= $_REQUEST['error_login']; 
            } else { //si no tiene dato
              $error_login = ""; //inicio en blanco del dato
            }

            function devExisteCorteManana()
            {
              $fc = date('Y-m-d', strtotime('+1 day'));
              $sql = mysql_query("SELECT corte_final FROM tbl_corte WHERE fecha_corte = '$fc'")or die(mysql_error()."  Falla");
              while ($dts = mysql_fetch_row($sql)) 
              {
                if($dts[0] == "" OR $dts[0] == NULL)
                {
                  return "enabled";
                }
                else
                {
                  return "disabled";
                }
              }
            }
          ?>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="panel panel-group panel-info form-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  <div class="panel-heading">Productos Vendidos hoy<img align="right" src=""></div>
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                <table class='table table-striped'>
                  <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th colspan='2'>Precio</th>
                  </tr>
                  <?php
                    $i = 1;
                    $sql = mysql_query("SELECT * FROM tbl_venta WHERE id_status = '7' AND fecha_venta = '$hoy'")or die(mysql_error()."FALLA LISTAS");
                    while ($dts = mysql_fetch_row($sql)) 
                    {
                      /*
                      echo "<tr>";
                        echo "<td align='center'>
                                <form action='' method='post'>
                                  <input type='number' name='idVenta' value='".$dts[0]."' hidden='true'>
                                  <button type='submit' class='btn btn-primary'><img src='../../../img/icoBco/refresh_icon16.png'></button>
                                </form>
                              </td>";
                        echo "<td align='center'>
                                <form action='funciones/appEliminaVenta.php' method='post'>
                                  <input type='number' name='idVenta' value='".$dts[0]."' hidden='true'>
                                  <button type='submit' class='btn btn-danger'><img src='../../../img/icoBco/cancel_icon16.png'></button>
                                </form>
                              </td>"; */
                        echo "<td>".$i."</td>";
                        echo "<td>".devNombreMarcaProd($dts[1])."</td>";
                        echo "<td><p align='center'>".$dts[2]."</p></td>";
                        echo "<td>$</td>";
                        echo "<td><p align='right'>".$dts[3]."</p></td>";
                      echo "</tr>";
                      $i++;
                    }

                    function devNombreMarcaProd($id)
                    {
                      $sql = mysql_query("SELECT nombre_producto, marca FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                      while ($dts = mysql_fetch_row($sql)) 
                      {
                        return strtoupper($dts[1])." - ".strtoupper($dts[0]);
                      }
                    }

                    function devTotalVentas($a, $b)
                    {
                      $precio = 0;
                      $sql = mysql_query("SELECT total_venta FROM tbl_nota WHERE id_status = '7' AND rfcEmpresa = '$b' AND fecha_venta = '$a'")or die(mysql_error());
                      while ($dts = mysql_fetch_row($sql)) 
                      {
                        $precio += $dts[0];
                      }
                      return $precio;
                    }

                    function productosVendidosCant($a,$b)
                    {
                      $cant = 0;
                      $sql = mysql_query("SELECT cantidad FROM tbl_venta WHERE id_status = '7' AND rfcEmpresa = '$b' AND fecha_venta = '$a'")or die(mysql_error());
                      while ($dts = mysql_fetch_row($sql)) 
                      {
                        $cant += $dts[0];
                      }
                      return $cant;
                    }

                    function devCorteInicio($rfcNego)
                    {
                      $valor = 0;
                      $sql = mysql_query("SELECT corte_inicio FROM tbl_corte WHERE rfcEmpresa = '$rfcNego' AND id_status = '3'")or die(mysql_error());
                      while ($dts = mysql_fetch_row($sql)) 
                      {
                        return $dts[0];
                      }
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="panel panel-group panel-info form-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                  <div class="panel-heading">Notas de productos vendidos<img align="right" src=""></div>
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
              <div class="panel-body">
                <table class='table table-striped'>
                  <tr>
                    <th>#</th>
                    <th>Total Venta</th>
                    <th>Pago Venta</th>
                    <th>Cambio Venta</th>
                    <th>Fecha Venta</th>
                  </tr>
                  <?php
                    $i = 1;
                    $sql = mysql_query("SELECT * FROM tbl_nota WHERE id_status = '7' AND fecha_venta = '$hoy'")or die(mysql_error()."FALLA LISTAS");
                    while ($dts = mysql_fetch_row($sql)) 
                    {
                      /*
                      echo "<tr>";
                        echo "<td align='center'>
                                <form action='' method='post'>
                                  <input type='number' name='idVenta' value='".$dts[0]."' hidden='true'>
                                  <button type='submit' class='btn btn-primary'><img src='../../../img/icoBco/refresh_icon16.png'></button>
                                </form>
                              </td>";
                        echo "<td align='center'>
                                <form action='funciones/appEliminaVenta.php' method='post'>
                                  <input type='number' name='idVenta' value='".$dts[0]."' hidden='true'>
                                  <button type='submit' class='btn btn-danger'><img src='../../../img/icoBco/cancel_icon16.png'></button>
                                </form>
                              </td>"; */
                        echo "<td>".$i."</td>";
                        echo "<td>$ ".$dts[1]."</td>";
                        echo "<td>$ ".$dts[3]."</td>";
                        echo "<td>$ ".$dts[4]."</td>";
                        echo "<td>".$dts[2]."</td>";
                      echo "</tr>";
                      $i++;
                    }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Ir arriba</a></p>
        <p>&copy; 2014 Mi nego, alamedida. &middot; <a href="#">Privacidad</a> &middot; <a href="#">Terminos</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../../js/jquery.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>