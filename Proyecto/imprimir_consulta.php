<?php 
session_start();
include("conexion.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Impresion Consulta</title>

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
			<td colspan=4><h2><b>Consulta Medica</b></h2></td>
		</tr>
<?php
$sql="select * 
FROM tbl_consultas con
inner join tbl_cita c on c.cita_codigo=con.cita_codigo
where c.cita_codigo='".$_GET['update_id']."'";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result)){
	echo "
	<tr>
        <td align='right'><b>Codigo Consulta:</b></td>
		<td colspan=1 >".$row["consultas_codigo"]."</td>

        <td><b>Nombre Cliente:</b></td>
		<td>".$row["cita_cliente_nombre"]."</td>

	</tr>";

		echo "
	<tr>
		<td align='center'><b>Fecha Atendida:</b></td>
		<td colspan=2>".$row["fecha_atendida"]."</td>
	</tr>";
    $dr=$row["doctor_nombre"];
    $servicio=$row["cita_servicio"];
    $nota=$row["consulta_nota"];
}
?>
	
    <tr>
        <td><b>Consulta:</b></td>
        <td colspan='3'><?php echo $servicio;?></td>
    </tr>
    <tr><td>&nbsp</td></tr>
	<tr>
		<td><b>Diagnostico:</b></td>
        <td><b></b></td>
		<td><b></b></td>
		<td><b></b></td>
	</tr>
<?php 
$sql="select * 
FROM tbl_consultas con
inner join tbl_cita c on c.cita_codigo=con.cita_codigo
where con.cita_codigo='".$_GET['update_id']."'";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
{
	echo 
	"<tr>
		<td colspan=5>".$row["consulta_diagnostico"]."</td>
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