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
                <li><a href="../empleado/index.php"><img src="../../../img/icoNgo/users_icon16.png"> actualizar Empleado</a></li>
                <li><a href="../empleado/index.php"><img src="../../../img/icoNgo/contact_card_icon16.png"> desactivar Empleado</a></li>
                <li><a href="../empleado/index.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Empleado</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Empresa</li>
                <li><a href="../empresa/index.php"><img src="../../../img/icoNgo/import_icon16.png"> actualizar Negocio</a></li>
                <li><a href="../empresa/index.php"><img src="../../../img/icoNgo/app_window_cross16.png"> desactivar Negocio</a></li>
                <li><a href="../empresa/index.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar Negocio</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Mi perfil</li>
                <li><a href="actualiza.php"><img src="../../../img/icoNgo/reload_icon16.png"> Actualizar datos</a></li>
                <li><a href="desactiva.php"><img src="../../../img/icoNgo/delete_server_icon16.png"> Desactivar cuenta</a></li>
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
    <br>
    <br>
    <br>
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="../../../img/default.jpg" data-src="../../../img/default.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Bienvenido a "Mi Nego".</h1>
              <p>Administra tu negocio totalmente en linea.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="../../../img/default.jpg" data-src="../../../img/default.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Movilidad en la palma de tu mano.</h1>
              <p>Define roles y administra el inventario de tu negocio o deja que alguien lo administre por ti.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="../../../img/default.jpg" data-src="../../../img/default.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Impresion de formatos.</h1>
              <p>Crea tickets, reportes de inventarios de ventas en un solo lugar, "Mi nego" facilita estas tareas.</p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <a>
            <img class="img-circle" src="../../../img/96/male-user-edit.png" data-src="../../../img/96/male-user-edit.png" alt="Generic placeholder image">
          </a>
          <h2>Actualizar Mis Datos</h2>
          <form action="actualiza.php" method="post">
            <input type="number" name="idEmpleado" value="<?php echo devIdEmpleado($idUsr); ?>" hidden>
            <?php 
              function devIdEmpleado($id)
              {
                $sql = mysql_query("SELECT id FROM tbl_empleado WHERE id_usuario = '$id'")or die(mysql_error());
                while ($dts = mysql_fetch_row($sql)) 
                {
                  return $dts[0];
                }
              }
            ?>
            <p><button class="btn btn-primary" action="submit">Entrar &raquo;</button></p>
          </form>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <a href="../index.php">
            <img class="img-circle" src="../../../img/icono.png" width="100px" data-src="../../../img/96/male-user-remove.png" alt="Generic placeholder image">      
          </a>
          <h2>Ir a Inicio</h2>
          <p><a class="btn btn-success" href="../index.php">Entrar &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <a href="control.php">
            <img class="img-circle" src="../../../img/96/close.png" data-src="../../../img/96/close.png" alt="Generic placeholder image">
          </a>
          <h2>Control de Cuenta</h2>
          <p><a class="btn btn-warning" href="control.php">Entrar &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
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
