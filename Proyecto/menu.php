<?php
//session_cache_limiter(FALSE); 
session_start();
include("conexion.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

if(isset($_SESSION['sesuser'])){
	$sql="select
m.modulo_codigo,
ifnull(a.acceso_estado,'inactivo') as estado
from tbl_modulo m
left outer join tbl_acceso a on a.modulo_codigo=m.modulo_codigo and a.usuario_usuario='".$_SESSION['sesuser']."';";
$result=mysqli_query($conexion,$sql);
while ($row=mysqli_fetch_assoc($result)){
	$modulo="M".$row["modulo_codigo"];
	$acceso=($row["estado"]=="activo"?true:false);
	$_SESSION[$modulo]=$acceso;
}


//print_r($_SESSION);

}

?>
<!DOCTYPE html>
<html>
<head>
<base target="contenido">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Noto+Sans+JP&display=swap" rel="stylesheet"> 
	
	<link rel="stylesheet" href="css/style.css">

	<script type="text/javascript" language="javascript" src="js/jquery-3.6.0.min.js"></script>
	

</head>

<body>

	<nav class="sidebar-navigation">
	<ul>
        <li class="">
            <?php echo "(".$_SESSION['sesuser'].") ".$_SESSION['sesnombre'];?>
        </li>
		<li class="">
			<a class="home" href="main.php" TARGET="_self"></a>
			<span class="tooltip">Home</span>
		</li>
<?php
if($_SESSION["M9"]==1){
?>
		<li>
			<a class="receta" href="crear_receta.php" TARGET="_self"></a>
			<span class="tooltip">Recetas</span>
		</li>
<?php
}
if($_SESSION["M5"]==1){
?>
		<li>
			<a class="agenda" href="ver_citas.php" TARGET="_self"></a>
			<span class="tooltip">Cita</span>
		</li>
<?php
}
if($_SESSION["M2"]==1){
?>
		<li>
			<a class="cliente" href="buscar_clientes.php" TARGET="_self"></a>
			<span class="tooltip">Clientes</span>
		</li>
<?php
}
if($_SESSION["M8"]==1){
?>
		<li>
			<a class="servicio" href="consulta_medica.php" TARGET="_self"></a>
			<span class="tooltip">Servicios</span>
		</li>
<?php
}
if($_SESSION["M7"]==1){
?>
		<li>
			<a class="medico" href="ver_medicos.php" TARGET="_self"></a>
			<span class="tooltip">Medicos</span>
		</li>
<?php
}
if($_SESSION["M1"]==1){
?>
		<li>
			<a class="empleado" href="ver_empleado.php" TARGET="_self"></a>
			<span class="tooltip">Empleados</span>
		</li>
<?php
}
if(($_SESSION["M3"]==1) || ($_SESSION["M3-1"]==1)){
?>
        <li>
			<a class="usuario" href="form_usuario.php" TARGET="_self"></a>
			<span class="tooltip">Usuarios</span>
		</li>
<?php
}
if($_SESSION["M6"]==1){
?>
		<li>
			<a class="factura" href="buscar_factura.php" TARGET="_self"></a>
			<span class="tooltip">Factura</span>
		</li>
<?php
}
?>
		<li>
			<a class="info" href="info.php" TARGET="_self"></a>
			<span class="tooltip">Informacion</span>
		</li>

		<li>
			<a class="exit" href="action.php?action=logout" TARGET="_self"></a>
			<span class="tooltip">Salir</span>
		</li>
        
	</ul>
</nav>
<script  src="js/menu.js"></script>

	</nav>
</body>

</html>