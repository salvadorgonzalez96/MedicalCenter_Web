<?php 
	include("conexion.php");

	$contar="";

	$sql="select siesta as c from vista_de_usuarios2 where cedula='".$_POST['codigo']."'";
	$result=mysqli_query($conexion,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$contar=$row["c"];
	}
	$resultado=($contar=="NO")?"NO":"SI";	
	echo $resultado;	
	//echo "PHP de AJAX ".$_POST["codigo"];
?>