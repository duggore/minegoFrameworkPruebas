<?php 
include "../../conexion/conexion.php";
include "../../clases/clsControlEmpresa.php";
$objControl = new clsControlEmpresa();

session_start();
$usr = $_SESSION["usuario"];
$rol = $_SESSION["rol"];
$rfcNego = $_SESSION["rfcNego"];

$idProd = $_POST["idProd"];

while ($rol != 'Inventario' OR $usr == "") 
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
            <li class="active"><a href="index.php">Inicio</a></li>
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
                <li><a href="../empleado/index.php"><img src="../../../img/icoNgo/users_icon16.png"> Agregar Empleado</a></li>
                <li><a href="../empleado/index.php"><img src="../../../img/icoNgo/contact_card_icon16.png"> Eliminar Empleado</a></li>
                <li><a href="../empleado/index.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Empleado</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Empresa</li>
                <li><a href="../empresa/index.php"><img src="../../../img/icoNgo/import_icon16.png"> Agregar Negocio</a></li>
                <li><a href="../empresa/index.php"><img src="../../../img/icoNgo/app_window_cross16.png"> Eliminar Negocio</a></li>
                <li><a href="../empresa/index.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Negocio</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Mi perfil</li>
                <li><a href="../cuenta/index.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar datos</a></li>
                <li><a href="../cuenta/index.php"><img src="../../../img/icoNgo/delete_server_icon16.png"> Desactivar cuenta</a></li>
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
      <div class="co-lg-12">
        <h1>Inventario <small>Mi nego</small></h1>
      </div>
      <div class="col-lg-12">
        <div class="panel panel-group panel-info form-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  <div class="panel-heading">Actualizar Producto<img align="right" src=""></div>
                </a>
              </h4>
              <a class="btn btn-default" align="right" href="rptInventario/rptInventario.php" 
                <?php if ($objControl->validaEstado($rfcNego) != 8){ echo "disabled"; } else { echo "enabled"; } ?>
              >
                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Imprime Reporte
              </a>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                <form action="funciones/appActualizaProducto.php" method="post">
                  <div class="col-lg-3">
                    <label>Código de Producto:</label>
                    <input type="number" value="<?php echo $idProd;?>" name="idProd" hidden>
                    <input type="text" class="form-control" placeholder="Código de producto" value="<?php echo devCodigoProducto($idProd); ?>" required name="codigoProducto">
                  </div>
                  <div class="col-lg-3">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" placeholder="Nombre del producto" value="<?php echo devNombreProducto($idProd); ?>" required name="nombreProducto">
                  </div>
                  <div class="col-lg-3">
                    <label>Marca:</label>
                    <input type="text" class="form-control" placeholder="Marca del producto" value="<?php echo devMarcaProducto($idProd); ?>" required name="marca">
                  </div>
                  <div class="col-lg-3">
                    <label>Categoria:</label>
                    <select name="categoria" class="form-control">
                      <?php
                        $sql = mysql_query("SELECT * FROM tbl_categoria_producto")or die(mysql_error()); 
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          echo "<option value='".$dts[0]."'>".$dts[1]."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label>Pieza x Caja:</label>
                    <input type="number" class="form-control" min="0" placeholder="Caja o Paquetes" value="<?php echo devPiezasCaja($idProd); ?>" required name="piezasCaja">
                  </div>
                  <div class="col-lg-3">
                    <label>Peso x Caja:</label>
                    <input type="number" class="form-control" step="0.01" min="0" placeholder="Peso Kg" value="<?php echo devPesoProducto($idProd); ?>" required name="pesoPieza">
                  </div>
                  <div class="col-lg-3">
                    <label>Existencia Producto:</label>
                    <div class="input-group">
                      <span class="input-group-addon">#</span>
                      <input type="number" class="form-control" required min="0" placeholder="Existencia" value="<?php echo devExistenciaProducto($idProd); ?>" required name="exist"> 
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label>Precio Proveedor:</label>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" class="form-control" required step="0.01" min="0" placeholder="Precio" value="<?php echo devPrecioProveedor($idProd); ?>" required name="prepro"> 
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label>Precio Venta:</label>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" class="form-control" required step="0.01" min="0" placeholder="Precio" value="<?php echo devPrecioVenta($idProd); ?>" required name="prevta">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label>Precio Mayoreo:</label>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" class="form-control" step="0.01" min="0" placeholder="Precio" value="<?php echo devPrecioMayoreo($idProd); ?>" required name="premay">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label>Descuento:</label>
                    <div class="input-group">
                      <input type="number" class="form-control" required step="0.01" min="0" value="<?php echo devDescuentoProducto($idProd); ?>" placeholder="Descuento" name="descuento">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label>Fecha entrada:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><img src="../../../img/icoNgo/calendar_1_icon16.png"></span>
                      <input type="date" class="form-control"  required name="fechaEnt">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <label>Empresa o Sucursal:</label>
                    <select class="form-control" name="rfc">
                      <?php
                        $c = mysql_query("SELECT rfcEmpresa, nombre_empresa FROM tbl_empresa WHERE rfcEmpresa = '$rfcNego'")or die(mysql_error());
                        while ($d = mysql_fetch_row($c))
                        {
                          echo "<option value='".$d[0]."'>".$d[1]."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-12">
                    <label>Descripción:</label>
                    <textarea class="form-control" name="descripcion" value="<?php echo devDescripcionProducto($idProd); ?>"></textarea>
                  </div>
                  <div class="col-lg-12">
                    <br>
                  </div>
                  <div class="col-lg-12" align="center">
                    <div class="col-lg-6">
                      <a href="agrega.php" class="btn btn-primary">Limpiar Campos</a>
                    </div>
                    <div class="col-lg-6">
                      <button class="btn btn-success" action="sumit">Actualizar producto</button>
                    </div>
                    <div class="col-lg-12">
                      <?php //obteniendo la pagina
                        if (isset($_REQUEST['error_login'])) { //si "si" tiene dato
                          echo "<p></p>".$error_login= $_REQUEST['error_login']; 
                        } else { //si no tiene dato
                          $error_login = ""; //inicio en blanco del dato
                        }
                      ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="panel panel-group panel-info form-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                  <div class="panel-heading">Agregar Producto<img align="right" src=""></div>
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
              <div class="panel-body">
                <div class="col-md-12 table-responsive" style="overflow : auto;">
                  <table class="table table-striped">
                    <tr>
                      <th>#</th>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Marca</th>
                      <th>Categoria</th>
                      <th>Pza</th>
                      <th>Peso/pza</th>
                      <th>Existencia</th>
                      <th>Precio Prov</th>
                      <th>Precio Venta</th>
                      <th>Precio Mayor</th>
                      <th>Desc</th>
                      <th>Fecha Entrada</th>
                      <th>Descripción</th>
                    </tr>
                    
                    <?php
                      $i = 1;
                      $sql = mysql_query("SELECT * FROM tbl_producto WHERE rfcEmpresa = '$rfcNego'")or die(mysql_error());
                      while ($dts = mysql_fetch_row($sql)) 
                      {
                        echo "
                        <td>".$i."</td>";
                        echo "<td>".$dts[1]."</td>";
                        echo "<td>".$dts[2]."</td>";
                        echo "<td>".$dts[3]."</td>";
                        echo "<td>".devCat($dts[4])."</td>";
                        echo "<td>".$dts[6]."</td>";
                        echo "<td>".$dts[7]."</td>";
                        echo "<td>".$dts[8]."</td>";
                        echo "<td>$ ".$dts[9]."</td>";
                        echo "<td>$ ".$dts[10]."</td>";
                        echo "<td>$ ".$dts[11]."</td>";
                        echo "<td>".$dts[12]." %</td>";
                        echo "<td>".date("d/m/Y",strtotime($dts[13]))."</td>";
                        echo "<td>".$dts[5]."</td>
                        </tr>";
                        $i++;
                      }

                      function devCat($id)
                      {
                        $sql = mysql_query("SELECT categoria FROM tbl_categoria_producto WHERE id_categoria = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devCodigoProducto($id)
                      {
                        $sql = mysql_query("SELECT codigo_producto FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devNombreProducto($id)
                      {
                        $sql = mysql_query("SELECT nombre_producto FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devMarcaProducto($id)
                      {
                        $sql = mysql_query("SELECT marca FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devDescripcionProducto($id)
                      {
                        $sql = mysql_query("SELECT descripcion FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devPiezasCaja($id)
                      {
                        $sql = mysql_query("SELECT piezas_caja FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devPesoProducto($id)
                      {
                        $sql = mysql_query("SELECT peso_pieza FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devExistenciaProducto($id)
                      {
                        $sql = mysql_query("SELECT existencia FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devPrecioProveedor($id)
                      {
                        $sql = mysql_query("SELECT precio_proveedor FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devPrecioVenta($id)
                      {
                        $sql = mysql_query("SELECT precio_venta FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devPrecioMayoreo($id)
                      {
                        $sql = mysql_query("SELECT precio_mayoreo FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return $dts[0];
                        }
                      }

                      function devDescuentoProducto($id)
                      {
                        $sql = mysql_query("SELECT descuento FROM tbl_producto WHERE id_producto = '$id'")or die(mysql_error());
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
