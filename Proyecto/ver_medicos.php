<?php 
include("conexion.php");

include("menu.php");
//include("menu_emp.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vista de Medicos</title>

<!--Incorporacion de Datatable en PHP-->
<script src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style-general.css">
<!--<link rel="stylesheet" href="Datatables/datatables.css"> -->

<script type="text/javascript" charset="utf8" src="Datatables/datatables.js"></script>
<script type="text/javascript" language="javascript" src="Datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="Datatables/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="Datatables/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="Datatables/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="Datatables/buttons.html5.min.js"></script>

<script type="text/javascript">
$(document).ready( function () 
{
	$('#tabla').dataTable( 
    {
    			"aaSorting": [],
    			dom: 'Bfrtip',
    			"pageLength": 20,
    			buttons: [
            'copyHtml5',
            'excelHtml5',
            /*'csvHtml5',*/
            'pdfHtml5'],
      			"rowCallback": function( row, data, index ) 
      			{   
          $('td', row).css('font', '12px Arial, sans-serif');//Tamano de Letras y Fuente
          $('td', row).css('font-weight', 'bold');//Negrita
          $('td', row).css('background-color', '#A9F5BC');//Color del Fondo (Background)
          $('td', row).css('color', '#151515');//Color de Letras (Foreground)

          			if ( data[6] != "activo" )//Sombrear algo en especifico de acuerdo a la columna
        			{
        				$('td', row).css('background-color', '#EC7063');//Color del Fondo
          				$('td', row).css('color', 'black');//Color de Letras
        			}
      			}
    		});
 });
    </script>
	<!------------------------------------->



</head>
<body>

<div id="main-content">

<div align="center"><h1><b>Listado de Medicos</b></h1></div>

<form name='formulario' id='formulario'>

	<table id='tabla' border="0" width="100%">
		<thead>
			<th>#</th>
			<th>Cedula</th>
			<th>Nombre</th>
			<th>Genero</th>
			<th>Email</th>
			<th>Telefono</th>
			<th>Estado</th>
		</thead>
		<tbody>
			<?php 
			$x=0;
			$sql="select *,
            concat(empleado_nombre,' ',empleado_apellido1,' ',empleado_apellido2)as nombrec 
            from tbl_empleado where empleado_tipoempleado='Doctor' or empleado_tipoempleado='Enfermero';";//SQL que van a modificar
			$result=mysqli_query($conexion,$sql);
			while($row=mysqli_fetch_assoc($result))
			{
				/*echo "<script>alert('".$row["empleado_cedula"]."');</script>";*/
				$x++;
				echo 
				"<tr align='center'>
					<td>".$x."</td>
					<td>".$row["empleado_cedula"]."</td>
					<td>".$row["nombrec"]."</td>
					<td>".$row["empleado_genero"]."</td>
					<td>".$row["empleado_email"]."</td>
					<td>".$row["empleado_celular"]."</td>
					<td>".$row["empleado_estado"]."</td>
				</tr>";
			}
			?>
		</tbody>
	</table>
</form>

</div>

</body>
</html>