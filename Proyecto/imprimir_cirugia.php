<?php 
session_start();
include("conexion.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Operacion Medica</title>

<!--Librerias para Imprimir PDF-->
	<script src="jspdf/dist/html2canvas.js"></script>
	<script src="jspdf/dist/jspdf.min.js"></script>

    <script type="text/javascript">
		function print()
		{
			var win = window.open('', 'print', 'height=800,width=600');
			win.document.write(document.getElementById("tabla").innerHTML);
			win.document.close(); 
			win.focus();
			win.print(); 
		}
	</script>

</head>
<body>

<button onClick='print();'>Imprimir</button>

	<div id="tabla" width="80%">
		<table id="tabla_id" border="0">
		<tr align="center">
			<td colspan=4><h2><b>Operacion Medica</b></h2></td>
		</tr>
<?php
$sql="select * 
FROM tbl_cirugia cir
inner join tbl_cita c on c.cita_codigo=cir.cita_codigo
where c.cita_codigo='".$_GET['update_id']."'";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result)){
	echo "
	<tr>
        <td align='left'><b>Codigo Lab. :</b></td>
		<td colspan=1 >".$row["cirugia_codigo"]."</td>

        <td><b>Nombre Cliente:</b></td>
		<td>".$row["cita_cliente_nombre"]."</td>

	</tr>";

		echo "
	<tr>
		<td align='center'><b>Fecha Realizada:</b></td>
		<td colspan=2>".$row["fecha_realizada"]."</td>
	</tr>";
    $dr=$row["doctor_nombre"];
    $servicio=$row["cita_servicio"];
    $nota=$row["cirugia_nota"];
    $resultado=$row["cirugia_resultado"];
}
?>
	
    <tr>
        <td><b>Servicio:</b></td>
        <td colspan='3'><?php echo $servicio;?></td>
    </tr>
    <tr><td>&nbsp</td></tr>
	<tr>
		<td><b>Resultado:</b></td>
        <td colspan=2><?php echo $resultado;?></td>
		
	</tr>
<?php 
$sql="select * 
FROM tbl_laboratorio lab
inner join tbl_cita c on c.cita_codigo=lab.cita_codigo
where c.cita_codigo='".$_GET['update_id']."'";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
{
	echo 
	"<tr>
		
        <td><b></b></td>
		<td></td>
		<td></td>
	</tr>";
}
?>
    <tr><td>&nbsp</td></tr>
    <tr>
        <td><b>Nota:</b></td>
	<tr>
        <tr><td colspan='5'><?php echo $nota;?></td></tr>
        <tr><td>&nbsp</td></tr>
    <tr>
        <td>&nbsp</td>
		<td  align='center'><b>Doctor</b>:</td>
		<td colspan=3 align='center'><?php echo $dr;?></td>
        
	<tr>

	</table>
	</div>

<?php 
//Mostrar la Impresion del Navegador.
//echo "<script>print();</script>";
?>

</body>
</html>