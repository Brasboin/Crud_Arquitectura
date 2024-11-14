<?php
session_start();

include '../../../conexionBase/conexion.php';

$user=$_SESSION['user'];
if($user == null || $user == ''){
    header("Location:../../../validacion/ingresoCorrupto.php ");
    die();

}
$consultar="SELECT * FROM usuarios WHERE usuario = '$user'";
$ejecutar=mysqli_query($conexion,$consultar);
while($ver=mysqli_fetch_array($ejecutar)){
 $identificacion_user= $ver['iden_emp'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro encargo</title>
    <link rel="stylesheet" href="../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../estilos/tablas.css">
    <link rel="stylesheet" href="../../../estilos/loggin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<body>
<header>
        <div class="banerSuperior">
            <a href="../../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
            <img src="../../../anexos/LOGO.gif" class="imagen1">
    </header>
    <a href="../principalEncargos.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario Para encargos</p>

        <table>
            <tr class="uno">
                <td>identificación cliente</td>
                <td>identificación empleado</td>
                <td>codigo paquetes</td>
                <td>realizar encargo</td>
            </tr>
            <form action="" method="POST">
                <td><input type="number" name="identificacion_cliente" placeholder="identificación cliente" class="registro" autocomplete="off" required  maxlength="10" oninput="maxlengthNumber(this);"></td>
                <td><input type="number" name="identificacion_empleado" value="<?php echo $identificacion_user?>" readonly class="registro" autocomplete="off"    maxlength="10" oninput="maxlengthNumber(this);"></td>
                <td><input type="number" name="paquetes" placeholder="codigo de los paquetes" class="registro" autocomplete="off"  required></td>
                <td><input type="submit" value="enviar" name="enviar" class="botonLoggin"></td>
            </form>
        </table>
        <script>
            function maxlengthNumber(obj){
                console.log(obj.value);
                if(obj.value.length>obj.maxLength){
                    obj.value=obj.value.slice(0,obj.maxLength);
                }
            }
        </script>

        <?php
        
        if(isset($_POST['enviar'])){
            
            $iden_cli=$_POST['identificacion_cliente'];
            $iden_emp=$_POST['identificacion_empleado'];
            $paquetes=$_POST['paquetes'];
            $fecha= date("y/m/d");


            $busca="SELECT * FROM empleados WHERE iden_emp = '$iden_emp'";
            $resultado = mysqli_query($conexion,$busca);
            $cant = mysqli_num_rows ($resultado);
            if($cant == 0){
                ?>
                <h3 class="badtwo">LA IDENTIFICACIÓN DEL EMPLEADO NO ESTA REGISTRADA</h3>
                <?php
            }else{

                $busca="SELECT * FROM clientes WHERE iden_cli = '$iden_cli'";
                $resultado = mysqli_query($conexion,$busca);
                $canti = mysqli_num_rows ($resultado);
            if($canti == 0){
                ?>
                <h3 class="badtwo">LA IDENTIFICACIÓN DEL CLIENTE NO ESTA REGISTRADA</h3>
                <?php
            }else{
                $codigo="INSERT INTO encargos(cod_cliente, cod_empleado, cod_paquetes, fecha) VALUES ('$iden_cli','$iden_emp','$paquetes','$fecha')";
                $ejecucion=mysqli_query($conexion,$codigo);

                if($ejecucion){
                
                    echo "<script>alert('Se ha registrado el encargo correctamente')</script>";
                    echo "<script>window.open('nuevoEncargo.php','_self')</script>";
           
                }else{
                    echo "<script>alert('HA OCURRIDO UN ERROR')</script>";
                    echo "<script>window.open('nuevoEncargo.php','_self')</script>";

                    }
                }
            }
        }

        
        
        
        ?>
    </div>
</body>
</html>