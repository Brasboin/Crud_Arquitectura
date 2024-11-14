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


$consulta ="DELETE FROM empleados WHERE iden_emp='$cod'";
$ejecutar=mysqli_query($conexion,$consulta);

if($ejecutar){
    $codigo="DELETE FROM usuarios WHERE iden_emp = '$cod'";
    $ejecucion=mysqli_query($conexion,$codigo);
}

if($ejecutar){
    echo "<script>alert('El empleado ha sido borrado')</script>";
    echo "<script>window.open('../empleados.php','_self')</script>";
   
}else{
    echo "<script>alert('HA OCURRIDO UN ERROR')</script>";
    echo "<script>window.open('../empleados.php','_self')</script>";
   
}
}

?>
