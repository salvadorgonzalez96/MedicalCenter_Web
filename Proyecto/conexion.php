<?php

$servidor="localhost";
$usuario="root";
$clave="123";
$bd="pw2proyecto";///Modificar el Nombre de la BD

$conexion=mysqli_connect($servidor,$usuario,$clave,$bd);

	if(!$conexion){
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "Errno de Depuración: " . mysqli_connect_errno() . PHP_EOL;
		exit;
	}
	else{
		mysqli_set_charset($conexion,"utf8");
		//mysqli_query($conexion,"SET time_zone = '-06:00");
		//echo "Conexion Exitosa a BD";
	}

?>