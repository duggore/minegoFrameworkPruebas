<?php 
include "../../../conexion/conexion.php";

session_start();
$usr = $_SESSION["usuario"];
$rol = $_SESSION["rol"];
$rfcNego = $_SESSION["rfcNego"];
$idUsr = $_SESSION['idUsuario'];

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
                <li><a href="agrega.php"><img src="../../../img/icoNgo/import_icon16.png"> Agregar Negocio</a></li>
                <li><a href="elimina.php"><img src="../../../img/icoNgo/app_window_cross16.png"> Eliminar Negocio</a></li>
                <li><a href="actualiza.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Negocio</a></li>
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
        <h1>Empresas y sucursales <small>Mi nego</small></h1>
      </div>
      <div class="col-lg-12">
        <?php //obteniendo la pagina
          if (isset($_REQUEST['error_login'])) { //si "si" tiene dato
            echo "<p></p>".$error_login= $_REQUEST['error_login']; 
          } else { //si no tiene dato
            $error_login = ""; //inicio en blanco del dato
          }?>
      </div>
      <form action="funciones/appAgregaEmpresa.php" method="post">
        <div class="col-md-12">
          <div class="panel panel-group panel-info form-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <div class="panel-heading">Datos Empresa<img align="right" src=""></div>
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  <div class="col-lg-4">
                    <label>RFC Negocio:</label>
                    <input type="text" class="form-control" name="rfcNegoAdd" placeholder="RFC Empresa" required>
                    <input type="number" name="idUsuario" value="<?php echo $idUsr; ?>" hidden>
                  </div>
                  <div class="col-lg-8">
                    <label>Nombre Nego Nuevo o Sucursal:</label>
                    <input type="text" class="form-control" name="nombreNego" placeholder="Nombre de la nueva sucursal o negocio a Cargo" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Razon Social:</label>
                    <?php 
                        include ("../../../conexion/conexion.php");
                        $consulta=mysql_query("SELECT id_razon_social, razon_social FROM tbl_razon_social");
                        // Voy imprimiendo el primer select compuesto por los paises
                        echo "<select name='razonSocial' class='form-control' required>";
                        while($registro=mysql_fetch_row($consulta))
                        {
                            echo "<option value='".$registro[0]."'>". utf8_encode(strtoupper($registro[1]))."</option>";
                        }
                        echo "</select>";
                    ?>
                  </div>
                  <div class="col-lg-4">
                    <label>Giro del negocio:</label>
                    <?php 
                        $consulta=mysql_query("SELECT id_giro, giro FROM tbl_giro");
                        // Voy imprimiendo el primer select compuesto por los paises
                        echo "<select name='giro' class='form-control' required>";
                        while($registro=mysql_fetch_row($consulta))
                        {
                            echo "<option value='".$registro[0]."'>". utf8_encode(strtoupper($registro[1]))."</option>";
                        }
                        echo "</select>";
                    ?>
                  </div>
                  <div class="col-lg-4">
                    <label>Tipo Negocio:</label>
                    <?php 
                        $consulta=mysql_query("SELECT id_tipo_empresa, tipo FROM tbl_tipo_empresa");
                        // Voy imprimiendo el primer select compuesto por los paises
                        echo "<select name='tipoEmpresa' class='form-control' required>";
                        echo "<option>NINGUNO</option>";
                        while($registro=mysql_fetch_row($consulta))
                        {
                            echo "<option value='".$registro[0]."'>". utf8_encode(strtoupper($registro[1]))."</option>";
                        }
                        echo "</select>";
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-group panel-info form-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    <div class="panel-heading">Dirección Empresa<img align="right" src=""></div>
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                  <div class="col-xs-4"> 
                      <label>Estado</label>
                      <?php 
                        $consulta=mysql_query("SELECT id, nombre FROM tbl_estados");
                        // Voy imprimiendo el primer select compuesto por los paises
                        echo "<select name='select1' id='select1' onChange='cargaContenido(this.id);' class='form-control' required>";
                        echo "<option value='0'>--</option>";
                        while($registro=mysql_fetch_row($consulta))
                        {
                            echo "<option value='".$registro[0]."'>". utf8_encode(strtoupper($registro[1]))."</option>";
                        }
                        echo "</select>";
                      ?>
                  </div>
                  <div class="col-xs-4"> 
                    <label>Municipio</label>
                    <div> 
                      <select disabled='disabled' name='select2' id='select2' class='form-control' onkeyup="esVacioMunicipio();" onchange="esVacioMunicipio();" onclick="esVacioMunicipio();" required>
                        <option value='0'>--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-4"> 
                    <label>Localidad</label>
                    <div> 
                      <select disabled='disabled' name='select3' id='select3' class='form-control' onkeyup="esVacioLocalidades();" onchange="esVacioLocalidades();" onclick="esVacioLocalidades();" required>
                        <option value='0'>--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <label>Calle:</label>
                    <input type="text" class="form-control" placeholder="Calle, Avenida, Carretera..." name="calle" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Numero Exterior:</label>
                    <input type="number" class="form-control" placeholder="Numero exterior" min="1" name="noEx" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Numero Interior:</label>
                    <input type="number" class="form-control" placeholder="Numero interior" min="0" name="noIn" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Codigo Postal:</label>
                    <input type="number" class="form-control" placeholder="Codigo Postal" name="cp" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Telefono Fijo:</label>
                    <input type="tel" class="form-control" placeholder="10 Digitos" name="tf" required>
                  </div>
                  <div class="col-lg-12">
                    <label>Descripción:</label>
                    <textarea class="form-control" name="desc" required></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-group panel-success">
            <div class="panel-heading">Para finalizar <img align="right" src="">
            </div>
              <div class="panel-body" align="center">
                <div class="col-md-6" >
                  <a class="btn btn-danger btn-lg" href="agrega.php">Cancelar</a>
                  <br>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-success btn-lg" type="submit" name="Submit">Registrar</button>
                  <br>
                </div>
              </div>
          </div>
        </div>
      </form>

      <div class="col-lg-12">
        <div class="panel panel-group panel-info form-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                  <div class="panel-heading">Lista de Sucursales<img align="right" src=""></div>
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
              <div class="panel-body">
                <div class="col-md-12 table-responsive" style="overflow : auto;">
                  <table class="table table-striped">
                    <tr>
                      <th colspan="2">Opciones</th>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Tipo Negocio</th>
                      <th colspan="7">Dirección</th>
                      <th>Telefono</th>
                      <th>Giro del negocio</th>
                      <th>Descripción</th>
                    </tr>
                    
                    <?php
                      $i = 1;
                      $idEmp = devIdEmpleado($idUsr);
                      $sql1 = mysql_query("SELECT rfcEmpresa FROM tbl_propietario_empresa WHERE id = '$idEmp'")or die(mysql_error());
                      while ($a = mysql_fetch_row($sql1)) 
                      {
                        $sql = mysql_query("SELECT * FROM tbl_empresa WHERE rfcEmpresa like '%$a[0]%'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          echo "
                            <tr>
                              <td>
                                <form action='funciones/appEliminaEpresa.php' method='post'>
                                  <input type='text' name='rfcEmpresa' value='".$dts[0]."' hidden='true'>
                                  <button class='btn btn-danger'><img src='../../../img/icoBco/cancel_icon16.png'></button>
                                </form>
                              </td>";
                          echo "<td>
                              <form action='actualiza.php' method='post' class=''>
                                <input type='text' name='rfcEmpresa' value='".$dts[0]."' hidden='true'>
                                <button class='btn btn-primary'><img src='../../../img/icoBco/refresh_icon16.png'></button>
                              </form>
                            </td>";
                          echo "
                          <td>".$i."</td>";
                          echo "<td>".$dts[1]." ".devRazonSocial($dts[3])."</td>";

                          echo "<td>".devTipoEmpresa($dts[4])."</td>";

                          echo "<td>EDO ".devEdo($dts[5])."</td>";
                          echo "<td>MUN ".devMun($dts[6])."</td>";
                          echo "<td>COL ".devLoc($dts[7])."</td>";
                          echo "<td>CALLE ".$dts[8]."</td>";
                          echo "<td>No. ".$dts[9]."</td>";
                          echo "<td>Int. ".$dts[10]."</td>";
                          echo "<td>CP ".$dts[11]."</td>";
                          echo "<td>".$dts[12]."</td>";

                          echo "<td>".devGiro($dts[2])."</td>";

                          echo "<td>".$dts[13]."</td>
                          </tr>";
                          $i++;
                        }
                      }
                        

                      function devTipoEmpresa($id)
                      {
                        $sql = mysql_query("SELECT tipo FROM tbl_tipo_empresa WHERE id_tipo_empresa = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return utf8_encode($dts[0]);
                        }
                      }

                      function devRazonSocial($id)
                      {
                        $sql = mysql_query("SELECT razon_social FROM tbl_razon_social WHERE id_razon_social = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return utf8_encode($dts[0]);
                        }
                      }

                      function devGiro($id)
                      {
                        $sql = mysql_query("SELECT giro FROM tbl_giro WHERE id_giro = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return utf8_encode($dts[0]);
                        }
                      }

                      function devEdo($id)
                      {
                        $sql = mysql_query("SELECT nombre FROM tbl_estados WHERE id = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return utf8_encode(strtoupper($dts[0]));
                        }
                      }

                      function devMun($id)
                      {
                        $sql = mysql_query("SELECT nombre FROM tbl_municipios WHERE id = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return utf8_encode(strtoupper($dts[0]));
                        }
                      }

                      function devLoc($id)
                      {
                        $sql = mysql_query("SELECT nombre FROM tbl_localidades WHERE id = '$id'")or die(mysql_error());
                        while ($dts = mysql_fetch_row($sql)) 
                        {
                          return utf8_encode(strtoupper($dts[0]));
                        }
                      }

                      function devIdEmpleado($id)
                      {
                        $sql = mysql_query("SELECT id FROM tbl_empleado WHERE id_usuario = '$id'")or die(mysql_error());
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
    <script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
    <script src="../../../js/jquery.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>