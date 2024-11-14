<?php
session_start();

include "../../conexionBase/conexion.php";

$user=$_SESSION['user'];
if($user == null || $user == ''){
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
    <title>Menu Herramientas</title>
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
     if($user == 'andres'){
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
            <a href="herramientas en utilizacion/herramientasUtlizadas.php"><button class="opci">herramientas en utilización</button></a>
            <a href="herramientas totales/herramientas.php"><button class="opci">herramientas totales</button></a>
            <a href="nueva herramienta/registroHerramienta.php"><button class="opci">registro de nueva herramienta</button></a>
            <a href="entrega/entregaHerramienta.php"><button class="opci">herramientas entregadas</button></a>
            
        </div>
        <br>
        <br>
        <br>
        <br>
        <div>
            <center>
        <a href="reportes_excel/herramientasEliminadas.php"  class="myy"><i class="far fa-file-excel">Reporte herramientas eliminadas</i></a>
        <a href="reportes_excel/herramientasEditadas.php"  class="myy"><i class="far fa-file-excel">Reporte herramientas editadas</i></a>
            </center>
        </div>
        
    </main>
    <footer>

    </footer>
</body>
</html>