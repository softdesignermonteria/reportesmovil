<?php

include('conexion.php');

$usu = mysql_real_escape_string($_POST["usu"]);
$pass = mysql_real_escape_string($_POST["pass"]);

$sql = "SELECT username,password FROM admin WHERE username='".$usu."' AND password=md5('".$pass."')";
//echo $sql;
$resultado = mysql_query($sql);
if (mysql_num_rows($resultado) > 0){
		echo true;
}else{
		echo false;
}
mysql_close();
?>