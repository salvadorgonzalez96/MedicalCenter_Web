<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
	<title>Login</title>

<link rel="stylesheet" href="css/estilo.css">
<link rel="stylesheet" href="css/boton.css">

	<script type="text/javascript">
		function validar(){
			document.getElementById("accion").value="verificar";
			return true;
		}
	</script>

</head>
<body>

<?php
include("conexion.php");

$user="";
$pass="";
$estado="";
$nomb="";

$accion=(isset($_POST["accion"])?$_POST["accion"]:"");
//echo "La Variable de Accion tiene ".$accion;

if($accion=="verificar"){

$sql="select 
concat(e.empleado_nombre,' ',e.empleado_apellido1,' ',e.empleado_apellido2) as nombrec,
u.usuario_usuario,
u.usuario_contra,
u.usuario_estado,
u.usuario_temp
from tbl_usuarios u
inner join tbl_empleado e on e.empleado_cedula=u.empleado_cedula 
where usuario_usuario='".$_POST["txtuser"]."';";
$result=mysqli_query($conexion,$sql);

while($row=mysqli_fetch_assoc($result)){
	$user=$row["usuario_usuario"];
	$pass=$row["usuario_contra"];	
	$estado=$row["usuario_estado"];
	$temp=$row["usuario_temp"];
	$nomb=$row["nombrec"];

    if($temp=="SI"){
    	if( $_POST["txtuser"]==$user && $_POST["txtpass"]==$pass ){	
    		if($estado=="activo"){
    			//echo "<script>alert('SII! ENTRO');</script>";		
    			$_SESSION['sesuser']=$_POST['txtuser'];
    			$_SESSION['sespass']=$_POST['txtpass'];
    			$_SESSION['sesnombre']=$nomb;
    			echo "<script>window.open('principal.php','_self');</script>";
    		}
    		else if($estado=="inactivo"){
    			echo "<script>alert('USUARIO INACTIVO!!');</script>";
    		}
    	}
    	else{
    		echo "<script>alert('CONTRASEÑA INVALIDA!!');</script>";
    	}
    }
    else{
        if( $_POST["txtuser"]==$user && $_POST["txtpass"]==$pass ){	
    		if($estado=="activo"){
    			//echo "<script>alert('SII! ENTRO ".$nomb."');</script>";		
    			$_SESSION['sesuser']=$_POST['txtuser'];
    			$_SESSION['sespass']=$_POST['txtpass'];
    			$_SESSION['sesnombre']=$nomb;
    			echo "<script>window.open('main.php','_self');</script>";
    		}
    		else if($estado=="inactivo"){
    			echo "<script>alert('USUARIO INACTIVO!!');</script>";
    		}
    	}
    	else{
    		echo "<script>alert('CONTRASEÑA INVALIDA!!');</script>";
    	}
    }
}



	/*if($_POST['txtuser']==$row["usuario_codigo"]&&$_POST['txtpass']==$row["usuario_contra"]){

	}*/
	
	
}
?>

	<form name="formulario" id="formulario" action="login.php" method="POST">
	
	<input type="hidden" name="accion" id="accion" value="">

	<div id="main-content" align="center">
		<div id="content">
		<b><h2>LOGIN</h2></b>
		<img src="https://icons.iconarchive.com/icons/icons-land/medical/128/People-Doctor-Male-icon.png"/><br>
		
			
			<input type="text" name="txtuser" id="txtuser" value="" placeholder="Ingresar Usuario"><br/><br/>
		
			
			<input type="password" name="txtpass" id="txtpass" value="" placeholder="Ingresar Contraseña"><br/><br/>
		
			<button class="boton action" onclick="return validar();">
				<span>Ingresar</span>
				<svg>
					<rect x="0" y="0" fill="none"></rect>
				</svg>
			</button>

		</div>
	</div>

	</form>

</body>
</html>