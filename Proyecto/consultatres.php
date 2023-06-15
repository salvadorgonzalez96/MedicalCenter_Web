<?php 
	include("conexion.php");

	$contar=0;

	$sql="select count(*) as c from vista_de_usuarios2 where usuario_usuario='".$_POST['codigo']."'";
	$result=mysqli_query($conexion,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$contar=$row["c"];
	}
	$resultado=($contar=="0")?"NO":"SI";
	echo $resultado;
	//echo "PHP de AJAX ".$_POST["codigo"];
?>