<?php 
/*session_start();
include("conexion.php");*/
include("menu.php");
include("menu_facturas.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}
else {
    
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de Facturas</title>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="js/invoice.js"></script>
    <link rel="stylesheet" href="css/fac.css">

</head>
<body>

    <div class="container">
        <!--<a href="main.php"><img src="img/home.png"/></a>-->
        <h2 class="title">Lista de Facturas </h2> 
        
        <!--*******************Probando********************-->
        <input id='myInput' onkeyup='searchTable()' type='text' placeholder="Search">
        <!--*************************************************-->

        <table id="data-table" class="table table-condensed table-striped">
            <thead>
            <tr>
                <th width="6%">Fac. No.</th>
                <th width="15%">Fecha Creacion</th>     
                <th width="25%">Cliente</th>
                <th width="25%">Nota</th>
                <th width="8%">Factura Total</th>
                <th width="9%">Factura Estado</th>
                <th width="3%"></th>
                <th width="3%"></th>
            </tr>
            </thead>
        <?php		
                $sql="select 
                * 
                from factura_orden ";//SQL que van a modificar
                $result=mysqli_query($conexion,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    $invoiceDate = date("d/M/Y, H:i:s", strtotime($row["order_date"]));
                    echo '
                    <tr>
                        <td>'.$row["order_id"].'</td>

                        <td>'.$invoiceDate.'</td>

                        <td>'.$row["order_receiver_name"].'</td>

                        <td>'.$row["note"].'</td>

                        <td>'.$row["order_total_after_tax"].'</td>

                        <td>'.$row["factura_estado"].'</td>

                        <td><a href="print_invoice.php?invoice_id='.$row["order_id"].'" title="Imprimir Factura"><div class="btn btn-primary"><span><i><img src="img/print.png"/></i></span></div></a></td>';
if($_SESSION["M6-2"]==1){
                        if(($row["factura_estado"])!='PAGADO'){
                            echo '<td><a href="modificar_factura.php?update_id='.$row["order_id"].'"  TARGET="_self" title="Pagar Factura"><div class="btn btn-primary"><span><i><img src="img/pay.png"/></i></span></div></a></td>';
                        }
}
                    echo '</tr>';
                }
        ?>

        <!--*****************Boton Eliminar******************
            <td><a href="#" id="'.$row["order_id"].'" class="deleteInvoice"  title="Borrar Factura"><div class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></div></a></td>-->

        </table>
        <!--*****************************************-->
        <script>
            function searchTable() {
                var input, filter, found, table, tr, td, i, j;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("data-table");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td");
                    for (j = 0; j < td.length; j++) {
                        if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                        }
                    }
                    if (found) {
                        tr[i].style.display = "";
                        found = false;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        </script>
        <!--******************************************-->
</div>	

</body>
</html>