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
                <li><a href="agrega.php"><img src="../../../img/icoNgo/users_icon16.png"> Agregar Empleado</a></li>
                <li><a href="elimina.php"><img src="../../../img/icoNgo/contact_card_icon16.png"> Eliminar Empleado</a></li>
                <li><a href="actualiza.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Empleado</a></li>
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
        <h1>Empleado <small>Mi nego</small></h1>
      </div>
      <div class="col-lg-12">
        <?php //obteniendo la pagina
          if (isset($_REQUEST['error_login'])) { //si "si" tiene dato
            echo "<p></p>".$error_login= $_REQUEST['error_login']; 
          } else { //si no tiene dato
            $error_login = ""; //inicio en blanco del dato
          }?>
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
                      <th colspan="2">Opciones</th>
                      <th>#</th>
                      <th colspan="3">Nombre</th>
                      <th>Responsabilidad</th>
                      <th>Telefono Movil</th>
                    </tr>
                    
                    <?php
                      $i = 1;
                      $sql = mysql_query("SELECT * FROM tbl_empleado WHERE rfcEmpresa = '$rfcNego'")or die(mysql_error());
                      while ($dts = mysql_fetch_row($sql)) 
                      {
                        if ($dts[14] == 1) 
                        {
                          echo "<tr>
                                  <td></td>
                                  <td><form action='actualiza.php' method='post' class=''>
                                <input type='text' name='idEmpleado' value='".$dts[0]."' hidden='true'>
                                <button class='btn btn-primary'><img src='../../../img/icoBco/refresh_icon16.png'></button>
                              </form></td>";
                        }
                        else
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
                        }
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
