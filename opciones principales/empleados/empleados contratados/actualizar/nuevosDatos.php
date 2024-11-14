<?php
session_start();

include "../../../../conexionBase/conexion.php";

$user=$_SESSION['user'];
if($user == null || $user == ''){
    header("Location:../../../../validacion/ingresoCorrupto.php ");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevos Datos</title>
    <link rel="stylesheet" href="../../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../../estilos/tablas.css">
    <link rel="stylesheet" href="../../../../estilos/loggin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<body>
<header>
        <div class="banerSuperior">
            <a href="../../../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
            <img src="../../../../anexos/LOGO.gif" class="imagen1">
    </header>
    <a href="../empleados.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario Para editar Empleados</p>
    </div>
    <?php
    $id_emp=$_GET['id'];
    

    $consulta= "SELECT * FROM empleados WHERE iden_emp ='$id_emp'";
    $ejecucion =mysqli_query($conexion,$consulta);
    while($mostrar=mysqli_fetch_array($ejecucion)){
    
        $consultar="SELECT * FROM usuarios WHERE iden_emp = '$id_emp'";
        $accion=mysqli_query($conexion,$consultar);
        while($ver=mysqli_fetch_array($accion)){     
    ?>
    <mein class="aformula">
        <form action="" method="POST" class="formulario">
        <input type="text" name="new_identi" value="<?php  echo $mostrar['iden_emp']; ?>" readonly class="registro">
        <input type="text" name="new_nombre" value="<?php  echo $mostrar['nom_emp']; ?>" required class="registro" autocomplete="off">
        <input type="text" name="new_apellido" value="<?php  echo $mostrar['ape_emp']; ?>" required class="registro" autocomplete="off">
        <input type="text" name="new_direccion" value="<?php  echo $mostrar['direc_emp']; ?>" required class="registro" autocomplete="off">
        <input type="text" name="new_tel" value="<?php  echo $mostrar['tel_emp']; ?>" required  class="registro" autocomplete="off">
        <input type="text" name="new_rh" value="<?php  echo $mostrar['rh']; ?>" readonly class="registro">
        <input type="text" name="user" value="<?php  echo $ver['usuario']; ?>" required  class="registro" autocomplete="off">
        <input type="text" name="pass" value="<?php  echo $ver['contrasena']; ?>" required  class="registro" autocomplete="off">
        <input type="submit" value="actualizar" name="enviar" class="botonLoggin">
        </form>
        <?php
            }
        }

        if(isset($_POST['enviar'])){
            $new_nombre=$_POST['new_nombre'];
            $new_apellido=$_POST['new_apellido'];
            $new_dirreccion=$_POST['new_direccion'];
            $new_tel=$_POST['new_tel'];
            $usu=$_POST['user'];
            $pass=$_POST['pass'];

            $consulta="UPDATE empleados SET nom_emp='$new_nombre',ape_emp='$new_apellido',direc_emp='$new_dirreccion',tel_emp='$new_tel' WHERE iden_emp='$id_emp'";
            $ejecucion = mysqli_query($conexion,$consulta);
            if($ejecucion){

                $codigo="UPDATE usuarios SET usuario='$usu',contrasena='$pass' WHERE iden_emp = '$id_emp'";
                $ejecutar=mysqli_query($conexion,$codigo);
                    if($ejecutar){
                        echo "<script>alert('Datos Actualizados')</script>";
                        echo "<script>window.open('../empleados.php','_self')</script>";
                    }else{
                        ?>
                        <h3 class="bad">SE HA PRODUCIDO UN HERROR</h3>
                        <?php
                    }

                
            }else{
                ?>
                <h3 class="bad">SE HA PRODUCIDO UN HERROR</h3>
                <?php
            }
        }
        ?>
    </mein>
</body>
</html>