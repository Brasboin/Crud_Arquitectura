<?php

session_start();

include "../conexionBase/conexion.php";

$user = $_SESSION['user'];
if($user == null || $user == '')
{
    header("Location: ../validacion/ingresoCorrupto.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../estilos/botones.css">
    <link rel="stylesheet" href="../estilos/paginaPrincipal.css">
    <title>inicio</title>
</head>
<body>
<header>
     <div class="banerSuperior">
         <img src="../anexos/LOGO.gif" class="imagen1">
         
         <a href="../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
        </div>
     </header>
   
    <mein>
        <div class="opcionesforma">
            <div class="individual" id="_dosnuevo">
                <a href="../opciones principales/encargos/principalEncargos.php"> <button class="botonesdos">encargos</button></a>
            </div> 

            <div class="individual" id="_tres">
                <a href="../opciones principales/ventas/ventas.php"> <button class="botonesdos">ventas</button></a>
            </div>

            <div class="individual" id="_cuatro">
                <a href="../opciones principales/clientes/principalClientes.php"> <button class="botonesdos">clientes</button></a>
            </div>

            <div class="individual" id="_cinco">
                <a href="../opciones principales/paquetes/principalPaquetes.php"><button class="botonesdos">paquetes</button></a>
            </div>

            <div class="individual" id="_seis">
                <a href="../opciones principales/herramientas/principalHerramientas.php"><button class="botonesdos">herramientas</button></a>
            </div>
            
            

        </div>
    </mein>
    <footer>

    </footer>
</body>
</html>