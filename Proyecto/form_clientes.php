<?php 
include("menu.php");
include("menu_clientes.php");

$accion=isset($_POST["accion"])?$_POST["accion"]:"";

if($accion=="guardar"){
    echo $_POST['txtnacionalidad']." - ";
	$sql="insert into tbl_cliente values('0','".$_POST["txtid"]."','".$_POST["txtnombre1"]."','".$_POST["txtnombre2"]."','".$_POST["txtapellido1"]."','".$_POST["txtapellido2"]."','".$_POST["cmbgenero"]."','".$_POST["fechan"]."','".$_POST["txtnacionalidad"]."','".$_POST["txtdir"]."','".$_POST["txtdepto"]."','".$_POST["txtmuni"]."','".$_POST["txttelefono"]."','".$_POST["txtcelular"]."','".$_POST["cmbafiliacion"]."', (select CURRENT_TIMESTAMP()) );";
	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Informacion Guardada Exitosamente!');</script>";
        echo "<script>window.open('buscar_clientes.php','_self');</script>";
	}
	else{
		echo "Error no se puede ejecutar ".$sql." Error ".mysqli_error($conexion);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<!--<meta charset="utf-8">-->
	<title>Formulario Ingresar Cliente</title>
	
	<link rel="stylesheet" href="css/style-general.css">
<!-- Librerias para Funcionalidades-->

<script type="text/javascript">
	function validar(){
		if(document.getElementById("txtid").value==""){
			alert("Favor Ingresar el Numero de Identidad del Cliente");
			document.getElementById("txtid").focus();	
		}
		else if(document.getElementById("txtnombre1").value==""){
			alert("Favor Ingresar el Primer Nombre del Cliente");
			document.getElementById("txtnombre1").focus();	
		}
		else if(document.getElementById("txtnombre2").value==""){
			alert("Favor Ingresar el Segundo Nombre del Cliente");
			document.getElementById("txtnombre2").focus();	
		}
		else if(document.getElementById("txtapellido1").value==""){
			alert("Favor Ingresar el Primer Apellido del Cliente");
			document.getElementById("txtapellido1").focus();	
		}
		else if(document.getElementById("txtapellido2").value==""){
			alert("Favor Ingresar el Segundo Apellido del Cliente");
			document.getElementById("txtapellido2").focus();	
		}
		else if(document.getElementById("fechan").value=="0-0-0"){
			alert("Favor Ingresar la Fecha Nacimiento del Cliente");
			document.getElementById("fechan").focus();	
		}
		else if(document.getElementById("txtnacionalidad").value==""){
			alert("Favor Ingresar la Nacionalidad del Cliente");
			document.getElementById("txtnacionalidad").focus();	
		}
		else if(document.getElementById("txtdir").value==""){
			alert("Favor Ingresar la Direccion del Cliente");
			document.getElementById("txtdir").focus();	
		}
		else if(document.getElementById("txtdepto").value==""){
			alert("Favor Ingresar el Departamento del Cliente");
			document.getElementById("txtdepto").focus();	
		}
		else if(document.getElementById("txtmuni").value==""){
			alert("Favor Ingresar la Municipalidad del Cliente");
			document.getElementById("txtmuni").focus();	
		}
		else if(document.getElementById("txttelefono").value==""){
			alert("Favor Ingresar el Telefono del Cliente");
			document.getElementById("txttelefono").focus();	
		}
		else if(document.getElementById("txtcelular").value==""){
			alert("Favor Ingresar el Celular del Cliente");
			document.getElementById("txtcelular").focus();	
		}

//----------
		
		else{
			document.getElementById("accion").value="guardar";
			return true;
		}
		return false;
		//break; return ;
	}
</script>
</head>

<body>
	
	<div align='center'><h2>Formulario para Ingresar Clientes</h2>

	</div>

	<form name='formulario' id='formulario' method="POST" action='form_clientes.php'>
	<div id="main-content">
	<input type="hidden" name="accion" id="accion" value="">

		<fieldset>
			<label>Numero de Identificacion</label>
			<input type="text" name="txtid" id="txtid" value="" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Primer Nombre</label>
			<input type="text" name="txtnombre1" id="txtnombre1" value="" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Segundo Nombre</label>
			<input type="text" name="txtnombre2" id="txtnombre2" value="" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Primer Apellido</label>
			<input type="text" name="txtapellido1" id="txtapellido1" value="" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Segundo Apellido</label>
			<input type="text" name="txtapellido2" id="txtapellido2" value="" maxlength="45">
		</fieldset>

		<!--Genero (ComboBox)-->
		<fieldset>
			<label>Genero</label>
			<select name='cmbgenero' id='cmbgenero'>
				<option value='masculino'>MASCULINO</option>
				<option value='femenino'>FEMENINO</option>
			</select>
		</fieldset>

		<!--Fecha de Nacimiento (Date)-->
		<fieldset>
			<label>Fecha de Nacimiento</label>
			<input type="date" name="fechan" id="fechan" value="">
		</fieldset>

		<fieldset>
			<label>Nacionalidad</label>
			<input type="text" name="txtnacionalidad" id="txtnacionalidad" value="" maxlength="20">
		</fieldset>
		
		<!--Observaciones (TextArea)-->
		<fieldset>
			<label for="txtdir">Direccion</label><br>
			<textarea name='txtdir' id='txtdir' value="" rows="2" cols="50"></textarea>
		</fieldset>

		<fieldset>
			<label>Departamento</label>
			<input type="text" name="txtdepto" id="txtdepto" value="" maxlength="140">
		</fieldset>


		<fieldset>
			<label>Municipio</label>
			<input type="text" name="txtmuni" id="txtmuni" value="" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Telefono</label>
			<input type="text" name="txttelefono" id="txttelefono" value="" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Celular</label>
			<input type="text" name="txtcelular" id="txtcelular" value="" maxlength="45">
		</fieldset>


		<fieldset>
			<label>Afiliado</label>
			<select name='cmbafiliacion' id='cmbafiliacion'>
				<option value='no'>NO</option>
				<option value='si'>SI</option>
			</select>
		</fieldset>				

		<fieldset align="center">
		<button name='btnguardar' onClick="return validar();">Guardar</button>
		</fieldset>

	</form>
</div>
</body>
</html>