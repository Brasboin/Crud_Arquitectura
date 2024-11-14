<?php
session_start();

include '../../../../conexionBase/conexion.php';

$user = $_SESSION['user'];
if ($user == null || $user == '') {
    header("Location:../../../../validacion/ingresoCorrupto.php ");
    die();
}

// Consultamos el id del empleado basándonos en el usuario
$consultar = "SELECT iden_emp FROM usuarios WHERE usuario = '$user'";
$ejecutar = mysqli_query($conexion, $consultar);
$ver = mysqli_fetch_array($ejecutar);
$identificacion_user = $ver['iden_emp'];  // ID de empleado

// Consultamos el nombre del empleado desde la tabla 'empleados' usando el iden_emp
$consulta_nombre = "SELECT nom_emp FROM empleados WHERE iden_emp = '$identificacion_user'";
$resultado_nombre = mysqli_query($conexion, $consulta_nombre);
$ver_nombre = mysqli_fetch_array($resultado_nombre);
$nombre_user = $ver_nombre['nom_emp'];  // Nombre del empleado
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>solicitud</title>
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
        
    </header>
    <a href="../herramientas.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario Para solicitar Herramientas</p>
    </div>
    <table>
        <tr class="uno">
            <td>codigo</td>
            <td>marca</td>
            <td>Nombre</td>
            <td>descripcion</td>
            <td>cantidad exitente</td>
            <td>cantidad de solicitud</td>
            <td>iden empleado</td>
            <td>nombre empleado</td>
            <td>lugar a trabajar</td>
            <td>acción</td>
        </tr>
        <?php
        $id_herra = $_GET['id'];

        $consulta = "SELECT * FROM herramientas_totales WHERE cod_herramienta='$id_herra'";
        $ejecucion = mysqli_query($conexion, $consulta);
        while ($mostrar = mysqli_fetch_array($ejecucion)) {
        ?>
        <tr>
            <td><?php echo $mostrar['cod_herramienta']; ?></td>
            <td><?php echo $mostrar['marca']; ?></td>
            <td><?php echo $mostrar['tipo']; ?></td>
            <td><?php echo $mostrar['descrip']; ?></td>
            <td><?php echo $cantidad = $mostrar['cant_stock']; ?></td>
            <td><form action="" method="POST"> 
                    <input type="number" name="valor" max="<?php echo $mostrar['cant_stock'];?>" min="0" autocomplete="off">
            </td>
            <td>
                <input type="number" name="identificacion" value="<?php echo $identificacion_user; ?>" autocomplete="off" readonly maxlength="10" oninput="maxlengthNumber(this);">
            </td>
            <td><?php echo $nombre_user; ?></td> <!-- Mostramos el nombre del empleado desde la tabla empleados -->
            <td>
                <select name="cod_proyecto" required>
                    <option value="">Seleccione un proyecto</option>
                    <?php
                    // Consultar los proyectos
                    $consulta_proyectos = "SELECT * FROM proyectos";
                    $result_proyectos = mysqli_query($conexion, $consulta_proyectos);
                    while ($proyecto = mysqli_fetch_array($result_proyectos)) {
                        echo "<option value='".$proyecto['Id_proyecto']."'>".$proyecto['nombre']."</option>";
                    }
                    ?>
                </select>
            </td>
            <td><input type="submit" value="solicitar" name="enviar" class="btn-outline-success"></form></td>
        </tr>

        <script>
            function maxlengthNumber(obj) {
                if (obj.value.length > obj.maxLength) {
                    obj.value = obj.value.slice(0, obj.maxLength);
                }
            }
        </script>
        <?php
        }
        if (isset($_POST['enviar'])) {
            if ($_POST['valor'] > $cantidad) {
                echo "<script>alert('La cantidad solicitada es mayor a la cantidad existente')</script>";
            }

            if ($cantidad == 0) {
                echo "<script>alert('No hay stock de la herramienta')</script>";
            } else {

                $valorSolicitado = $_POST['valor'];
                $identi = $_POST['identificacion'];
                $lugar = $_POST['cod_proyecto']; // Cambié 'Id_proyecto' por 'cod_proyecto'
                $cantidad_actual = $cantidad - $valorSolicitado;
                $fecha_solicitud = date("y/m/d");

                $busca = "SELECT * FROM empleados WHERE iden_emp = '$identi'";
                $resultado = mysqli_query($conexion, $busca);
                $cant = mysqli_num_rows($resultado);

                if ($cant == 0) {
                    echo "<script>alert('La identificación no esta registrada')</script>";
                } else {

                    $consulta = "UPDATE herramientas_totales SET cant_stock = '$cantidad_actual' WHERE cod_herramienta='$id_herra'";
                    $ejecucion = mysqli_query($conexion, $consulta);
                    $consulta2 = "INSERT INTO herramientas_ocupadas (cod_emp,cod_proyecto,fecha_salida,cod_herramienta,cantidad) values ('$identi','$lugar','$fecha_solicitud','$id_herra','$valorSolicitado') ";
                    $ejecucion2 = mysqli_query($conexion, $consulta2);

                    if ($ejecucion2 && $ejecucion) {
                        echo "<script>alert('Se ha registrado la solicitud con exito')</script>";
                        echo "<script>window.open('../herramientas.php','_self')</script>";
                    } else {
                        echo "<script>alert('Se ha producido un error')</script>";
                        echo "<script>window.open('solicitar.php','_self')</script>";
                    }
                }
            }
        }
        ?>
    </table>
</body>
</html>
