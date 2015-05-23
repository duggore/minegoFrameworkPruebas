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
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#about">Acerca</a></li>
            <li><a href="#contact">Contacto</a></li>
            <li class="active"><a href="registro.php">Registrate</a></li>
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
    <div class="container">
      <form action="funciones/appAgregarCliente.php" method="post">
        <div class="col-md-12">
          <div class="panel panel-group panel-info form-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <div class="panel-heading">Datos Usuario<img align="right" src=""></div>
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  <div class="col-lg-4">
                    <label>Nombre Usuario:</label>
                    <input type="text" class="form-control" placeholder="Nombre Usuario" name="usr" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Contraseña:</label>
                    <input type="password" class="form-control" placeholder="Contraseña" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Confirma Contraseña:</label>
                    <input type="password" class="form-control" placeholder="Contraseña" name="pwd2" required>
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
                    <div class="panel-heading">Datos principales<img align="right" src=""></div>
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                  <div class="col-lg-4">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Apellido Paterno:</label>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="pat" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Apellido Materno:</label>
                    <input type="text" class="form-control" placeholder="Apellido Materno" name="mat" required> 
                  </div>
                  <div class="col-xs-4"> 
                      <label>Estado</label>
                      <?php 
                        include ("conexion/conexion.php");
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
                  <div class="col-lg-6">
                    <label>Calle:</label>
                    <input type="text" class="form-control" placeholder="Calle, Avenida, Carretera..." name="calle" required>
                  </div>
                  <div class="col-lg-2">
                    <label>Numero Exterior:</label>
                    <input type="number" class="form-control" placeholder="Numero exterior" min="1" name="noEx" required>
                  </div>
                  <div class="col-lg-2">
                    <label>Numero Interior:</label>
                    <input type="number" class="form-control" placeholder="Numero interior" min="0" name="noIn" required>
                  </div>
                  <div class="col-lg-2">
                    <label>Codigo Postal:</label>
                    <input type="number" class="form-control" placeholder="Codigo Postal" name="cp" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Telefono Fijo:</label>
                    <input type="tel" class="form-control" placeholder="10 Digitos" name="tf" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Telefono Movil:</label>
                    <input type="tel" class="form-control" placeholder="10 Digitos" name="tm">
                  </div>
                  <div class="col-lg-4">
                    <label>Correo Electronico:</label>
                    <input type="email" class="form-control" placeholder="E-mail" name="mail" required>
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
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    <div class="panel-heading">Datos Empresa<img align="right" src=""></div>
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse in">
                <div class="panel-body">
                  <div class="col-lg-4">
                    <label>RFC Empresa:</label>
                    <input type="text" class="form-control" placeholder="RFC Empresa" name="rfcEmpr" required>
                  </div>
                  <div class="col-lg-8">
                    <label>Nombre Negocio:</label>
                    <input type="text" class="form-control" placeholder="Nombre tu nego" name="nombNego" required>
                  </div>
                  <div class="col-lg-4">
                    <label>Giro:</label>
                    <?php 
                      $consulta=mysql_query("SELECT id_giro, giro FROM tbl_giro");
                      // Voy imprimiendo el primer select compuesto por los paises
                      echo "<select name='idGiro' class='form-control' required>";
                      echo "<option value='0'>--</option>";
                      while($registro=mysql_fetch_row($consulta))
                      {
                          echo "<option value='".$registro[0]."'>". utf8_encode($registro[1])."</option>";
                      }
                      echo "</select>";
                    ?>
                  </div>
                  <div class="col-lg-4">
                    <label>Razon Social:</label>
                    <?php 
                      $consulta=mysql_query("SELECT id_razon_social, razon_social FROM tbl_razon_social");
                      // Voy imprimiendo el primer select compuesto por los paises
                      echo "<select name='idRazon' class='form-control' required>";
                      echo "<option value='0'>--</option>";
                      while($registro=mysql_fetch_row($consulta))
                      {
                          echo "<option value='".$registro[0]."'>". utf8_encode($registro[1])."</option>";
                      }
                      echo "</select>";
                    ?>
                  </div>
                  <div class="col-lg-4">
                    <label>Tipo Negocio:</label>
                    <?php 
                      $consulta=mysql_query("SELECT id_tipo_empresa, tipo FROM tbl_tipo_empresa");
                      // Voy imprimiendo el primer select compuesto por los paises
                      echo "<select name='idTipo' class='form-control' required>";
                      echo "<option value='0'>--</option>";
                      while($registro=mysql_fetch_row($consulta))
                      {
                          echo "<option value='".$registro[0]."'>". utf8_encode($registro[1])."</option>";
                      }
                      echo "</select>";
                    ?>
                  </div>
                  <div class="col-lg-12">
                    <label>Descripcion:</label>
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
                  <a class="btn btn-danger btn-lg" href="registro.php">Cancelar</a>
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
      <br>
    </div>
    <div class="container">
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
    <script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
