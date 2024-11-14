<?php
session_start();

include '../../../../conexionBase/conexion.php';

$user=$_SESSION['user'];
if($user == null || $user == ''){
    header("Location:../../../../validacion/ingresoCorrupto.php ");
    die();
}


if(isset($_GET['id'])){
$cod = $_GET['id'];


$consulta ="DELETE FROM paquetes WHERE cod_paquete ='$cod'";
$ejecutar=mysqli_query($conexion,$consulta);

if($ejecutar){
    echo "<script>alert('El paquete ha sido Eliminado')</script>";
    echo "<script>window.open('../mostrarPaquetes.php','_self')</script>";
   
}else{
    echo "<script>alert('HA OCURRIDO UN ERROR')</script>";
    echo "<script>window.open('../mostrarPaquetes.php','_self')</script>";
   
}
}

?>
