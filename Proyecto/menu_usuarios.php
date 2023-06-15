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
						
						<li>
							<a href="form_usuario.php" TARGET="_self">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-one"><img src="img/usuario.png"/></i>
								</span>
								<span>Formulario de Usuarios</span>
							</a>
						</li>
						<li>
							<a href="form_accesos.php" TARGET="_self">
								<span class="icon">
									<i aria-hidden="true" class="icon-two"><img src="img/access.png"/></i>
								</span>
								<span>Asignacion Accesos</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div><!-- /container -->

</body>
</html>