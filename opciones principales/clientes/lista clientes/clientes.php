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
    <title>Lista de Proyectos</title>
    <link rel="stylesheet" href="../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../estilos/tablas.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<script type="text/javascript">
    function confirmClose(id) {
        var fecha = prompt("Por favor, ingresa la fecha de cierre (YYYY-MM-DD):");
        if (fecha) {
            window.location.href = `cerrar.php?id=${id}&fecha=${fecha}`;
            return true;
        } else {
            alert("No se ha ingresado una fecha de cierre.");
            return false;
        }
    }
</script>

<body>
    <header>
        <div class="banerSuperior">
            <a href="../../../cerrar sesion/cierre.php"><button class="cerrar">CERRAR SESIÓN</button></a>
        </div>
    </header>
    <a href="../principalProyectos.php"><button class="icon"><i class="fas fa-undo" title="regresar"></i></button></a>
    <main>
        <center>
            <a href="excel5.php" class="myy"><i class="far fa-file-excel">Exportar lista de proyectos</i></a>
        </center>

        <form action="" method="POST" class="filtro" id="_proyecto">
            <table>
                <tr class="uno">
                    <td colspan="3">Buscar proyecto por nombre</td>
                </tr>
                <tr>
                    <td><input type="text" name="nombre_proyecto" placeholder="Nombre del Proyecto"></td>
                    <td><input type="submit" name="enviar" value="Consultar"></td>
                    <td><button type="submit" name="filtro_cerrados" class="btn-filtro">Mostrar proyectos cerrados</button></td>
                    
</td>
                </tr>
                
            </table>
        </form>

        <table>
            <tr class="uno">
                <td>Nombre del Proyecto</td>
                <td>Lugar</td>
                <td>Fecha de Inicio</td>
                <td>Fecha Final</td>
                <td colspan="3">Acciones</td>
            </tr>

            <?php
            if (isset($_POST['enviar'])) {
                $nombre = $_POST['nombre_proyecto'];
                $consulta = "SELECT * FROM proyectos WHERE nombre LIKE '%$nombre%'";
                $resultado = mysqli_query($conexion, $consulta);
            } elseif (isset($_POST['filtro_cerrados'])) {
                $consulta = "SELECT * FROM proyectos WHERE fecha_final IS NOT NULL";
                $resultado = mysqli_query($conexion, $consulta);
            } else {
                $consulta = "SELECT * FROM proyectos";
                $resultado = mysqli_query($conexion, $consulta);
            }

            while ($mostrar = mysqli_fetch_array($resultado)) {
            ?>
                <tr>
                    <td><?php echo $mostrar['nombre']; ?></td>
                    <td><?php echo $mostrar['lugar']; ?></td>
                    <td><?php echo $mostrar['fecha_inicio']; ?></td>
                    <td><?php echo $mostrar['fecha_final'] ? $mostrar['fecha_final'] : 'N/A'; ?></td>
                    <td><a href="eliminar/eliminar.php?id=<?php echo $mostrar['Id_proyecto']; ?>"><button class="eliminar" onclick="return confirmDelete()">Eliminar</button></a></td>
                    <td><a href="editar/nuevosDatos.php?id=<?php echo $mostrar['Id_proyecto']; ?>"><button class="btn-outline-success">Editar</button></a></td>
                    <td><button class="btn-outline-info" onclick="return confirmClose('<?php echo $mostrar['Id_proyecto']; ?>')">Cerrar Proyecto</button></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </main>
</body>
</html>
