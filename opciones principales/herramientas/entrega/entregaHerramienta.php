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
    <title>herramientas entregadas</title>
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
            <img src="../../../anexos/LOGO.gif" class="imagen1">
        </div>
    </header>
    <a href="../principalHerramientas.php"><button class="icon"><i class="fas fa-undo" title="regresar"></i></button></a>
    <center>
        <a href="excel3.php" class="myy"><i class="far fa-file-excel">Exportar herramientas entregadas</i></a>
    </center>

    <form action="" method="POST" class="filtro">
        <table>
            <tr class="uno">
                <td>Buscar fecha específica</td>
                <td>Buscar nombre de proyecto</td>
                <td>Buscar nombre de empleado</td>
                <td>Consultar</td>
            </tr>
            <tr>
                <td><input type="date" name="fecha"></td>
                <td>
                    <select name="proyecto">
                        <option value="">Seleccione Proyecto</option>
                        <?php
                        $consultaProyectos = "SELECT * FROM proyectos";
                        $resultadoProyectos = mysqli_query($conexion, $consultaProyectos);
                        while ($row = mysqli_fetch_array($resultadoProyectos)) {
                            echo "<option value='" . $row['Id_proyecto'] . "'>" . $row['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="empleado">
                        <option value="">Seleccione Empleado</option>
                        <?php
                        $consultaEmpleados = "SELECT * FROM empleados";
                        $resultadoEmpleados = mysqli_query($conexion, $consultaEmpleados);
                        while ($row = mysqli_fetch_array($resultadoEmpleados)) {
                            echo "<option value='" . $row['iden_emp'] . "'>" . $row['nom_emp'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><input type="submit" name="consultar" value="consultar" class="botonLoggin"></td>
            </tr>
        </table>
    </form>

    <table>
        <tr class="uno">
            <td>Código Entrega</td>
            <td>Código Herramienta</td>
            <td>Nombre Herramienta</td>
            <td>Código Solicitud</td>
            <td>Código Proyecto</td>
            <td>Nombre Proyecto</td>
            <td>Código Empleado</td>
            <td>Nombre Empleado</td>
            <td>Fecha Entrega</td>
            <td>Cantidad</td>
        </tr>
        <?php
        if (isset($_POST['consultar'])) {
            $filtroFecha = $_POST['fecha'];
            $filtroProyecto = $_POST['proyecto'];
            $filtroEmpleado = $_POST['empleado'];

            $consulta = "SELECT he.*, p.nombre, e.nom_emp, h.tipo
                         FROM herramientas_entregadas he
                         JOIN proyectos p ON he.codigo_proyecto = p.Id_proyecto
                         JOIN empleados e ON he.codigo_empleado = e.iden_emp
                         JOIN herramientas_totales h ON he.codigo_herramienta = h.cod_herramienta
                         WHERE 1=1";

            if (!empty($filtroFecha)) {
                $consulta .= " AND he.fecha_entregado = '$filtroFecha'";
            }
            if (!empty($filtroProyecto)) {
                $consulta .= " AND he.codigo_proyecto = '$filtroProyecto'";
            }
            if (!empty($filtroEmpleado)) {
                $consulta .= " AND he.codigo_empleado = '$filtroEmpleado'";
            }

            $resultado = mysqli_query($conexion, $consulta);
            while ($mostrar = mysqli_fetch_array($resultado)) {
        ?>
                <tr>
                    <td><?php echo $mostrar['codigo_entrega']; ?></td>
                    <td><?php echo $mostrar['codigo_herramienta']; ?></td>
                    <td><?php echo $mostrar['tipo']; ?></td>
                    <td><?php echo $mostrar['codigo_solicitud']; ?></td>
                    <td><?php echo $mostrar['codigo_proyecto']; ?></td>
                    <td><?php echo $mostrar['nombre']; ?></td>
                    <td><?php echo $mostrar['codigo_empleado']; ?></td>
                    <td><?php echo $mostrar['nom_emp']; ?></td>
                    <td><?php echo $mostrar['fecha_entregado']; ?></td>
                    <td><?php echo $mostrar['cantidad']; ?></td>
                </tr>
        <?php
            }
        } else {
            $consulta = "SELECT he.*, p.nombre, e.nom_emp, h.tipo
                         FROM herramientas_entregadas he
                         JOIN proyectos p ON he.codigo_proyecto = p.Id_proyecto
                         JOIN empleados e ON he.codigo_empleado = e.iden_emp
                         JOIN herramientas_totales h ON he.codigo_herramienta = h.cod_herramienta";
            $resultado = mysqli_query($conexion, $consulta);
            while ($mostrar = mysqli_fetch_array($resultado)) {
        ?>
                <tr>
                    <td><?php echo $mostrar['codigo_entrega']; ?></td>
                    <td><?php echo $mostrar['codigo_herramienta']; ?></td>
                    <td><?php echo $mostrar['tipo']; ?></td>
                    <td><?php echo $mostrar['codigo_solicitud']; ?></td>
                    <td><?php echo $mostrar['codigo_proyecto']; ?></td>
                    <td><?php echo $mostrar['nombre']; ?></td>
                    <td><?php echo $mostrar['codigo_empleado']; ?></td>
                    <td><?php echo $mostrar['nom_emp']; ?></td>
                    <td><?php echo $mostrar['fecha_entregado']; ?></td>
                    <td><?php echo $mostrar['cantidad']; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>

</html>
