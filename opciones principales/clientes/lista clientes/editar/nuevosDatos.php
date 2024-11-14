<?php
session_start();

include "../../../../conexionBase/conexion.php";

$user = $_SESSION['user'];
if ($user == null || $user == '') {
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
    <title>Editar Proyecto</title>
    <link rel="stylesheet" href="../../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../../estilos/tablas.css">
    <link rel="stylesheet" href="../../../../estilos/loggin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<header>
    <div class="banerSuperior">
        <a href="../../../../cerrar sesion/cierre.php"><button class="cerrar">CERRAR SESIÓN</button></a>
        <img src="../../../../anexos/LOGO.gif" class="imagen1">
</header>
<a href="../proyectos.php"><button class="icon"><i class="fas fa-undo" title="regresar"></i></button></a>
<div>
    <p class="indice">Formulario Para Editar Proyecto</p>
</div>

<?php
$id_proyecto = $_GET['id'];

$consulta = "SELECT * FROM proyectos WHERE Id_proyecto ='$id_proyecto'";
$ejecucion = mysqli_query($conexion, $consulta);
while ($mostrar = mysqli_fetch_array($ejecucion)) {
?>

<main class="formula">
    <form action="" method="POST" class="formulario">
        <input type="text" name="new_nombre" value="<?php echo $mostrar['nombre']; ?>" required class="registro" autocomplete="off">
        <input type="text" name="new_lugar" value="<?php echo $mostrar['lugar']; ?>" required class="registro" autocomplete="off">
        <input type="date" name="new_fecha_inicio" value="<?php echo $mostrar['fecha_inicio']; ?>" required class="registro">
        <input type="submit" value="Actualizar" name="enviar" class="botonLoggin">
    </form>

    <?php
    }

    if (isset($_POST['enviar'])) {
        $new_nombre = $_POST['new_nombre'];
        $new_lugar = $_POST['new_lugar'];
        $new_fecha_inicio = $_POST['new_fecha_inicio'];

        $consulta = "UPDATE proyectos SET nombre='$new_nombre', lugar='$new_lugar', fecha_inicio='$new_fecha_inicio' WHERE id_proyecto='$id_proyecto'";
        $ejecucion = mysqli_query($conexion, $consulta);
        
        if ($ejecucion) {
            echo "<script>alert('Datos Actualizados')</script>";
            echo "<script>window.open('../clientes.php','_self')</script>";
        } else {
            echo "<h3 class='bad'>SE HA PRODUCIDO UN ERROR</h3>";
        }
    }
    ?>
</main>
</body>
</html>
