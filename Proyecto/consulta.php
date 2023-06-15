<?php 
	include("conexion.php");
    
	$contar=0;

	$sql="select count(*) as c from tbl_empleado where empleado_cedula='".$_POST['codigo']."'";
	$result=mysqli_query($conexion,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$contar=$row["c"];
	}
	$resultado=($contar=="0")?"NO":"SI";
	echo "<script>alert('WUUU!!!');</script>";
	echo $resultado;
	//echo "PHP de AJAX ".$_POST["codigo"];
?>