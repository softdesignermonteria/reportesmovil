<?php 
	
	$host="localhost";
	$usuario="root";
	$clave="123";
	$bd="factutesis";
    $conexion = mysql_connect($host, $usuario, $clave);
    mysql_select_db($bd, $conexion) or die("Error al conectar a la BD: ".$bd);
	
?>