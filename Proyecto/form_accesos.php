<?php 
include("menu.php");

include("menu_usuarios.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

include("conexion.php");

$tieneacceso="";

$accion=isset($_POST["accion"])?$_POST["accion"]:"";

if($accion=="guardar"){
	$sql="insert into tbl_acceso values('".$_POST["txtmodid"]."','".$_POST["usuario"]."','".$_POST["cmbestado"]."')";

	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Informacion Guardada Exitosamente!');</script>";
	}
	else{
		echo "Error no se puede ejecutar ".$sql." Error ".mysqli_error($conexion);
	}
	$accion="";
}
else if($accion=="modificar"){
	$sql="update tbl_acceso set
	acceso_estado='".$_POST["cmbestado"]."'
	where modulo_codigo='".$_POST["txtmodid"]."' 
	and usuario_usuario='".$_POST['usuario']."';";
	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Se Modifico Satisfactoriamente');</script>";
	}
	else{
		echo "<script>alert('Error al Actualizar');</script>";
	}
	$accion="";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulario de Accesos</title>
	<link rel="stylesheet" href="css/style-general.css">
</head>

<script src="js/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

	function llenarAccess(){
		document.getElementById("tieneacceso").value=document.getElementById("cmbestado").value;
		//document.getElementById("formu").submit();
	}

	function llenar(mcodigo,mnombre,estado){
		document.getElementById('dotros').style.display = 'block';
		document.getElementById("txtmodid").value=mcodigo;
		document.getElementById("txtmodnom").value=mnombre;
		document.getElementById("tieneacceso").value=estado;
	}

	function llenarUsuario(){
		document.getElementById("usuario").value=document.getElementById("cmbusuario").value;
		document.getElementById("formu").submit();
	}

	function validar(){
		/*if(document.getElementById("cmbusuario").value==""){
			alert("Favor Seleccione un Empleado");
			document.getElementById("cmbusuario").focus();	
		}
		else*/ if(document.getElementById("txtmodid").value==""){
			alert("Debe de Seleccionar un Modulo del Listado de Accesos");
			document.getElementById("txtmodid").focus();	
		}
		else if(document.getElementById("txtmodnom").value==""){
			alert("Debe de Seleccionar un Modulo del Listado de Accesos");
			document.getElementById("txtmodnom").focus();	
		}
		else if(document.getElementById("cmbestado").value==""){
			alert("Debe de Seleccionar un Estado del ComboBox");
			document.getElementById("cmbestado").focus();	
		}
		else{
			//alert("Guardar");
			if(document.getElementById("tieneacceso").value==""){
				//alert("Guardar");
				document.getElementById("accion").value="guardar";
			}
			else{
				//alert("Modificar");
				document.getElementById("accion").value="modificar";
			}
			return true;
		}
		return false;
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

<body>
	
<?php
$usuario=(isset($_POST["cmbusuario"])?$_POST["cmbusuario"]:"");
//echo "La cedula recaudada es ".$usuario;
?>

	<div id="all" align='center'><h2>Formulario para Mantenimiento de Accesos</h2>


	<form name='formu' id='formu' method="POST" action='form_accesos.php'>

	<input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>">
	<input type="hidden" name="usuario" id="usuario" value="<?php echo $usuario; ?>">
	<input type="hidden" name="tieneacceso" id="tieneacceso" value="<?php echo $tieneacceso; ?>">

		<div id="main-content">
		<fieldset>
			<label>Usuario</label>
			<select name='cmbusuario' id='cmbusuario' onChange="return llenarUsuario();">
<?php
include("conexion.php");
//echo "<option value='' selected disabled >[SELECCIONE UN EMPLEADO CON USUARIO]</option>";
echo "<option value=''>[SELECCIONE UN EMPLEADO CON USUARIO]</option>";

$sql="select
concat(e.empleado_nombre,' ',e.empleado_apellido1,' ',e.empleado_apellido2)as nombrec,
e.empleado_cedula as cedula,
u.usuario_usuario as usuario
from
tbl_empleado e
inner join tbl_usuario u on u.empleado_cedula = e.empleado_cedula";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result)){
	echo "<option value='".$row["usuario"]."'>(".$row["usuario"].")-".$row["nombrec"]."</option>";
}


?>
			</select>
		</fieldset>

<!--		<fieldset align="center">
		<button name='btnguardar' onClick="return validar();">Guardar</button>
		</fieldset>
-->
		</div>


<!--**********************************************************************************************************
**************************************************************************************************************-->
<div id='dlista' style="background-color: darkgray;">
		<div id="principal" align="center"><h1><b>Listado de Accesos</b></h1>
		<table name='tabla' id="tabla" align="center" border="1" width="80%">
			<thead bgcolor="#58ACFA">
				<th>Cedula</th>
				<th>Nombre del Empleado</th>
				<th>Usuario</th>
				<th>Estado</th>
				<th>Modulo</th>
				<th>Acceso</th>
				<th>Controles</th>
			</thead>
			<tbody>
<?php 
//$usuario=$_POST['cmbusuario'];
$usuario=(isset($_POST["cmbusuario"])?$_POST["cmbusuario"]:"");
if($usuario==""){

}
else{
$sql="select
m.modulo_codigo,
m.modulo_nombre,
m.modulo_estado,
ifnull(a.usuario_usuario,'')as usuario_usuario,
ifnull(a.acceso_estado,'')as acceso_estado,
u.empleado_cedula as cedula,
concat(e.empleado_nombre,' ',e.empleado_apellido1)as nombrec,
u.usuario_estado as estado_usuario
FROM
tbl_modulo m
left outer join tbl_acceso a on a.modulo_codigo=m.modulo_codigo and a.usuario_usuario='".$usuario."'
left outer join tbl_usuario u on u.usuario_usuario=a.usuario_usuario
left outer join tbl_empleado e on e.empleado_cedula=u.empleado_cedula;";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result)){
	//Maquillar colores en cada fila
	$color=($row["estado_usuario"]=="activo"?"#F3E2A9":"#D0F5A9");

//$tieneacceso=$row["acceso_estado"];
	echo "
	<tr bgcolor='".$color."'>
	<td>".$row["cedula"]."</td>
	<td>".$row["nombrec"]."</td>
	<td>".$row["usuario_usuario"]."</td>
	<td>".$row["modulo_estado"]."</td>
	<td>".$row["modulo_nombre"]."</td>
	<td>".$row["acceso_estado"]."</td>
								
	<td align='center'><img src='img/modificar.png' onClick='return llenar(\"".$row["modulo_codigo"]."\",\"".$row["modulo_nombre"]."\",\"".$row["acceso_estado"]."\")'></td>
	</tr>";
}
}
?>
			</tbody>
		</table>

		<div id="dotros" name="dotros">
		<fieldset>
			<label>Nombre del Modulo</label>
			<input type="text" name="txtmodid" id="txtmodid" value="" readonly>
			<input type="text" name="txtmodnom" id="txtmodnom" value="" readonly>
		</fieldset>
		<fieldset>
			<label>Estado del Acceso:</label>
			<select name="cmbestado" id="cmbestado">
				<option value=""></option>
				<option value="activo">ACTIVO</option>
				<option value="inactivo">INACTIVO</option>
			</select>
		</fieldset>
		<fieldset align="center">
			<button onClick='return validar();'>Actualizar</button>
		</fieldset>
		<div>
<div>
<?php 
//Mostrar o Esconder un Div
if($usuario!=""){
	//Mostrar Div
	echo "<script>document.getElementById('dlista').style.display = 'block';</script>";
}
else{
	//Esconder Div
	echo "<script>document.getElementById('dlista').style.display = 'none';</script>";
}
echo "<script>document.getElementById('dotros').style.display = 'none';</script>";
?>
</div>


	</form>
		
    </div>

</body>
</html>