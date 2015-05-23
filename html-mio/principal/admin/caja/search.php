<?php
include('../../../conexion/conexion.php');

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
if($_POST)
{
	$q = $_POST['cod'];//se recibe la cadena que queremos buscar
	$sql_res=mysql_query("SELECT * FROM tbl_producto WHERE codigo_producto like '%$q%' AND rfcEmpresa = '$rfcNego'")or die(mysql_error()."falla aqui");
	
	while($row=mysql_fetch_array($sql_res))
	{
		$codigo=$row['codigo_producto'];
		$nombre=$row['nombre_producto'];
		$marca=$row['marca'];

?>
<a href="index.php?cod=<?php echo $codigo; ?>" style="text-decoration:none;" >
	<div class="display_box" align="left">
		<!--<div style="float:left; margin-right:6px;">
			<?php #echo $codigo; ?>
		</div> -->
		<div style="margin-right:6px;">
			<?php echo $nombre; ?>
		</div>
		<div style="margin-right:6px; font-size:14px;" class="desc">
			<?php echo $marca." CÓDIGO:".$codigo; ?>
		</div>
	</div>
</a>

<?php
	}

}
else
{

}
?>