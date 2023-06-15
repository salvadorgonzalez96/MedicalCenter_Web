<?php 
include("menu.php");

include("menu_usuarios.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

include("conexion.php");

$rece="";
$user="";
$pass="";
$emp="";
$estado="";
$tiene="";
$habilitado="";
$mismo="";
$pop="";

$accion=isset($_POST["accion"])?$_POST["accion"]:"";				//echo "La Accion ".$accion;


if($accion=="guardar"){
	$sql="insert into tbl_usuarios values('".$_POST["txtusuario"]."','".$_POST["txtpassword"]."','".$_POST["cmbestado"]."','".$_POST["miid"]."','SI')";

	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Informacion Guardada Exitosamente!');</script>";
	}
	else{
		echo "Error no se puede ejecutar ".$sql." Error ".mysqli_error($conexion);
	}
	$pop="si";
}
else if($accion=="llenar"){
	
	$sql="select * from vista_de_usuarios2 where cedula='".$_POST["cedula"]."'";
	//echo $sql;
	$result=mysqli_query($conexion,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$user=$row["usuario_usuario"];
		$pass=$row["usuario_contra"];
		$tiene=$row["siesta"];
		$emp=$row["cedula"];
		$estado=$row["usuario_estado"];
		$habilitado="disabled";
		$rece=$row["cedula"];
	}
	if($tiene=="SI"){
		$accion="modificar";
		
		//echo $accion." Modificar";
	}
	else if($tiene=="NO"){
		$accion="";
		//echo $accion." Guardar";
	}
}
else if($accion=="modificar"){
	$sql="update tbl_usuarios set 
	usuario_usuario='".$_POST["txtusuario"]."',
	usuario_contra='".$_POST["txtpassword"]."',
	usuario_estado='".$_POST["cmbestado"]."',
	usuario_temp='SI'
	where empleado_cedula='".$_POST['miid']."'";
	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Se Modifico Satisfactoriamente');</script>";
	}
	else{
		echo "<script>alert('Error al Actualizar');</script>";
	}
	$pop="si";
}
else if($accion=="limpiar"){
	$user="";
	$pass="";
	$tiene="";
	$emp="";
	$estado="";
	$habilitado="";
	$rece="";
}
//echo "La Accion ".$accion;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulario de Empleado</title>
	<link rel="stylesheet" type="text/css" href="css/popup.css">
    <link rel="stylesheet" href="css/style-general.css">
	<!-- Librerias para Funcionalidades-->
	<script src="js/jquery-3.6.0.min.js"></script>

	<script type="text/javascript">


		function podria(){
			//document.formulario.cmbempleado.focus();
			document.formulario.miid.value = document.getElementById("cmbempleado").value;
			consultatiene();
		}
		//Solucion para problema de ajax**************
		function consultatiene(cedula){
			//alert(cedula);
			var cedula=document.getElementById("cmbempleado").value;
	//================================================
			$.ajax({
					type: 'POST',
					url: 'consultados.php',
					data: {codigo:cedula},
					dataType: 'html'
				})
				.done(function(respuesta) {
					document.getElementById("esta").value=respuesta;
				})
				.fail(function() {
					console.log("error");
					//alert("error");
				});
	//================================================
			//alert("Ay Aja "+contar);
			//alert("Aqui va el Return "+contar);
			return false;
		}

		function consultausuario(nick){
			//alert(cedula);
			var nick=document.getElementById("txtusuario").value;
	//================================================
			$.ajax({
					type: 'POST',
					url: 'consultatres.php',
					data: {codigo:nick},
					dataType: 'html'
				})
				.done(function(answer) {
					document.getElementById("miuser").value=answer;
				})
				.fail(function() {
					console.log("error");
					//alert("error");
				});
	//================================================
			//alert("Ay Aja "+contar);
			//alert("Aqui va el Return "+contar);
			return false;
		}

		function passaleatorio(){
			//alert(cedula);
			var cedula=document.getElementById("cmbempleado").value;
	//================================================
			$.ajax({
					type: 'POST',
					url: 'aleatorio.php',
					data: {},
					dataType: 'html'
				})
				.done(function(respuesta) {
					document.getElementById("txtpassword").value=respuesta;
				})
				.fail(function() {
					console.log("error");
					//alert("error");
				});
	//================================================
			//alert("Ay Aja "+contar);
			//alert("Aqui va el Return "+contar);
			return false;
		}

		function clean(){
			document.getElementById("accion").value="limpiar";
			document.getElementById("formulario").submit();
		}

		function llenar(cedula){
		//alert("Cedula "+cedula);
		document.getElementById("accion").value="llenar";
		document.getElementById("cedula").value=cedula;
		document.getElementById("txtusuario").focus();
		document.getElementById("formulario").submit();
		//return false;
		}

		function validar(){
			//alert("Voy a validar");
			var stop="NO";
			if(document.getElementById("miuser").value=="SI"){
				alert("Ese Usuario ya existe, favor ingresar otro usuario");
				stop="SI";
				document.getElementById("txtusuario").focus();
			}


			if(document.getElementById("txtusuario").value==""){
				alert("Favor Ingresar el Usuario del Empleado");
				document.getElementById("txtusuario").focus();	
			}
			else if(document.getElementById("txtpassword").value==""){
				alert("Favor Ingresar la Clave del Empleado");
				document.getElementById("txtpassword").focus();	
			}
			else if(document.getElementById("cmbempleado").value==""){
				alert("Favor Ingresar un Empleado");
				document.getElementById("cmbempleado").focus();	
			}

	//----------
			
			else{

				if(document.getElementById("accion").value==""){
					//alert("Guardar en BD");
					//document.getElementById("accion").value="estara";
					if(document.getElementById("esta").value=="SI"){
						alert("El Empleado ya tiene un Usuario y Clave");
						//alert(document.getElementById("accion").value);
						return false;
					}
					else {
						if(stop=="SI"){
							
							return false;
						}
						else if(stop=="NO"){
							document.getElementById("accion").value="guardar";

							//window.open('popup.php','ventana','width=640,height=480,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');

							//document.getElementById('window-notice').style.display = 'block';
						}
					}
				}
				else if(document.getElementById("accion").value=="modificar"){
					if(stop=="SI"){
							
							return false;
					}
					//alert("modificar en BD");
				}
				
				return true;
			}
			
			return false;
			//break; return ;
		}
</script>

<style>
    #all{
        /*border:1px solid;*/
        height:550px;
        width:92%;
        overflow-y:scroll;
        overflow-x:hidden;
    }
</style>

</head>
<body >
	
	<div align='center' id="all"><h2>Formulario para Mantenimiento de Usuario</h2>


	<form name='formulario' id='formulario' method="POST" action='form_usuario.php'>


	<input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>">
	<input type="hidden" name="cedula" id="cedula" value="" placeholder="Cedula">

	<input type="hidden" name="miid" id="miid" value="<?php echo $rece;?>" placeholder="MIID">
	<input type="hidden" name="esta" id="esta" value="<?php echo $tiene;?>">
	<input type="hidden" name="miuser" id="miuser" value="<?php echo $mismo;?>">
		
		<div id="main-content">
		<fieldset>
			<label>Usuario</label>
			<input type="text" name="txtusuario" id="txtusuario" value="<?php echo $user; ?>" maxlength="45" onBlur="return consultausuario();" onchange="return passaleatorio()">
		</fieldset>

		<!--<fieldset>
			<label>Clave</label>-->
			<input type="hidden" name="txtpassword" id="txtpassword" value="<?php echo $pass; ?>" maxlength="45">
		<!--</fieldset>-->

		<fieldset>
			<label>Empleado</label>
			<select name='cmbempleado' id='cmbempleado' onBlur='return podria()' onchange="return passaleatorio()">
<?php
include("conexion.php");

echo "<option value='' selected disabled >SELECCIONE UN EMPLEADO</option>";

$sql="select * from vista_de_usuarios2;";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result)){
	$a=($emp==$row["cedula"]?"selected":"");
	//$c=($habilitado=="selected disabled")?"selected disabled":"";
	echo "<option value='".$row["cedula"]."' ".$a." ".$habilitado." >".$row["nombre"]."</option>";
}


?>
			</select>
		</fieldset>

<?php 
//Setear un value de el ComboBox de forma manual.
$a=($estado=="activo")?"selected":"";
$b=($estado=="inactivo")?"selected":"";
?>
		<fieldset>
			<label>Estado</label>
			<select name='cmbestado' id='cmbestado'>
				<option value='activo' <?php echo $a; ?>>ACTIVO</option>
				<option value='inactivo' <?php echo $b; ?>>INACTIVO</option>
			</select>
		</fieldset>

		<fieldset align="center">
		<button name='btnactualizar' onClick="return validar();">Actualizar</button>
		<button name='btnclean' onClick="return clean();">Limpiar</button>
		</fieldset>
		</div>

<!--**********************************************************************************************************
**************************************************************************************************************-->

		<div align="center"><h1><b>Listado de Usuarios</b></h1>
		<table name='tabla' id="tabla" align="center" border="1" width="80%">
			<thead bgcolor="#58ACFA">
				<th>Nombre del Empleado</th>
				<th>Usuario</th>
				<th>Clave</th>
<!--				<th>Tiene Clave</th>
				<th>Estado</th>-->
				<th>Controles</th>
			</thead>
			<tbody>
				<?php 
					$sql="select * from vista_de_usuarios2;";
					$result=mysqli_query($conexion,$sql);
					$x=1;
					while($row=mysqli_fetch_assoc($result)){
						//Maquillar colores en cada fila
						//$color=($x%2==0?"#D0F5A9":"#F3E2A9");
						$color=($row["usuario_estado"]=="activo"?"#F3E2A9":"#D0F5A9");

						echo "
						<tr bgcolor='".$color."'>
							<td>".$row["nombre"]."</td>
							<td>".$row["usuario_usuario"]."</td>
							<td>".$row["usuario_contra"]."</td>
							
							<td align='center'><img src='img/modificar.png' onClick='return llenar(\"".$row["cedula"]."\")'></td>
						</tr>";
						$x++;

						//echo $row["cedula"]." ".$row["nombre"]." ".$row["ape1"]." ".$row["ape2"]."<br>";
						/* Esto va dentro del While para la tabla
						<td>".$row["siesta"]."</td>
						<td>".$row["usuario_estado"]."</td>*/
					}
				?>
			</tbody>
		</table>
	</div>

	
<!--**********************************************************************************************************
**************************************************************************************************************-->
<div class="window-notice" id="window-notice" style="border:1px solid black;">
        <div class="content">
            <div class="content-text">La Contraseña Temporal es: 
<?php 
    echo $_POST['txtpassword'];
?>
			</div>
            <div class="content-buttons">
            	
            	<a href="form_usuario.php" id="close-button">Aceptar</a>
            </div>
        </div>
</div>
    <script src="js/script.js"></script>

<div>
<?php 
//Mostrar o Esconder un Div
if($pop!=""){
	//Mostrar Div
	echo "<script>document.getElementById('window-notice').style.display = 'block';</script>";
}
else{
	//Esconder Div
	echo "<script>document.getElementById('window-notice').style.display = 'none';</script>";
}
echo "<script>document.getElementById('dotros').style.display = 'none';</script>";
?>
</div>

    </form>
</div>
</body>
</html>