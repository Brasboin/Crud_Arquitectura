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
$fecha=date("y/m/d");

$consulta="SELECT * FROM herramientas_totales WHERE cod_herramienta='$cod'";
$eje=mysqli_query($conexion,$consulta);
while($mostrar=mysqli_fetch_array($eje)){
    echo $cantidad_emp=$mostrar['cantidad_empresa'];
    echo $marca=$mostrar['marca'];
    echo $tipo=$mostrar['tipo'];
    echo $descrip=$mostrar['descrip'];
}


if($consulta){

$consul="SELECT * FROM usuarios WHERE usuario='$user'";
$ejecuta=mysqli_query($conexion,$consul);
while($mostrarr=mysqli_fetch_array($ejecuta)){
    echo $identificacion=$mostrarr['iden_emp'];
}
}
if($ejecuta){
    
    $consultar ="INSERT INTO herramienta_eliminada(cod_herra, fecha_elimina, cantidad_existia, tipo, descrip, iden_emp) VALUES ('$cod','$fecha','$cantidad_emp','$tipo','$descrip','$identificacion')";
    $ejecutarr=mysqli_query($conexion,$consultar);

}
if($ejecutarr){
    $consulta ="DELETE FROM herramientas_totales WHERE cod_herramienta='$cod'";
    $ejecutar=mysqli_query($conexion,$consulta);

}
if($ejecutar){
    echo "<script>alert('La herramienta ha sido Eliminada')</script>";
    echo "<script>window.open('../herramientas.php','_self')</script>";
   
}else{
    echo "<script>alert('HA OCURRIDO UN ERROR')</script>";
    echo "<script>window.open('../herramientas.php','_self')</script>";
   
}
}

?>
