<?php
session_start(); 
require_once("detect.php");
$detect=detectardis();
$desdei="Desde ".$detect;
$_SESSION["dispositivo"]=$detect;

require_once('BrowserDetection.php');
$browser = new Wolfcast\BrowserDetection();
$_SESSION["navegador"]=$browser->getName();
$desdei=$desdei." con ".$_SESSION["navegador"];
$_SESSION["desde"]=$desdei;
//echo $_SESSION["desde"];
echo "<br>Dispositivo ".$_SESSION["dispositivo"];
echo "<br>Navegador ".$_SESSION["navegador"];
?>