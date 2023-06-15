<?php 
session_start();
include("conexion.php");
//$_GET['invoice_id']
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Impresion para Factura</title>

<!--Librerias para Imprimir PDF-->
<script src="jspdf/dist/html2canvas.js"></script>
<script src="jspdf/dist/jspdf.min.js"></script>

	<script type="text/javascript">
		function print()
		{
			var win = window.open('', 'print', 'height=720,width=600');
			win.document.write(document.getElementById("tabla").innerHTML);
			win.document.close(); 
			win.focus();
			win.print(); 
		}
	</script>

<!-------------------------------->
</head>
<body>

<button onClick='print();'>Imprimir</button>

	<div id="tabla" width="80%">
		<table id="tabla_id" border="0">
		<tr align="center">
			<td colspan=3><font size=3><b>FACTURA</b></font></td>
		</tr>
<?php
$sql="select * FROM factura_orden where order_id='".$_GET['invoice_id']."';";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
{
	echo "
	<tr>
		<td><b>No. Fact:</b></td>
		<td colspan=2>".$row["order_id"]."</td>
	</tr>";

	echo "
	<tr>
		<td><b>TIPO DE PAGO:</b></td>
		<td colspan=2>".$row["factura_tipopago"]."</td>
	</tr>";

		echo "
	<tr>
		<td><b>FECHA:</b></td>
		<td colspan=2>".$row["order_date"]."</td>
	</tr>";

	echo "
	<tr>
		<td><b>USUARIO:</b></td>
		<td colspan=2>".$row["user_id"]."</td>
	</tr>";

	$subtotal=$row["order_total_before_tax"];
	$impuesto=$row["order_total_tax"];
	$total=$row["order_total_after_tax"];
	$pago=$row["order_amount_paid"];
	$cambio=$row["order_total_amount_due"];
}
?>
	<tr>
	</tr>
	<tr>
		<td><b>Cantidad</b></td>
		<td><b>Descripcion</b></td>
		<td><b>Total</b></td>
	</tr>
<?php 
$sql="select * FROM factura_orden_producto where order_id='".$_GET['invoice_id']."';";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
{
	echo 
	"<tr>
		<td>".$row["order_item_quantity"]."</td>
		<td>".$row["item_name"]."</td>
		<td align='right'>".$row["order_item_final_amount"]."</td>
	</tr>";
}
?>

    <tr><td>&nbsp</td></tr>

	<tr>
		<td colspan=2 align='right'>Subtotal</td>
		<td colspan=2 align='right'><?php echo number_format($subtotal,2);?></td>
	<tr>

		<tr>
		<td colspan=2 align='right'>Impuesto</td>
		<td colspan=2 align='right'><?php echo number_format($impuesto,2);?></td>
	<tr>

		<tr>
		<td colspan=2 align='right'>Total</td>
		<td colspan=2 align='right'><?php echo number_format($total,2);?></td>
	<tr>

		<tr>
		<td colspan=2 align='right'>Pago</td>
		<td colspan=2 align='right'><?php echo number_format($pago,2);?></td>
	<tr>

		<tr>
		<td colspan=2 align='right'>Cambio</td>
		<td colspan=2 align='right'><?php echo number_format($cambio,2);?></td>
	<tr>

	</table>
	</div>

<?php 
//Mostrar la Impresion del Navegador.
//echo "<script>print();</script>";
?>

</body>
</html>