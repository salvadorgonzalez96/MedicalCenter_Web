<?php
session_start();
include("conexion.php");

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
	<meta charset="utf-8">
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />

</head>
<body>

<div class="main clearfix">
				<nav id="menu" class="nav">					
					<ul>
<?php
if($_SESSION["M5-1"]==1){
?>
						<li>
							<a href="agendar_cita.php" TARGET="_self">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-one"><img src="img/agregarcita.png"/></i>
								</span>
								<span>Agendar Cita</span>
							</a>
						</li>
<?php
}
if($_SESSION["M5-2"]==1){
?>
						<li>
							<a href="" TARGET="_self">
								<span class="icon">
									<i aria-hidden="true" class="icon-two"><img src="img/modificarcita.png"/></i>
								</span>
								<span>Modificar Cita</span>
							</a>
						</li>
<?php
}
?>
						<li>
							<a href="ver_citas.php" TARGET="_self">
								<span class="icon">
									<i aria-hidden="true" class="icon-three"><img src="img/buscarcita.png"/></i>
								</span>
								<span>Buscar Cita</span>
							</a>
						</li>
                        
					</ul>
				</nav>
			</div>
		</div><!-- /container -->

</body>
</html>