<?php 
session_start();
include("conexion.php");
$x=0;
$x2=0;

// Obteniendo la fecha actual del sistema con PHP
$fechaActual =date("Y-m-d");
   
//echo $fechaActual;
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cierre de Caja</title>

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

</head>
<body>
<button onClick='print()'>Imprimir</button>
<div id='tabla' width="80%">
	<table id="table_id" border="0">
		<thead>
				<tr>
					<td colspan=3 align='center'><h2>Cierre de caja</h2></td>
				</tr>
			</thead>
 
		<tr>
			<td align='center'><b>Usuario:</b></td>
			<td colspan=2 ><b><?php echo $_GET['invoice_id']; ?></b></td>
		</tr>

        
        <tr><td>&nbsp</td></tr>

        <tr>
			<td><b>Metodo Pago:</b></td>
			<td colspan=2><b>EFECTIVO</b></td>
		</tr>

        <tr>
			<td><b>Fecha de Cierre:</b></td>
			<td colspan=2><?php echo $fechaActual; ?></td>
		</tr>

		<tr>
<?php
$sql="select
order_total_before_tax,
order_total_tax,
order_total_after_tax,
factura_tipopago
FROM factura_orden where factura_tipopago='Efectivo' and factura_estado='PAGADO' and usuario_cobrar='".$_GET['invoice_id']."';";
$result=mysqli_query($conexion,$sql);
$totalsubtotal=0;
$totalimpuesto=0;
$totaltotal=0;
while($row=mysqli_fetch_assoc($result)){
    $x++;
    $subtotal=$row["order_total_before_tax"];
    $totalsubtotal=$totalsubtotal+$subtotal;

    $impuesto=$row["order_total_tax"];
	$totalimpuesto=$totalimpuesto+$impuesto;
    
    $total=$row["order_total_after_tax"];
    $totaltotal=$totaltotal+$total;
	
    $pago=$row["factura_pago"];
}
		?>
        <tr>
			<td><b>Cantidad de facturas:</b></td>
			<td colspan=2 align='right'><?php echo $x ; ?></td>
		</tr>
        <tr>
			<td><b>SubTotal total:</b></td>
			<td colspan=2 align='right'><?php echo $totalsubtotal; ?></td>
		</tr>
		<tr>
			<td><b>Impuesto total:</b></td>
			<td colspan=2 align='right'><?php echo $totalimpuesto; ?></td>
		</tr>
		<tr>
			<td><b>Total:</b></td>
			<td colspan=2 align='right'><b><?php echo $totaltotal; ?></b></td>
		</tr>

        <!--**********************Hacer Espacios Vacios*************************-->
        <tr><td>&nbsp</td></tr>
        <tr><td>&nbsp</td></tr>

        <!--**********************TARJETA*************************-->
        <tr>
			<td><b>Metodo Pago:</b></td>
			<td colspan=2><b>TARJETA</b></td>
		</tr>

        <tr>
			<td><b>Fecha de Cierre:</b></td>
			<td colspan=2><?php echo $fechaActual; ?></td>
		</tr>

		<tr>
<?php
$sql2="select
order_total_before_tax,
order_total_tax,
order_total_after_tax,
factura_tipopago
FROM factura_orden where factura_tipopago='Tarjeta' and factura_estado='PAGADO' and usuario_cobrar='".$_GET['invoice_id']."';";
$result2=mysqli_query($conexion,$sql2);

$totalsubtotal2=0;
$totalimpuesto2=0;
$totaltotal2=0;

while($row2=mysqli_fetch_assoc($result2)){
    $x2++;
    $subtotal2=$row2["order_total_before_tax"];
    $totalsubtotal2=$totalsubtotal2+$subtotal2;

    $impuesto2=$row2["order_total_tax"];
	$totalimpuesto2=$totalimpuesto2+$impuesto2;
    
    $total2=$row2["order_total_after_tax"];
    $totaltotal2=$totaltotal2+$total2;
	
    $pago2=$row2["factura_pago"];
}
		?>
        <tr>
			<td><b>Cantidad de facturas:</b></td>
			<td colspan=2 align='right'><?php echo $x2; ?></td>
		</tr>
        <tr>
			<td><b>SubTotal total:</b></td>
			<td colspan=2 align='right'><?php echo $totalsubtotal2; ?></td>
		</tr>
		<tr>
			<td><b>Impuesto total:</b></td>
			<td colspan=2 align='right'><?php echo $totalimpuesto2; ?></td>
		</tr>
		<tr>
			<td><b>Total:</b></td>
			<td colspan=2 align='right'><b><?php echo $totaltotal2; ?></b></td>
		</tr>

</div>
</body>
</html>