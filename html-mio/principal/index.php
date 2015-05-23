<?php 
include "../../../conexion/conexion.php";
session_start();
$usr = $_SESSION["usuario"];
$rol = $_SESSION["rol"];
$rfcNego = $_SESSION["rfcNego"];
$idUsr = $_SESSION['idUsuario'];

while ($usr == "" OR $rfcNego == "" OR $idUsr == "") 
{
  Header ("Location: ../login.php");
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
    <link rel="shortcut icon" href="img/icono.png">

    <title>Mi nego</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/carousel.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
      <br>
      <br>
      <div class="col-lg-12" align="center">
        <?php  

          session_start();

          $usr = $_SESSION["usuario"];
          $rol = $_SESSION["rol"];
          $rfcNego = $_SESSION["rfcNego"];
          $idUsr = $_SESSION['idUsuario'];

          if($rol == "Administrador")
          {
            header ("Location: admin/index.php");
            exit();
          }
          else
          {
            if($rol == "Inventario")
            {
              header ("Location: inventario/index.php");
              exit();
            }
            else
            {
              if($rol == "Caja")
              {
                header ("Location: caja/index.php");
                exit();
              }
              else
              {
                
              }
            }
          }
        ?>
      </div>
      <br>
      <br>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
