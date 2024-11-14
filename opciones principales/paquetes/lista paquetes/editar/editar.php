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
    <title>editar paquete</title>
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
</head>
<body>
<header>
        <div class="banerSuperior">
            <a href="../../../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
            <img src="../../../../anexos/LOGO.gif" class="imagen1">
    </header>
    <a href="../mostrarPaquetes.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario Para editar paquetes</p>
    </div>
    <?php
    
    $id_paquete=$_GET['id'];
    
   $consulta = "SELECT * FROM paquetes WHERE cod_paquete = '$id_paquete'";
   $ejecucion = mysqli_query($conexion,$consulta);
   while($mostrar=mysqli_fetch_array($ejecucion)){
    
    ?>
    <mein class="formula">
        <form action="" method="POST" class="formulario"  >   
            <p>codigo</p>
            <input type="text" name="codigo" value="<?php  echo $mostrar['cod_paquete']; ?>" readonly class="registro">  
            <p>valor</p>
            <input type="number" name="valor" value="<?php echo $mostrar['valor'];  ?>" class="registro" autocomplete="off">
            <p>descripción</p>
            <input type="text" name="descripcion" value="<?php echo $mostrar['descrip'];  ?>" class="registro" autocomplete="off">
            <br>
            <br>
           

            <input type="submit" name="enviar" value="actualizar" class="botonLoggin">
        </form>

        <?php
        
        }

        if(isset($_POST['enviar'])){

            $cod=$_POST['codigo'];
            $descrip=$_POST['descripcion'];
            $valor=$_POST['valor'];
            


    
            $consulta="UPDATE paquetes set valor='$valor',descrip='$descrip' WHERE cod_paquete = '$id_paquete'";
            $ejecucion=mysqli_query($conexion,$consulta);


            if($ejecucion){
                ?>
                <h3 class="ok">SE HA ACTUALIZADO CORRECTAMENTE</h3>
                <?php
            }else{
                ?>
                <h3 class="bad">SE HA PRODUCIDO UN ERROR</h3>
                <?php
            }
        }
        ?>



    </mein>
</body>
</html>