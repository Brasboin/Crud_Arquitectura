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
    <title>registro herramienta nueva</title>
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
            
    </header>
    <a href="../principalHerramientas.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario nuevas herramientas</p>
    </div>
    <mein class="formula">
        <form action="" method="POST" class="formulario">

        <input type="text" name="descrip" placeholder="Descripcion" required class="registro" autocomplete="off">
        <input type="text" name="marca" placeholder="Marca" required class="registro" autocomplete="off">
        <input type="text" name="tipo" placeholder="Nombre" required class="registro" autocomplete="off">
        <input type="text" name="cantidad_empresa" placeholder="Cantidad" required class="registro" autocomplete="off">
       
        <input type="submit" value="Registrar" name="enviar" class="botonLoggin">
        </form>
        <?php
        if(isset($_POST['enviar'])){
    
            $cantidad=$_POST['cantidad_empresa'];
            $marca=$_POST['marca'];
            $tipo=$_POST['tipo'];
            $descrip=$_POST['descrip'];
            
        
        
            $consulta="INSERT INTO herramientas_totales( cantidad_empresa, marca, descrip, cant_stock,tipo) VALUES ('$cantidad','$marca','$descrip','$cantidad','$tipo')";
            $ejecucion=mysqli_query($conexion,$consulta);
            if($ejecucion){
                ?>
                <h3 class="ok">SE HA REGISTRADO CORRECTAMENTE LA HERRAMIENTA</h3>
                <?php
            }else{
                ?>
                <h3 class="bad">HA OCURRIDO UN ERROR</h3>
                <?php
            }
        }
        
        
        ?>
    </mein>
</body>
</html>