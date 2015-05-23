<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/icono.png">

    <title>Mi nego</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/singnin.css" rel="stylesheet">
    <style type="text/css">
      body 
      {
        background-position: center;
        background-image: url(../img/fondoP.png);
        background-repeat: no-repeat;
      }

      .form-signin 
      {
        max-width: 400px;
        padding: 25px 35px 35px;
        margin: 0 auto 25px;
        background-color: #eee;
        border: 1px solid #e3e3e3;
        -webkit-border-radius: 10px;
           -moz-border-radius: 10px;
                border-radius: 10px;
        -webkit-box-shadow: 0 2px 4px rgba(0,0,0,.15);
           -moz-box-shadow: 0 2px 4px rgba(0,0,0,.15);
                box-shadow: 0 2px 4px rgba(0,0,0,.15);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox 
      {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] 
      {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!--<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="../img/logo.png" width="90px"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#about">Acerca</a></li>
            <li><a href="#contact">Contacto</a></li>
            <li><a href="registro.php">Registrate</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="../login.php">Iniciar Sesión</a></li>
              <li><a href="login.php"></a></li>
          </ul>
        </div><!--/.nav-collapse 
      </div>
    </div>-->
    <div class="container">
      <div class="col-lg-4">
        <br>
      </div>
      <div clasS="col-lg-4">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form class="form-signin" action="funciones/appRegistroAcceso.php" method="post">
          <h2 class="form-signin-heading">Acceso Empleado</h2>
          <input type="text" class="form-control" placeholder="Nombre de Usuario" autofocus name="usuario">
          <input type="password" class="form-control" placeholder="Contraseña" name="password">
          <label>
            <script>
            </script>
          </label>
          <button class="btn btn-lg btn-success btn-block" type="submit">REGISTRAR</button>
        </form>
        <div class="col-lg-12" align="center">
          <h1>
            <?php //obteniendo la pagina
              if (isset($_REQUEST['error_login'])) { //si "si" tiene dato
                echo "<p></p>".$error_login= $_REQUEST['error_login']; 
              } else { //si no tiene dato
                $error_login = ""; //inicio en blanco del dato
              }
            ?>
          </h1>
        </div>
        <br>
        <br>
        <br>
        <br>
      </div>
      <div class="col-lg-4">
        <br>
      </div>
    </div>
    <div class="container">
      <br>
    </div><!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
