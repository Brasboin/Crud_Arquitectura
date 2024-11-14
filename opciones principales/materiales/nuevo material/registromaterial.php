<?php
session_start();

include "../../../conexionBase/conexion.php";

$user = $_SESSION['user'];
if ($user == null || $user == '') {
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
    <title>Registro de Material Nuevo</title>
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
        </div>
    </header>
    <a href="../principalMateriales.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario para Nuevos Materiales</p>
    </div>
    <mein class="formula">
        <form action="" method="POST" class="formulario">

            <input type="text" name="descrip" placeholder="Descripción breve" required class="registro" autocomplete="off">
            <input type="text" name="marca" placeholder="Marca" required class="registro" autocomplete="off">
            <input type="text" name="tipo" placeholder="Tipo" required class="registro" autocomplete="off">
            <input type="text" name="cantidad_empresa" placeholder="Cantidad" required class="registro" autocomplete="off">
            <input type="text" name="unidad" placeholder="Unidad" required class="registro" autocomplete="off">
            
            <input type="submit" value="Registrar" name="enviar" class="botonLoggin">
        </form>

        <?php
        if (isset($_POST['enviar'])) {

            $cantidad = $_POST['cantidad_empresa'];
            $marca = $_POST['marca'];
            $tipo = $_POST['tipo'];
            $descrip = $_POST['descrip'];
            $unidad = $_POST['unidad'];  // Capturamos el campo de unidad
            
            // Asegurarse de que el campo unidad sea manejado correctamente
            $consulta = "INSERT INTO materiales_totales (cantidad_empresa, marca, descrip, cant_stock, tipo, unidad) 
                         VALUES ('$cantidad', '$marca', '$descrip', '$cantidad', '$tipo', '$unidad')";
            $ejecucion = mysqli_query($conexion, $consulta);
            
            if ($ejecucion) {
                ?>
                <h3 class="ok">SE HA REGISTRADO CORRECTAMENTE EL MATERIAL</h3>
                <?php
            } else {
                ?>
                <h3 class="bad">HA OCURRIDO UN ERROR</h3>
                <?php
            }
        }
        ?>
    </mein>
</body>
</html>
