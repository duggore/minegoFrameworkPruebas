<?php 
include "../../../conexion/conexion.php";

session_start();
$usr = $_SESSION["usuario"];
$rol = $_SESSION["rol"];
$rfcNego = $_SESSION["rfcNego"];
$idUsr = $_SESSION["idUsuario"];

while ($rol != 'Administrador' OR $usr == "") 
{
  Header ("Location: ../../../login.php");
  exit;
}
function devIdControl($rfcEmp)
{
	$sql = mysql_query("SELECT id_control FROM tbl_control_pago WHERE rfcEmpresa = '$rfcEmp'")or die(mysql_error()."falla esto");
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}
function devFechaRegistro($rfcEmp)
{
	$sql = mysql_query("SELECT fecha_registro FROM tbl_control_pago WHERE rfcEmpresa = '$rfcEmp'")or die(mysql_error()."falla esto");
	while ($dts = mysql_fetch_row($sql)) 
	{
		return date("d - m - Y",strtotime($dts[0]));
	}
}
function devFechaVencimiento($rfcEmp)
{
	$sql = mysql_query("SELECT fecha_vencimiento FROM tbl_control_pago WHERE rfcEmpresa = '$rfcEmp'")or die(mysql_error()."falla esto");
	while ($dts = mysql_fetch_row($sql)) 
	{
		return date("d - m - Y",strtotime($dts[0]));
	}
}
function devStatus($rfcEmp)
{
	$sql = mysql_query("SELECT id_status FROM tbl_control_pago WHERE rfcEmpresa = '$rfcEmp'")or die(mysql_error()."falla esto");
	while ($dts = mysql_fetch_row($sql)) 
	{
		$sql_st = mysql_query("SELECT status FROM tbl_status WHERE id_status = '$dts[0]'")or die(mysql_error()."falla esto");
		while ($dts_st = mysql_fetch_row($sql_st))  
		{
			return $dts_st[0];
		}
	}
}
function devSeleccion($rfcEmp)
{
	$sql = mysql_query("SELECT id_plan FROM tbl_control_pago WHERE rfcEmpresa = '$rfcEmp'")or die(mysql_error()."Falla a");
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
}
function devDiasGracia($id)
{
	$sql = mysql_query("SELECT dias_gracia FROM tbl_plazos WHERE id_plazo = '$id'")or die(mysql_error());
	while ($dts = mysql_fetch_row($sql)) 
	{
		return $dts[0];
	}
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
                <li><a href="index.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar datos</a></li>
                <li><a href="index.php"><img src="../../../img/icoNgo/delete_server_icon16.png"> Desactivar cuenta</a></li>
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
        <h1>Plan contratado <small>Mi nego</small></h1>
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
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  <div class="panel-heading">Seleccionar Plan<img align="right" src=""></div>
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                <div class="col-lg-12">
	                <table class="table table-responsive table-stripped"> 
	                	<tr>
	                		<th>Seleccion</th>
	                		<th>Planes</th>
	                		<th>Descripcion</th>
	                		<th>Costo</th>
	                		<th>Plazos</th>
	                	</tr>
	                <?php  
                		$sqlPlan = mysql_query("SELECT * FROM tbl_planes WHERE id_status = '8'")or die(mysql_error()." falla aqui");
                		while ($dtsPlan = mysql_fetch_row($sqlPlan)) 
                		{
                			echo "<tr align='center'>
	                			  <td>";
	                		if ($dtsPlan[0] == devSeleccion($rfcNego)) 
                      {
                        echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                      }
                      else
                      {
                        echo "";
                      } 
                      if (date("d - m - Y") >= devFechaVencimiento($rfcNego)) 
                      {
                        echo "
                        <form action='funciones/appCambiaPlan.php' method='post'>
                          <input type='text' value='".$dtsPlan[0]."' name='plan' hidden>
                          <input type='text' value='".devIdControl($rfcNego)."' name='control' hidden>
                          <button class='btn btn-success'>Contrata</button>
                        </form>
                        ";
                      }
	                		echo "</td>
		                			<td>".$dtsPlan[1]."</td>
		                			<td>".$dtsPlan[2]."</td>
		                			<td>$ ".number_format($dtsPlan[3],2)."</td>
		                			<td>".devPlazo($dtsPlan[4])."</td>
		                		</tr>";	
                		}


                		function devPlazo($id)
                		{
                			$sql = mysql_query("SELECT nombre FROM tbl_plazos WHERE id_plazo = '$id'")or die(mysql_error());
                			while ($dts = mysql_fetch_row($sql)) 
                			{
                				return $dts[0];
                			}
                		}
	                ?>
	                </table>
                </div>
                <div class="col-lg-12">
                	<table class="table table-responsive">
                		<tr>
                			<th>Fecha de Registro</th>
                			<th><?php echo devFechaRegistro($rfcNego); ?></th>
                			<th>Fecha de Vencimiento</th>
                			<th><?php echo devFechaVencimiento($rfcNego); ?></th>
                			<th>Status Cuenta</th>
                			<th><?php echo devStatus($rfcNego); ?></th>
                		</tr>
                	</table>
                </div>
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
                  <div class="panel-heading">Consultar Cuenta<img align="right" src=""></div>
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
              <div class="panel-body">
                <div class="col-lg-12">
                  <form class="form-signin" action="funciones/appDesactiva.php" method="post">
                    <input type="number" name="control" value="<?php echo devIdControl($rfcNego); ?>" hidden>
                    <button class="btn btn-lg btn-danger btn-block" type="submit">DESACTIVAR</button>                      
                  </form>
                </div>
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
