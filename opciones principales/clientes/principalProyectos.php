<?php

session_start();
include "../../conexionBase/conexion.php";

$user =$_SESSION['user'];
if($user == null || $user =='')
{
    header("Location: ../../validacion/ingresoCorrupto.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../estilos/botones.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<body>
     <header>
    <div class="banerSuperior">
    <a href="../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
    
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
    
     <main>
         <div class="internos">
            <a href="crear cliente/crearCliente.php"><button class="opci">registrar proyectos</button></a>
            <a href="lista clientes/clientes.php"><button class="opci">ver proyectos</button></a>
        </div>
     </main>
     <footer>

     </footer>
</body>
</html>