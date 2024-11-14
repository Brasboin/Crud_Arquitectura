<?php
session_start();

include "../../../conexionBase/conexion.php";

$user = $_SESSION['user'];
if ($user == null || $user == '') {
    header("Location:../../../validacion/ingresoCorrupto.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>herramientas utilizadas</title>
    <link rel="stylesheet" href="../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../estilos/tablas.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="banerSuperior">
            <a href="../../../cerrar sesion/cierre.php"><button class="cerrar">CERRAR SESIÓN</button></a>
           
        </div>
    </header>
    <a href="../principalHerramientas.php"><button class="icon"><i class="fas fa-undo" title="regresar"></i></button></a>
    <main>
        <center>
            <a href="excel.php" class="myy"><i class="far fa-file-excel">Exporta herramientas en utilizacion</i></a>
        </center>
        <table>
            <tr class="uno">
                <td>cod salida</td>
                <td>código empleado</td>
                <td>nombre empleado</td> <!-- Nuevo campo para nombre del empleado -->
                <td>cantidad</td>
                <td>lugar</td>
                <td>fecha salida</td>
                <td>cod herramienta</td>
                <td>tipo herramienta</td>
                <td>acciones</td>
            </tr>
            <?php
            // Consulta con JOIN para obtener el código y el tipo de la herramienta
            $consulta = "SELECT h.id_reg_salida, h.cod_emp, h.cantidad, h.cod_proyecto, h.fecha_salida, h.cod_herramienta, ht.tipo 
                         FROM herramientas_ocupadas h
                         JOIN herramientas_totales ht ON h.cod_herramienta = ht.cod_herramienta";
            $resultado = mysqli_query($conexion, $consulta);
            while ($mostrar = mysqli_fetch_array($resultado)) {
                // Obtener el nombre del empleado basado en el cod_emp
                $consulta_empleado = "SELECT nom_emp FROM empleados WHERE iden_emp = '" . $mostrar['cod_emp'] . "'";
                $resultado_empleado = mysqli_query($conexion, $consulta_empleado);
                $empleado = mysqli_fetch_array($resultado_empleado);
                $nombre_empleado = $empleado['nom_emp'];

                // Obtener el nombre del proyecto basado en cod_proyecto
                $consulta_proyecto = "SELECT nombre FROM proyectos WHERE Id_proyecto = '" . $mostrar['cod_proyecto'] . "'";
                $resultado_proyecto = mysqli_query($conexion, $consulta_proyecto);
                $proyecto = mysqli_fetch_array($resultado_proyecto);
                $nombre_proyecto = $proyecto['nombre'];
            ?>
            <tr>
                <td><?php echo $mostrar['id_reg_salida']; ?></td>
                <td><?php echo $mostrar['cod_emp']; ?></td>
                <td><?php echo $nombre_empleado; ?></td> <!-- Muestra el nombre del empleado -->
                <td><?php echo $mostrar['cantidad']; ?></td>
                <td><?php echo $nombre_proyecto; ?></td> <!-- Muestra el nombre del proyecto -->
                <td><?php echo $mostrar['fecha_salida']; ?></td>
                <td><?php echo $mostrar['cod_herramienta']; ?></td>
                <td><?php echo $mostrar['tipo']; ?></td>
                <td><a href="evidencia.php?id=<?php echo $mostrar['id_reg_salida']; ?>"><button class="btn-outline-success">entregar</button></a></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </main>
</body>
</html>
