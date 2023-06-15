<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <title>Pop-Up</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>

<?php 
    include("conexion.php");

    $sql="select usuario_contra as contra FROM tbl_usuario;";
    $result=mysqli_query($conexion,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $resultado=$row["contra"];
    }
    echo $resultado;
    //echo "PHP de AJAX ".$_POST["codigo"];
?>

<body>

    <div class="window-notice" id="window-notice">
        <div class="content">
            <div class="content-text">La Contrasena Temporal es: <?php $resultado ?>

            <div class="content-buttons"><input type="button" name="" value="Cerrar" onclick="window.close()"></div>
<!--            <div class="content-buttons"><a href="#" id="close-button">Aceptar</a></div>-->
        </div>
    </div>
    <script src="script.js"></script>

</body>

</html>