<?php
//VARIABLES DE CONEXION AL SERVIDOR
  $servidor="127.0.0.1"; 
  $usuario="root";
  $pwServidor="asdjkl";
  $bd="bd_pv"; 
  //ESTABLECIENDO LA CONEXION AL SERVIDOR
  $conexion  = mysql_connect($servidor,$usuario,$pwServidor);
   if($conexion){//Si la conexion se realizo correctamente
      // session_start();//Inicial sesion
       if (mysql_select_db($bd,$conexion)){//Si la base de datos existe
		  return;
	   }
	   else
	        echo "Conexión con la base de datos fallida";		
   }
   else
      echo "Conexión con el servidor fallida";
?>