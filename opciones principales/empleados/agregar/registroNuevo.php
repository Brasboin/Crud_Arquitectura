<?php
session_start();

include "../../../conexionBase/conexion.php";

$user=$_SESSION['user'];
if($user == null || $user == ''){
    header("Location:../../../validacion/ingresoCorrupto.php ");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Empleados</title>
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
    <a href="../PrincipalEmpleados.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario Para Nuevos Empleados</p>
    </div>
    <mein class="aformula">

            <form method="POST" class="formulario">
                <input type="number" name="identificacion" placeholder="identificación" class="registro" required autocomplete="off"  maxlength="10" oninput="maxlengthNumber(this);">
                <input type="text" name="nombre" placeholder="nombre" class="registro" required autocomplete="off">
                <input type="text" name="apellido" placeholder="apellidos" class="registro" required autocomplete="off">
                <input type="text" name="direccion" placeholder="dirección" class="registro" required autocomplete="off">
                <input type="number" name="tel" placeholder="teléfono" class="registro" required autocomplete="off"  maxlength="10" oninput="maxlengthNumber(this);">
                <input type="text" name="rh"  placeholder="rh" class="registro" required autocomplete="off">
                <input type="text" name="user"  placeholder="usuario para loggin" class="registro" required autocomplete="off" maxlength="8" oninput="maxlengthNumber(this);">
                <input type="text" name="pass"  placeholder="password" class="registro" required autocomplete="off"  maxlength="6" oninput="maxlengthNumber(this);">
                <input type="submit" value="registrar" name="enviar" class="botonLoggin" >
            </form>


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
            if(strlen($_POST['identificacion']) >=1 && strlen($_POST['nombre']) >=1 && strlen($_POST['apellido']) >=1 && strlen($_POST['direccion']) >=1 && strlen($_POST['tel']) >=1 && strlen($_POST['rh']) >=1){
        
                $identi = $_POST['identificacion'];
                $nom = $_POST['nombre'];
                $ape = $_POST['apellido'];
                $direc = $_POST['direccion'];
                $tel = $_POST['tel'];
                $rh = $_POST['rh'];
                $usu = $_POST['user'];
                $pass= $_POST['pass'];

                $busca="SELECT * FROM empleados WHERE iden_emp = '$identi'";
                $resultado = mysqli_query($conexion,$busca);
                $cant = mysqli_num_rows ($resultado);


                if($cant >0){
                    ?>
                    <h3 class="bad">ESA IDENTIFIACIÓN YA ESTA REGISTRADA</h3>
                    <?php
                }else{
                    $busca="SELECT * FROM usuarios WHERE usuario = '$usu'";
                    $resultado = mysqli_query($conexion,$busca);
                    $cant = mysqli_num_rows ($resultado);
                    if($cant>0){
                        ?>
                    <h3 class="bad">ESE USUARIO YA ESTA REGISTRADO</h3>
                    <?php 
                    }else{
                
                $consulta = "INSERT INTO empleados (iden_emp, nom_emp, ape_emp, direc_emp, tel_emp, rh) VALUES ('$identi','$nom','$ape','$direc','$tel','$rh') ";
                $ejecucion = mysqli_query($conexion,$consulta);
                if($ejecucion){
                    $codigo="INSERT INTO usuarios(usuario, contrasena,iden_emp) VALUES ('$usu','$pass','$identi')";
                    $ejecutar=mysqli_query($conexion,$codigo);
                    if($ejecutar){
                       ?>
                    <h3 class="ok">Se ha registrado correctamente</h3>
                    <?php 
                    }else{
                        ?>
                        <h3 class="bad">Ha ocurrido un error</h3>
                        <?php
                    }
                    
                    
                    }else{
                    ?>
                    <h3 class="bad">Ha ocurrido un error</h3>
                    <?php
                 }

                }
            }



                } else{
                    ?>
                    <h3 class="bad">Por favor complete todos los campos</h3>
                    <?php
                
            
        }
        }






          ?>
    </mein>
</body>
</html>