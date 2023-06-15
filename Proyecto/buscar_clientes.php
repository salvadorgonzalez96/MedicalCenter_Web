<?php 
/*session_start();
include("conexion.php");*/
include("menu.php");
include("menu_clientes.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}
else {
    $sql="select
m.modulo_codigo,
ifnull(a.acceso_estado,'inactivo') as estado
from tbl_modulo m
left outer join tbl_acceso a on a.modulo_codigo=m.modulo_codigo and a.usuario_usuario='".$_SESSION['sesuser']."';";
$result=mysqli_query($conexion,$sql);
while ($row=mysqli_fetch_assoc($result)){
	$modulo="M".$row["modulo_codigo"];
	$acceso=($row["estado"]=="activo"?true:false);
	$_SESSION[$modulo]=$acceso;
}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de Clientes</title>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="js/invoice.js"></script>
    <link rel="stylesheet" href="css/fac.css">

</head>
<body>

    <div class="container">
        <!--<a href="main.php"><img src="img/home.png"/></a>-->
        <h2 class="title">Lista de Clientes </h2> 
        
        <!--*********BUSCAR EN LA TABLA *********-->
        <input id='myInput' onkeyup='searchTable()' type='text' placeholder="Search">
        <!--*************************************************-->

        <table id="data-table" class="table table-condensed table-striped">
            <thead>
            <tr>
                <th width="10%">No. ID</th>
                <th width="25%">Nombre Cliente</th>     
                <th width="8%">Genero</th>
                <th width="10%">No. Celular</th>
                <th width="5%">Afiliado</th>
                <th width="8%">Fecha Ingreso</th>
                <th width="3%"></th>
                <th width="3%"></th>
            </tr>
            </thead>
        <?php
                $sql="select *, 
                        concat(cliente_nombre1,' ',cliente_nombre2,' ',cliente_apellido1,' ',cliente_apellido2)as nombrec 
                        FROM tbl_cliente;";//SQL que van a modificar
                $result=mysqli_query($conexion,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    $invoiceDate = date("d/M/Y", strtotime($row["cliente_fechamatricula"]));
                    echo '
                    <tr>
                        <td>'.$row["cliente_id"].'</td>
                        <td>'.$row["nombrec"].'</td>
                        <td>'.$row["cliente_genero"].'</td>
                        <td>'.$row["cliente_celular"].'</td>
                        <td>'.$row["cliente_afiliado"].'</td>
                        <td>'.$invoiceDate.'</td>';
if($_SESSION["M2-2"]==1){
    echo '
                        <td><a href="modificar_cliente.php?update_id='.$row["cliente_codigo"].'"  TARGET="_self" title="Modificar Cliente"><div class="btn btn-primary"><span><i><img src="img/refresh.png"/></i></span></div></a></td>';
}
echo '
                        <td><a href="movimientos_cliente.php?update_id='.$row["cliente_id"].'" TARGET="_blank"  title="Reporte de Movimientos"><div class="btn btn-primary"><span><i><img src="img/report.png"/></i></span></div></a></td>';
                        
                }
        ?>
        </table>

        <!--******************BUSQUEDA EN LA TABLA***********************-->
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