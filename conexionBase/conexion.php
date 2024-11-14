<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$base = "sistema";

$conexion= mysqli_connect ($host,$user,$pass,$base);
$conexion->set_charset("utf8");
if(!$conexion){
    echo "no hay conexion con la base de datos";
}else{
   
}
?>