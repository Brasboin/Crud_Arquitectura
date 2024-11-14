<?php
session_start();

include "../../../conexionBase/conexion.php";

$user=$_SESSION['user'];
if($user == null || $user == ''){
    header("Location:../../../validacion/ingresoCorrupto.php ");
    die();
}

if(isset($_GET['id'])){
    $cod = $_GET['id'];
    $fecha =date("y/m/d");
    $codigo = "SELECT * FROM encargos WHERE cod_encargo ='$cod'";
    $ejecucion=mysqli_query($conexion,$codigo);
    while($mostrar=mysqli_fetch_array($ejecucion)){
        $codigo = $mostrar['cod_encargo'];
        $cliente=$mostrar['cod_cliente'];
        $empleado=$mostrar['cod_empleado'];
  
        $paquetes=$mostrar['cod_paquetes'];
    }

    $sentencia="INSERT INTO ventas(cod_encargo, cod_empleado, cod_cliente, fecha,cod_paquetes) VALUES ('$codigo','$empleado','$cliente','$fecha','$paquetes')";
    $ejecu=mysqli_query($conexion,$sentencia);

    if($ejecu){

    $consulta ="DELETE FROM encargos WHERE cod_encargo ='$codigo'";
    $ejecutar=mysqli_query($conexion,$consulta);
    if($ejecutar){
        if($ejecutar){
            echo "<script>alert('El  encargo ha sido entregado')</script>";
            echo "<script>window.open('listaEncargos.php','_self')</script>";
       
        }else{
            echo "<script>alert('HA OCURRIDO UN ERROR')</script>";
            echo "<script>window.open('listaEncargos.php','_self')</script>";
       
    }
    }
    }
   




    }
    
    ?>


