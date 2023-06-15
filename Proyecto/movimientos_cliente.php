<?php 
session_start();
include("conexion.php");


?>
<!DOCTYPE html>
<html>
<head>
	<title>Reportes de Clientes</title>

	
<!--Librerias para Imprimir PDF-->
	<script src="jspdf/dist/html2canvas.js"></script>
	<script src="jspdf/dist/jspdf.min.js"></script>

	<script type="text/javascript">

		function print(){
			var win = window.open('', 'print', 'height=720,width=600');
			win.document.write(document.getElementById("tabla").innerHTML);
			win.document.close(); 
			win.focus();
			win.print(); 
		}

	</script>

</head>
<body>
	<br>


<div id='tabla' width="80%">
<br>
<br>
	<button onClick='print()'>Imprimir</button>


	<table id="table_id" border="0" >
		<thead>
				<tr>
					<td colspan=3 align='center'><h2>Movimientos de Cliente</h2></td>
				</tr>
			</thead>
		<?php
		$nombre="";
		$cedula="";
 $sql1="select 
cliente_id,
concat(cliente_nombre1,' ',cliente_nombre2,' ',cliente_apellido1,' ',cliente_apellido2) as nombrec
 FROM tbl_cliente where cliente_id='".$_GET['update_id']."';";
//.$_SESSION["numerofa"]
$result1=mysqli_query($conexion,$sql1);
while($row=mysqli_fetch_assoc($result1))
{
	$nombre=$row["nombrec"];
	$cedula=$row["cliente_id"];
}
?>
	<tr>
        <td><b>Cliente:</b></td>
        <td colspan=2 align='center' ><b>
            <?php echo $nombre; ?></b> 
        </td>
			
		</tr>
        <tr>
			<td><b>ID:</b></td>
			<td colspan=2><b>
                <?php echo $cedula; ?></b>
            </td>
		</tr>
		<tr>
			<td colspan=1>No. de factura</td>
			<td colspan=2 align=center>Fecha</td>
			<td colspan=1 align=center>SubTotal</td>
            <td colspan=2>&nbsp</td>
            <td colspan=3 align=center>ISV</td>
            <td colspan=2>&nbsp</td>
			<td colspan=3 align=center>Total</td>
            <td colspan=2>&nbsp</td>
		</tr>
<?php
	$sql="select
order_id,
order_date,
order_total_before_tax,
order_total_tax,
order_total_after_tax 
FROM factura_orden where cliente_id='".$_GET['update_id']."' and factura_estado='PAGADO';";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result)){
	echo "
		<tr>
			<td colspan=1 >".$row["order_id"]."</td>
			<td colspan=2 align=center>".$row["order_date"]."</td>
			<td colspan=1 align=center>".$row["order_total_before_tax"]."</td>
            <td colspan=2>&nbsp</td>
            <td colspan=3 align=right>".$row["order_total_tax"]."</td>
            <td colspan=2>&nbsp</td>
			<td colspan=4 align=right>".$row["order_total_after_tax"]."</td>
            <td colspan=2>&nbsp</td>
		</tr>
		";
        $totalfac=$row["order_total_after_tax"];
        $total=+$totalfac;
}
/*echo "
		<tr>
			<td colspan=2 ></td>
			<td colspan=2 align=center></td>
			<td colspan=5 align=center></td>
			<td colspan=5 align=center>".$total."</td>
		</tr>
		";*/
?>
</table>
</div>
</div>
</body>
<script type="text/javascript">
	
	function showboletos() {
			
			
			document.getElementById('container').style.display = 'block';
			document.getElementById('btnbus').style.display = 'none';
			//document.getElementById("accion").value="modificar";
		}

</script>
<style type="text/css">
	button {
		display: inline-block;
	}
</style>
</html>