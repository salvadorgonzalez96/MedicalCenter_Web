<?php 
session_start();
include("conexion.php");

/*******************Recibe el id de la factura************************* */
if(!empty( $_GET['update_id']) && $_GET['update_id'] ) {
	$sqlQuery = "select * 
                        FROM tbl_receta 
			            WHERE receta_codigo = '".$_GET['update_id']."'";
		$result = mysqli_query($conexion, $sqlQuery);	
		$row = mysqli_fetch_assoc($result);
        $invoiceValues=$row;
    //$invoiceValues = $invoice->getInvoice($_GET['update_id']);		

	$sqlQuery2 = "
			SELECT * FROM tbl_receta_medicamento 
			WHERE receta_codigo = '".$_GET['update_id']."'";
    $result2 = mysqli_query($conexion, $sqlQuery2);
		if(!$result2){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row2 = mysqli_fetch_assoc($result2)) {
			$data[]=$row2;
		}
        $invoiceItems=$data;
    //$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);		

}
/********************************************************************** */
?>
<!DOCTYPE html>
<html>
<head>
	<title>Impresion Receta</title>

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
			<td colspan=4><h2><b>Receta Medica</b></h2></td>
		</tr>
<?php
$sql="select * 
            FROM tbl_receta 
			WHERE receta_codigo = '".$_GET['update_id']."'";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
{
	echo "
	<tr>

        <td><b>Nombre Cliente:</b></td>
		<td>".$row["receta_cliente"]."</td>

        <td align='right'><b>Edad:</b></td>
		<td colspan=1 >".$row["receta_edad"]."</td>
	</tr>";

		echo "
	<tr>
		<td align='center'><b>Fecha:</b></td>
		<td colspan=2>".$row["receta_fecha"]."</td>
	</tr>";


}
?>
	<tr><td>&nbsp</td></tr>
	<tr>
		<td><b>Medicamento</b></td>
        <td><b></b></td>
		<td><b>Dosis</b></td>
		<td><b>Unidad</b></td>
	</tr>
<?php 
$sql="
			SELECT * FROM tbl_receta_medicamento 
			WHERE receta_codigo = '".$_GET['update_id']."'";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
{
	echo 
	"<tr>
		<td>".$row["receta_medicamento"]."</td>
        <td><b></b></td>
		<td>".$row["receta_dosis"]."</td>
		<td>".$row["receta_unidad"]."</td>
	</tr>";
}
?>
    <tr><td>&nbsp</td></tr>
    <tr>
        <td align='center'><b>Nota:</b></td>
        <td colspan=3><?php echo $invoiceValues["receta_nota"]?></td>
	<tr>

        <tr><td>&nbsp</td></tr>

    <tr>
        <td>&nbsp</td>
		<td  align='center'><b>Doctor</b>:</td>
		<td colspan=3 align='center'><?php echo $invoiceValues["doctor_nombre"];?></td>
        
	<tr>

	</table>
	</div>

<?php 
//Mostrar la Impresion del Navegador.
//echo "<script>print();</script>";
?>

</body>
</html>