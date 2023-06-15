<?php
include("menu.php");

if (!isset($_SESSION['sesuser'])){
    //header("Location:login.php");
    echo "<script>window.open('login.php','_self');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion</title>

    <style>
        body{
            background: url("img/fondo.jfif")  ; 
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    
</head>
<body>
<div id="main-content">

    <br/><div align="center"><h1><b>Informacion Basica de Medical Center</b></h1></div><br/>

        <p align="center">Somos una Clinica Medica que ofrece los servicios de Consulta Medica General, Consulta Medica con Especialista</p>
        <p align="center">Tambien contamos con centro de Laboratorios y sala Quirurgica, entre otros.</p>
    </div>
</div>

</body>
</html>