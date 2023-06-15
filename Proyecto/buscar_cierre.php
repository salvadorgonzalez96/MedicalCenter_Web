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
	<title>Lista de Usuarios Cierre</title>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="js/invoice.js"></script>
    <link rel="stylesheet" href="css/fac.css">

</head>
<body>

    <div class="container">
        <!--<a href="main.php"><img src="img/home.png"/></a>-->
        <h2 class="title">Usuarios para Cierre</h2> 
        
        <!--*******************Probando********************-->
        <input id='myInput' onkeyup='searchTable()' type='text' placeholder="Search">
        <!--*************************************************-->

        <table id="data-table" class="table table-condensed table-striped">
            <thead>
            <tr>
                <th width="15%">Usuario</th>
                <th width="25%">Empleado</th>     
                <th width="10%">Genero</th>
                <th width="15%">Cargo</th>
                <th width="3%"></th>
            </tr>
            </thead>
        <?php		
                $sql="select 
                        u.usuario_usuario as usuario,
                        concat(e.empleado_nombre,' ',e.empleado_apellido1,' ',e.empleado_apellido2)as nombrec,
                        e.empleado_tipoempleado as cargo,
                        e.empleado_genero as genero
                        FROM tbl_empleado e
                        inner join tbl_usuarios u on u.empleado_cedula=e.empleado_cedula;";
                $result=mysqli_query($conexion,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    $invoiceDate = date("d/M/Y, H:i:s", strtotime($row["order_date"]));
                    echo '
                    <tr>
                        <td>'.$row["usuario"].'</td>

                        <td>'.$row["nombrec"].'</td>

                        <td>'.$row["genero"].'</td>

                        <td>'.$row["cargo"].'</td>

                        <td><a href="cierre_caja.php?invoice_id='.$row["usuario"].'" title="Imprimir Cierre de Caja"><div class="btn btn-primary"><span><i><img src="img/print.png"/></i></span></div></a></td>';
                }
        ?>

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