<?php
 session_start();

 include "../../conexionBase/conexion.php";

$user = $_SESSION['user'];
if($user == null|| $user=='')
{
    header("Location: ../../validacion/ingresoCorrupto.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encargos</title>
    <link rel="stylesheet" href="../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../estilos/botones.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<body>
    <header>
        <div class="banerSuperior">
            <a href="../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
            <img src="../../anexos/LOGO.gif" class="imagen1">
        </div>
     </header>
     <?php
       if($user =='andres'){
        ?>
        <a href="../../pagina principal/paginaPrincipal.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
        <?php
    }else{
        ?>
        <a href="../../pagina principal/paginaPrincipalEmpleados.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
        <?php
    }
     ?>  
    <mein>
       <div class="internos">
        <a href="nuevo encargo/nuevoEncargo.php"><button class="opci">nuevo encargo</button></a> 
        <a href="lista de encargos/listaEncargos.php"><button class="opci">lista de encargos</button></a>
        </div>  
    </mein>
    <footer>

    </footer>
</body>
</html>