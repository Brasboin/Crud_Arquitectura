<?php
session_start();
include "../../../conexionBase/conexion.php";

$user = $_SESSION['user'];
if ($user == null || $user == '') {
    header("Location: ../../../validacion/ingresoCorrupto.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Proyecto</title>
    <link rel="stylesheet" href="../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../estilos/tablas.css">
    <link rel="stylesheet" href="../../../estilos/loggin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="banerSuperior">
            <a href="../../../cerrar sesion/cierre.php"><button class="cerrar">CERRAR SESIÓN</button></a>
        </div>
    </header>
    <a href="../principalProyectos.php"><button class="icon"><i class="fas fa-undo" title="regresar"></i></button></a>
    <div>
        <p class="indice">Formulario Para Nuevos Proyectos</p>
    </div>
    
    <main class="formula">
        <form action="" method="POST" class="formulario">
            <input type="text" name="nombre" placeholder="Nombre del Proyecto" required class="registro" autocomplete="off">
            <input type="text" name="lugar" placeholder="Lugar del Proyecto" required class="registro" autocomplete="off">
            <input type="date" name="fecha_inicio" placeholder="Fecha de Inicio" required class="registro">
            <input type="submit" value="Registrar" name="enviar" class="botonLoggin">
        </form>

        <?php
        // Comprobación de usuario
        if (isset($_POST['enviar'])) {
            $nom_proy = $_POST['nombre'];
            $lugar = $_POST['lugar'];
            $fecha_inicio = $_POST['fecha_inicio'];

            // Verifica si ya existe un proyecto con el mismo nombre
            $busca = "SELECT * FROM proyectos WHERE nombre = '$nom_proy'";
            $resultado = mysqli_query($conexion, $busca);
            $cant = mysqli_num_rows($resultado);

            if ($cant > 0) {
                echo '<h3 class="bad">ESE PROYECTO YA ESTÁ REGISTRADO</h3>';
            } else {
                $consulta = "INSERT INTO proyectos(nombre, lugar, fecha_inicio) VALUES ('$nom_proy', '$lugar', '$fecha_inicio')";
                $ejecucion = mysqli_query($conexion, $consulta);
                if ($ejecucion) {
                    echo '<h3 class="ok">SE HA REGISTRADO CORRECTAMENTE EL PROYECTO</h3>';
                } else {
                    echo '<h3 class="bad">HA OCURRIDO UN ERROR</h3>';
                }
            }
        }
        ?>
    </main>
</body>
</html>
