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
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">

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
          <a class="navbar-brand" href="#"><img src="img/logo.png" width="90px"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Inicio</a></li>
            <li><a href="#about">Acerca</a></li>
            <li><a href="#contact">Contacto</a></li>
            <li><a href="registro.php">Registrate</a></li>
          </ul>
          <form class="navbar-form navbar-right" action="funciones/appInicioSesion.php" method="post">
            <div class="form-group">
              <input type="text" placeholder="Usuario" class="form-control" name="usuario">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>
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
          <img src="img/carrusel3.jpg" data-src="img/carrusel3.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Bienvenido a "Mi Nego".</h1>
              <p>Administra tu negocio totalmente en linea.</p>
              <p><a class="btn btn-large btn-primary" href="#">Registrate &raquo;</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="img/carrusel3.jpg" data-src="img/carrusel3.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Movilidad en la palma de tu mano.</h1>
              <p>Define roles y administra el inventario de tu negocio o deja que alguien lo administre por ti.</p>
              <p><a class="btn btn-large btn-primary" href="#">Registrate &raquo;</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="img/carrusel3.jpg" data-src="img/carrusel3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Impresion de formatos.</h1>
              <p>Crea tickets, reportes de inventarios de ventas en un solo lugar, "Mi nego" facilita estas tareas.</p>
              <p><a class="btn btn-large btn-primary" href="#">Registrate &raquo;</a></p>
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
          <img class="img-circle" src="img/96/Inventory-maintenance.png" data-src="img/96/Inventory-maintenance.png" alt="Generic placeholder image">
          <h2>Inventario</h2>
          
          <p><a class="btn btn-default" href="#">Ver detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="img/96/US-dollar.png" data-src="img/96/US-dollar.png" alt="Generic placeholder image">
          <h2>Punto de venta</h2>
          
          <p><a class="btn btn-default" href="#">Ver detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="img/96/wallet.png" data-src="img/96/wallet.png" alt="Generic placeholder image">
          <h2>Corte de caja</h2>
          
          <p><a class="btn btn-default" href="#">Ver detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
    </div>

    <div class="container">
      <br>
      <br>
      <br>
      <br>
      <!-- /END THE FEATURETTES -->
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Ir arriba</a></p>
        <p>&copy; 2014 Mi nego, alamedida. &middot; <a href="#">Privacidad</a> &middot; <a href="#">Terminos</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
