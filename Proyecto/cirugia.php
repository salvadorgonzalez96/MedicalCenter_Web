<?php 
include("menu.php");
include("menu_servicios.php");

/*session_start();
include("conexion.php");*/

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
	<title>Lista de Cirugias</title>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="js/invoice.js"></script>
    <link rel="stylesheet" href="css/fac.css">

</head>
<body>

    <div class="container">
        <!--<a href="main.php"><img src="img/home.png"/></a>-->
        <h2 class="title">Lista de Servicios de Cirugias</h2> 
        
        <!--*********BUSCAR EN LA TABLA *********-->
        <input id='myInput' onkeyup='searchTable()' type='text' placeholder="Search">
        <!--*************************************************-->

        <table id="data-table" class="table table-condensed table-striped">
            <thead>
            <tr>
                <th width="5%">Codigo Cita</th>
                <th width="7%">Fecha Cita</th>
                <th width="20%">Nombre Paciente</th>     
                <th width="10%">ID Paciente</th>
                <th width="7%">Genero</th>
                <th width="8%">Celular</th>
                <th width="15%">Tipo Servicio</th>
                <th width="8%">Estado</th>
                <th width="3%"></th>
                <th width="3%"></th>
            </tr>
            </thead>
        <?php
                $sql="select
                        *
                        FROM tbl_cita c
                        inner join tbl_cliente cl on cl.cliente_id=c.cita_cliente_id
                        where c.cita_servicio like 'operacion%' or c.cita_servicio like 'cirugia%'
                        order by c.cita_estado desc;";//SQL que van a modificar
                $result=mysqli_query($conexion,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    $invoiceDate = date("d/M/Y", strtotime($row["receta_fecha"]));
                    echo '
                    <tr>
                        <td>'.$row["cita_codigo"].'</td>
                        <td>'.$row["cita_fecha"].'</td>
                        <td>'.$row["cita_cliente_nombre"].'</td>
                        <td>'.$row["cita_cliente_id"].'</td>
                        <td>'.$row["cliente_genero"].'</td>
                        <td>'.$row["cliente_celular"].'</td>
                        <td>'.$row["cita_servicio"].'</td>
                        <td>'.$row["cita_estado"].'</td>
                        
                        <td><a href="imprimir_cirugia.php?update_id='.$row["cita_codigo"].'" TARGET="_blank"  title="Reporte de Examen"><div class="btn btn-primary"><span><i><img src="img/print.png"/></i></span></div></a></td>
                        ';
if($row["cita_estado"]!="ATENDIDO"){
                        echo'
                        <td><a href="atender_cirugia.php?update_id='.$row["cita_codigo"].'"  TARGET="_self" title="Realizar Examen"><div class="btn btn-primary"><span><i><img src="img/attend.png"/></i></span></div></a></td>
                    </tr>';
}
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
        <!--*****************************************************************-->
</div>	

</body>
</html>