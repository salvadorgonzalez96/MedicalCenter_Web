<?php 
include("menu.php");

include("menu_emp.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

$valor="2021-08-30";
$minn="2021-01-01";
$maxx="2021-12-31";
$maxn="2003-12-31";

include("conexion.php");

$sql="select curdate()as hoy";
$result=mysqli_query($conexion,$sql);

while($row=mysqli_fetch_assoc($result)){
	$valor=$row["hoy"];
}

//Mostrar todas las variablas enviadas en POST.
/*echo "<br>";
print_r($_POST);
echo "<br>";*/

$rece="";
$nombrebd="";
$ape1bd="";
$ape2bd="";
$cedulabd="";
$direcbd="";
$correoebd="";
$gradoabd="";
$fechai="";
$fechan="";
$estadocbd="";
$areabd="";
$estadobd="";
$telefonobd="";
$celularbd="";

$accion=isset($_POST["accion"])?$_POST["accion"]:"";				//echo "La Accion ".$accion;

if($accion=="guardar"){
	$nombre=mysqli_real_escape_string($conexion,$_REQUEST["txtnombre"]);
	$ape1=mysqli_real_escape_string($conexion,$_REQUEST["txtape1"]);

	$sql="insert into tbl_empleado values('".$_POST["txtcedula"]."','".$nombre."','".$ape1."','".$_POST["txtape2"]."','".$_POST["dfechai"]."','".$_POST["dnac"]."','".$_POST["cmbestadoc"]."','".$_POST["txtobser"]."','".$_POST["txtcorreo"]."','".$_POST["cmbarea"]."','".$_POST["txtgradoa"]."','".$_POST["cmbgenero"]."','".$_POST["cmbestado"]."','".$_POST["txttelefono"]."','".$_POST["txtcelular"]."','0','0')";

	//echo "<br>".$sql;
	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Informacion Guardada Exitosamente!');</script>";
	}
	else{
		echo "Error no se puede ejecutar ".$sql." Error ".mysqli_error($conexion);
	}
}
else if($accion=="llenar"){
	//echo "Vamonos a Llenar desde bD";
	$sql="select *, 
	date_format(empleado_fechai,'%Y-%m-%d')as hoy,
	date_format(empleado_fechan,'%Y-%m-%d')as nac from tbl_empleado where empleado_cedula='".$_POST["cedula"]."'";
	//echo $sql;
	$result=mysqli_query($conexion,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$nombrebd=$row["empleado_nombre"];
		$ape1bd=$row["empleado_apellido1"];
		$ape2bd=$row["empleado_apellido2"];
		$cedulabd=$row["empleado_cedula"];
		$direcbd=$row["empleado_direccion"];;
		$correoebd=$row["empleado_email"];;
		$gradoabd=$row["empleado_gradoaca"];
		$fechai=$row["hoy"];
		$valor=$fechai;
		$fechan=$row["nac"];
		$estadocbd=$row["empleado_estadocivil"];
		$areabd=$row["empleado_tipoempleado"];
		$estadobd=$row["empleado_estado"];
		$telefonobd=$row["empleado_telefono"];
		$celularbd=$row["empleado_celular"];
		$accion="modificar";
		$rece=$row["empleado_cedula"];
	}
}
else if($accion=="modificar"){
	$sql="update tbl_empleado set 
	empleado_cedula='".$_POST["txtcedula"]."', 
	empleado_nombre='".$_POST["txtnombre"]."', 
	empleado_apellido1='".$_POST["txtape1"]."', 
	empleado_apellido2='".$_POST["txtape2"]."',	
	empleado_fechai='".$_POST["dfechai"]."', 
	empleado_fechan='".$_POST["dnac"]."', 
	empleado_estadocivil='".$_POST["cmbestadoc"]."',	
	empleado_direccion='".$_POST["txtobser"]."', 
	empleado_email='".$_POST["txtcorreo"]."', 
	empleado_tipoempleado='".$_POST["cmbarea"]."', 
	empleado_gradoaca='".$_POST["txtgradoa"]."', 
	empleado_genero='".$_POST["cmbgenero"]."', 
	empleado_estado='".$_POST['cmbestado']."', 
	empleado_telefono='".$_POST["txttelefono"]."', 
	empleado_celular='".$_POST["txtcelular"]."' 
	where empleado_cedula='".$_POST['miid']."'";
	$result=mysqli_query($conexion,$sql);
	if($result){
		echo "<script>alert('Se Modifico Satisfactoriamente');</script>";
	}
	else{
		echo "<script>alert('Error al Actualizar');</script>";
	}
}
//echo "La Accion ".$accion;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulario Agregar Empleado</title>

	<link rel="stylesheet" href="css/style-general.css">
<!-- Librerias para Funcionalidades-->
<script src="js/jquery-3.6.0.min.js"></script>

<script type="text/javascript">


	function llenar(cedula){
		//alert("Cedula "+cedula);
		document.getElementById("accion").value="llenar";
		document.getElementById("cedula").value=cedula;
		document.getElementById("miid").value=cedula;
		document.getElementById("formulario").submit();
		//return false;
	}

	function rangoDias(){
		var fing=document.getElementById("dfechai").value;
		var fnac=document.getElementById("dnac").value;
		
		let fechai = new Date(fing);
		let fechan=new Date(fnac);
		let diff=fechan-fechai;
		let diff_dias=Math.floor(diff/(1000*3600*24));
		//alert(diff_dias);
		return diff_dias;
	}

//Solucion para problema de ajax**************
	function consultaCedula(cedula){
		//alert(cedula);
		var cedula=document.getElementById("txtcedula").value;
//================================================
		$.ajax({
				type: 'POST',
				url: 'consulta.php',
				data: {codigo:cedula},
				dataType: 'html'
			})
			.done(function(respuesta) {
				document.getElementById("verif").value=respuesta;
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

	function validar(){					//alert("Voy a validar");

		var d=rangoDias();

		var stop="NO";

		//alert("Numero de Dias entre las dos fechas "+d);
		if(document.getElementById("verif").value=="SI"){
			alert("La Cedula del Empleado ya existe");
			stop="SI";
			document.getElementById("txtcedula").focus();	
		}

		if(document.getElementById("txtcedula").value==""){
			alert("Favor Ingresar el Numero de Cedula del Empleado");
			document.getElementById("txtcedula").focus();	
		}
		else if(document.getElementById("txtnombre").value==""){
			alert("Favor Ingresar el Nombre del Empleado");
			document.getElementById("txtnombre").focus();	
		}
		else if(document.getElementById("txtape1").value==""){
			alert("Favor Ingresar el Primer Apellido del Empleado");
			document.getElementById("txtape1").focus();	
		}
		else if(document.getElementById("txtape2").value==""){
			alert("Favor Ingresar el Segundo Apellido del Empleado");
			document.getElementById("txtape2").focus();	
		}
		else if(document.getElementById("txtobser").value==""){
			alert("Favor Ingresar la Direccion del Empleado");
			document.getElementById("txtobser").focus();	
		}
		else if(document.getElementById("txtcorreo").value==""){
			alert("Favor Ingresar el Correo del Empleado");
			document.getElementById("txtcorreo").focus();	
		}
		else if(document.getElementById("txtgradoa").value==""){
			alert("Favor Ingresar el Grado Academico del Empleado");
			document.getElementById("txtgradoa").focus();	
		}
		else if(document.getElementById("txttelefono").value==""){
			alert("Favor Ingresar el Telefono del Empleado");
			document.getElementById("txttelefono").focus();
		}
		else if(document.getElementById("txtcelular").value==""){
			alert("Favor Ingresar el Celular del Empleado");
			document.getElementById("txtcelular").focus();	
		}
		
//-----------------------------------------------------------------
		else{
			if(document.getElementById("accion").value==""){
				//alert("Guardar en BD");
				document.getElementById("accion").value="guardar";
			}
			else if(document.getElementById("accion").value=="modificar"){
				if(stop=="SI"){
					return false;
				}
				else if(stop=="NO"){
					return true;
				}
				//alert("modificar en BD");
			}
			//alert("Guardar en BD");
			//document.getElementById("accion").value="guardar";
			return true;
		}
		return false;
		//break; return ;
	}
</script>


</head>

<body>

	<div align='center'><h2>Formulario para Mantenimiento de Empleado</h2>

	</div>
<!--******************************************************************-->
	<form name='formulario' id='formulario' method="POST" action='form_empleado.php'>
	<input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>">
	<input type="hidden" name="cedula" id="cedula" value="">


<!-- Como solucionamos el problema de ajax -->
<input type="hidden" name="verif" id="verif" value="<?php echo $accion;?>">
<input type="hidden" name="miid" id="miid" value="<?php echo $rece;?>">
<!-- ===================================== -->

	<div id="main-content" align="center">

		<fieldset>
			<label>Nombres del Empleado</label>
			<input type="text" name="txtnombre" id="txtnombre" value="<?php echo $nombrebd; ?>" maxlength="45" placeholder='Ingrese el nombre o los nombres del empleado'>
		</fieldset>

		<fieldset>
			<label>Primer Apellido Empleado</label>
			<input type="text" name="txtape1" id="txtape1" value="<?php echo $ape1bd;?>" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Segundo Apellido Empleado</label>
			<input type="text" name="txtape2" id="txtape2" value="<?php echo $ape2bd;?>" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Cedula Empleado</label>
			<input type="text" name="txtcedula" id="txtcedula" value="<?php echo $cedulabd; ?>" maxlength="45" onBlur="return consultaCedula();">
		</fieldset>

		<!--Fecha de Ingreso (Date)-->

		<fieldset>
			<label>Fecha de Ingreso</label>
			<input type="date" name="dfechai" id="dfechai" value="<?php echo $valor; ?>" min="<?php echo $minn; ?>" max="<?php echo $valor; ?>">
		</fieldset>

		<!--Fecha de Nacimiento (Date)-->

		<fieldset>
			<label>Fecha de Nacimiento</label>
			<input type="date" name="dnac" id="dnac" value="<?php echo $fechan; ?>" max="<?php echo $maxn; ?>">
		</fieldset>

		<!--Estado Civil (ComboBox)-->
		<fieldset>
			<label>Estado Civil</label>
			<select name='cmbestadoc' id='cmbestadoc'>
				<option value='soltero' <?php echo $a; ?>>SOLTERO</option>
				<option value='casado' <?php echo $b; ?>>CASADO</option>
				<option value='viudo(a)' <?php echo $c; ?>>VIUDO(A)</option>
				<option value='divorciado' <?php echo $d; ?>>DIVORCIADO</option>
			</select>
		</fieldset>

		<!--Observaciones (TextArea)-->

		<fieldset>
			<label for="txtobser">Direccion</label><br>
			<textarea name='txtobser' id='txtobser' value="" rows="2" cols="50"><?php echo $direcbd; ?></textarea>
		</fieldset>


		<fieldset>
			<label>Correo Electronico</label>
			<input type="text" name="txtcorreo" id="txtcorreo" value="<?php echo $correoebd; ?>" size="30" maxlength="140">
		</fieldset>

		<fieldset>
			<label>Area</label>
			<select name='cmbarea' id='cmbarea'>
				<!--<option value='administrativo'>Administrativo</option>
				<option value='docente'>Docente</option>
				<option value='servicio'>Servicio</option>-->
<?php
include("conexion.php");

echo "<option value=''>[SELECCIONE UN AREA]</option>";
$sql="select area_nombre from tbl_area where area_estado='ACTIVO' order by area_nombre";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result)){
	$a=($areabd==$row["area_nombre"]?"selected":"");
	echo "<option value='".$row["area_nombre"]."' ".$a.">".$row["area_nombre"]."</option>";
}
?>
			</select>
		</fieldset>

		<fieldset>
			<label>Grado Academico</label>
			<input type="text" name="txtgradoa" id="txtgradoa" value="<?php echo $gradoabd; ?>" size="25" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Genero</label>
			<select name='cmbgenero' id='cmbgenero'>
				<option value='masculino'>MASCULINO</option>
				<option value='femenino'>FEMENINO</option>
			</select>
		</fieldset>

<?php 
//Setear un value de el ComboBox de forma manual.
$a=($estadobd=="activo")?"selected":"";
$b=($estadobd=="inactivo")?"selected":"";
?>
		<fieldset>
			<label>Estado</label>
			<select name='cmbestado' id='cmbestado'>
				<option value='activo' <?php echo $a; ?>>ACTIVO</option>
				<option value='inactivo' <?php echo $b; ?>>INACTIVO</option>
				<option value='jubilado' <?php echo $c; ?>>JUBILADO</option>
				<option value='suspendido' <?php echo $d; ?>>SUSPENDIDO</option>
				<option value='fallecido' <?php echo $e; ?>>FALLECIDO</option>
			</select>
		</fieldset>				

		<fieldset>
			<label>Telefono Fijo</label>
			<input type="text" name="txttelefono" id="txttelefono" value="<?php echo $telefonobd; ?>" maxlength="45">
		</fieldset>

		<fieldset>
			<label>Celular</label>
			<input type="text" name="txtcelular" id="txtcelular" value="<?php echo $celularbd; ?>" maxlength="45">
		</fieldset>

		<fieldset align="center">
		<button name='btnguardar' onClick="return validar();">Guardar</button>
		</fieldset>

		<!--<input type="submit" name="btnguardar2" value="Guardar">-->
		
		<!--<input type="password" name="txtpassword" id="txtpassword">-->
		
	</div>

	</form>

</body>
</html>

<!--CODIGO MAGICO PARA HACER UN SELECT A BD
$sql="";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
{
}
-->