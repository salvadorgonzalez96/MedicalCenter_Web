<?php
session_start();

$client  = @$_SERVER['HTTP_CLIENT_IP'];
			    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
			    $remote  = $_SERVER['REMOTE_ADDR'];

			    if(filter_var($client, FILTER_VALIDATE_IP))
			    {
			        $ip = $client;
			    }
			    elseif(filter_var($forward, FILTER_VALIDATE_IP))
			    {
			        $ip = $forward;
			    }
			    else
			    {
			        $ip = $remote;
			    }
			    $_SESSION["ip_publica"]=$ip;

$MAC = exec('getmac'); 
$MAC = strtok($MAC, ' '); 
$_SESSION["mac"]=$MAC;

echo "IP Publica ".$_SESSION["ip_publica"];
//echo "Mac ".$_SESSION["mac"];

?>