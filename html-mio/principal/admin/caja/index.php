<?php 
include "../../../conexion/conexion.php";
include "../../../clases/clsControlEmpresa.php";
$objControl = new clsControlEmpresa();

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
    <style type="text/css">
      #display /*estilos para la caja principal en donde se puestran los resultados de la busqueda en forma de lista*/
      {
        width:380px;
        display:none;
        overflow:auto;
        z-index:10;
        border: solid 1px #666;
      }
      .display_box /*estilos para cada caja unitaria de cada usuario que se muestra*/
      {
        padding:2px;
        padding-left:6px; 
        font-size:18px;
        height:63px;
        text-decoration:none;
        color:black; 
      }

      .display_box:hover /*estilos para cada caja unitaria de cada usuario que se muestra. cuando el mause se pocisiona sobre el area*/
      {
        background: red;
        color: white;
      }
      .desc .display_box 
      {
        color:black;
        font-size:16;
      }
      .desc:hover
      {
        color:#FFF;
      }
    /* Easy Tooltip */
    </style>
    <script type="text/javascript" src="jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="jquery.watermarkinput.js"></script>
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
        <h1>Punto de Venta <small>Mi Nego</small></h1>      
      </div>
      <div class="col-lg-12">
        <div class="col-lg-4">
          <pre>Cajero/a : <?php echo devNombreEmpleado($idUsr); ?></pre>          
          <pre>Empresa  : <?php echo devNombreEmpresa($rfcNego); ?></pre>          
        </div>
        <div class="col-lg-2">
          <br>
          <a data-toggle="modal" href="#myModal" class="btn btn-primary" <?php if ($objControl->validaEstado($rfcNego) != 8){ echo "disabled"; } else { echo "enabled"; } ?>
              ><img src="../../../img/icoBco/zoom_icon16.png"> Buscar producto</a>
        </div>
        <form action="funciones/appAgregaProducto.php" method="post">
          <div class="col-lg-2">
            <label>Cantidad:</label>
            <input type="number" class="form-control" step="1" min="0" value="1" placeholder="Cantidad" name="cant">
          </div>
          <div class="col-lg-4">
            <label>Codigo de producto:</label>
            <div class="input-group">
              <script type="text/javascript">
                $(document).ready(function()
                {
                  $(".busca").keyup(function() //se crea la funcioin keyup
                  {
                    var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
                    var dataString = 'cod='+ texto;//se guarda en una variable nueva para posteriormente pasarla a search.php
                    if(texto=='')//si no tiene ningun valor la caja de texto no realiza ninguna accion
                    {
                    }
                    else
                    {
                      $.ajax(
                      {//metodo ajax
                        type: "POST",//aqui puede  ser get o post
                        url: "search.php",//la url adonde se va a mandar la cadena a buscar
                        data: dataString,
                        cache: false,
                        success: function(html)//funcion que se activa al recibir un dato
                        {
                          $("#display").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
                        }
                      });
                    }
                    return false;    
                  });
                });

                jQuery(function($)
                {//funcion jquery que muestra el mensaje "Buscar amigos..." en la caja de texto
                   $("#cod").Watermark("Codigo de barra o Nombre del producto");
                });
              </script>
              <div style=" width:250px; padding-left:0px; " >
                <input type="text" class="form-control busca" autofocus name="cod" id="cod" value="<?php if(isset($_GET["cod"])) { echo $c= $_GET["cod"]; } else { $c = ""; }?>" placeholder="Codigo de barra o Nombre del producto" autocomplete="off">
              </div>
              <div id="display"></div>  
              <input type="text" name="rfcEmp" value="<?php echo $rfcNego; ?>" hidden>
              <span class="input-group-btn">
                <button class="btn btn-success" type="submit" name="Submit" value="Enviar" 
                <?php if ($objControl->validaEstado($rfcNego) != 8){ echo "disabled"; } else { echo "enabled"; } ?>
              >Entrar</button>
              </span>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-12">
        <div class="col-lg-12">
          <?php //obteniendo la pagina
            if (isset($_REQUEST['error_login'])) { //si "si" tiene dato
              echo "<p></p>".$error_login= $_REQUEST['error_login']; 
            } else { //si no tiene dato
              $error_login = ""; //inicio en blanco del dato
            }
          ?>
        </div>
        <div class="col-lg-6">
          <table class='table table-striped'>
            <tr>
              <th colspan='2'>Opciones</th>
              <th>#</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th colspan='2'>Precio</th>
            </tr>
            <?php
              $i = 1;
              $sql = mysql_query("SELECT * FROM tbl_venta WHERE id_status != '7' ")or die(mysql_error()."FALLA LISTAS");
              while ($dts = mysql_fetch_row($sql)) 
              {
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
                        </td>";
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
                  return strtoupper($dts[0])."-".strtoupper($dts[1]);
                }
              }

              function devTotalPagar()
              {
                $precio = 0;
                $sql = mysql_query("SELECT precio FROM tbl_venta WHERE id_status = '3'")or die(mysql_error());
                while ($dts = mysql_fetch_row($sql)) 
                {
                  $precio += $dts[0];
                }
                return $precio;
              }

              function devNombreEmpresa($rfc)
              {
                $sql = mysql_query("SELECT nombre_empresa FROM tbl_empresa WHERE rfcEmpresa = '$rfc'")or die(mysql_error());
                while ($dts = mysql_fetch_row($sql)) 
                {
                  return strtoupper($dts[0]);
                }
              }
              function devNombreEmpleado($id)
              {
                $sql = mysql_query("SELECT nombre,paterno,materno FROM tbl_empleado WHERE id_usuario = '$id'")or die(mysql_error());
                while ($dts = mysql_fetch_row($sql)) 
                {
                  return strtoupper($dts[0].' '.$dts[1].' '.$dts[2]);
                }
              }
            ?>
          </table>
        </div>
        <div class="col-lg-6">
          <form action="funciones/appAgregaVenta.php" method="post">
            <div class="col-lg-12">
              <label>Total a pagar:</label>
              <br>
              <input type="number" min="0" name="totalPagar" id="totalPagar" value="<?php echo devTotalPagar(); ?>" class="alert alert-warning" required>
            </div>
            <div class="col-lg-12">
              <label>Ingreso:</label>
              <br>
              <input type="number" min="0" name="pagoVenta" id="pagoVenta" class="alert alert-info" onchange="devuelveCambio();" placeholder="0" required>
            </div>
            <div class="col-lg-12">
              <label>Cambio:</label>
              <input type="text" name="rfcEmp" value="<?php echo $rfcNego; ?>" hidden>
              <br>
              <input type="number" min="0" class="alert alert-success" name="cambio" id="cambioTotal" placeholder="0" required>
            </div>
            <div class="col-lg-12" align="center">
              <div class="col-lg-12">
                <br>
                <br>
              </div>
              <div class="col-lg-6">
                <button class="btn btn-success" <?php if ($objControl->validaEstado($rfcNego) != 8){ echo "disabled"; } else { echo "enabled"; } ?>
              >Finalizar <br> Venta</button>
              </div>
            </form>
            <div class="col-lg-6">
              <button class="btn btn-danger" <?php if ($objControl->validaEstado($rfcNego) != 8){ echo "disabled"; } else { echo "enabled"; } ?>
              >Cancelar <br> Venta</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <script type="text/javascript">
                $(document).ready(function()
                {
                  $(".busca").keyup(function() //se crea la funcioin keyup
                  {
                    var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
                    var dataString = 'cod='+ texto;//se guarda en una variable nueva para posteriormente pasarla a search.php
                    if(texto=='')//si no tiene ningun valor la caja de texto no realiza ninguna accion
                    {
                    }
                    else
                    {
                      $.ajax(
                      {//metodo ajax
                        type: "POST",//aqui puede  ser get o post
                        url: "search.php",//la url adonde se va a mandar la cadena a buscar
                        data: dataString,
                        cache: false,
                        success: function(html)//funcion que se activa al recibir un dato
                        {
                          $("#display2").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
                        }
                      });
                    }
                    return false;    
                  });
                });

                jQuery(function($)
                {//funcion jquery que muestra el mensaje "Buscar amigos..." en la caja de texto
                   $("#cod2").Watermark("Codigo de barra o Nombre del producto");
                });
              </script>
              <div style=" width:250px; padding-left:10px; " >
                <input type="text" class="form-control busca" autofocus name="cod" id="cod2" value="<?php if(isset($_GET["cod"])) { echo $c= $_GET["cod"]; } else { $c = ""; }?>" placeholder="Codigo de barra o Nombre del producto" autocomplete="off">
              </div>
              <div id="display2"></div>  
              <input type="text" name="rfcEmp" value="<?php echo $rfcNego; ?>" hidden>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" name="Submit" value="Enviar" 
                <?php if ($objControl->validaEstado($rfcNego) != 8){ echo "disabled"; } else { echo "enabled"; } ?>
              >Cargar datos</button>
              </span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <!--<button type="button" class="btn btn-primary">Cargar datos</button>-->
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
    <script type="text/javascript" src="operacion.js"></script>
    <script src="../../../js/jquery.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>