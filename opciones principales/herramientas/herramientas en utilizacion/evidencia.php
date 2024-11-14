<?php
session_start();
include "../../../conexionBase/conexion.php";

$user = $_SESSION['user'];
if($user == null || $user == ''){
    header("Location: ../../../validacion/ingresoCorrupto.php");
    die();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $fecha = date("y/m/d");
    
    // Modificación de la consulta para obtener el nombre del proyecto y código del proyecto
    $consulta = "
        SELECT h.*, p.nombre, p.Id_proyecto as cod_proyecto
        FROM herramientas_ocupadas h
        JOIN proyectos p ON h.cod_proyecto = p.Id_proyecto
        WHERE h.id_reg_salida = '$id'
    ";
    $ejecutar = mysqli_query($conexion, $consulta);
    while($mostrar = mysqli_fetch_array($ejecutar)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario entrega</title>
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
<a href="herramientasUtlizadas.php"><button class="icon"><i class="fas fa-undo" title="regresar"></i></button></a>
<div>
    <p class="indice">Formulario Para entregar herramientas</p>
</div>
<table>
    <tr class="uno">
        <td>cod solicitud</td>
        <td>cod empleado</td>
        <td>proyecto</td>
        <td>codigo proyecto</td> <!-- Campo agregado -->
        <td>fecha salida</td>
        <td>cod herramienta</td>
        <td>cantidad a entregar</td>
        <td>entregar</td>
    </tr>
    <tr>
        <form action="" method="POST" style="border:transparent;">
            <td><input type="text" name="id_registro_solicitud" value="<?php echo $id ?>" readonly style="border:transparent;"></td>
            <td><input type="text" name="codigo_empleado" value="<?php echo $mostrar['cod_emp']; ?>" readonly></td>
            <td><input type="text" name="proyecto" value="<?php echo $mostrar['nombre']; ?>" readonly></td>
            <td><input type="text" name="codigo_proyecto" value="<?php echo $mostrar['cod_proyecto']; ?>" readonly></td> <!-- Campo agregado -->
            <td><input type="text" name="fecha_salida" value="<?php echo $mostrar['fecha_salida']; ?>" readonly></td>
            <td><input type="number" name="cod_herramienta" value="<?php echo $mostrar['cod_herramienta']; ?>" readonly></td>
            <td><input type="number" name="cantidad" max="<?php echo $mostrar['cantidad']; ?>" min="0" autocomplete="off"></td>
            <input type="number" name="cantidad_restante" value="<?php echo $mostrar['cantidad']; ?>" hidden>
            <td><input type="submit" value="registrar" name="enviar" class="botonLoggin"></td>
        </form>
    </tr>
</table>

<?php
    }

if(isset($_POST['enviar']) && $_POST['cantidad'] > 0){
  
    $id_salida = $_POST['id_registro_solicitud'];
    $cod_emp = $_POST['codigo_empleado'];
    $proyecto = $_POST['proyecto'];  // Nombre del proyecto
    $codigo_proyecto = $_POST['codigo_proyecto'];  // Código del proyecto
    $fecha_salida = $_POST['fecha_salida'];
    $cod_herra = $_POST['cod_herramienta'];
    $cantidad = $_POST['cantidad'];
    $cantidad_solicitada_stock = $_POST['cantidad_restante'];

    // Inserción de la herramienta entregada con el código del proyecto
    $consulta2 = "INSERT INTO herramientas_entregadas (codigo_herramienta, cantidad, codigo_solicitud, codigo_empleado, fecha_entregado, codigo_proyecto) 
                  VALUES ('$cod_herra', '$cantidad', '$id_salida', '$cod_emp', '$fecha', '$codigo_proyecto')";
    $ejecutar2 = mysqli_query($conexion, $consulta2);

    if($ejecutar2){
        $consulta3 = "UPDATE herramientas_ocupadas SET cantidad = '$cantidad_solicitada_stock' - '$cantidad' WHERE id_reg_salida = '$id'";
        $ejecutar3 = mysqli_query($conexion, $consulta3);
        
        if($ejecutar3){
            $sentencia = "CALL actualizar_stock($cantidad, $cod_herra);";
            $aumento = mysqli_query($conexion, $sentencia);

            if($aumento){
                $consulta4 = "DELETE FROM herramientas_ocupadas WHERE id_reg_salida = '$id' AND cantidad = '0'";
                $ejecutar4 = mysqli_query($conexion, $consulta4);
                
                if($ejecutar4){
                    echo "<script>alert('Se ha entregado la herramienta con exito')</script>";
                    echo "<script>window.open('herramientasUtlizadas.php', '_self')</script>";
                } else {
                    echo "<script>alert('No se ha eliminado nada')</script>";
                    echo "<script>window.open('herramientasUtlizadas.php', '_self')</script>";
                }
            } else {
                echo "<script>alert('Se ha producido un error en el aumento')</script>";
                echo "<script>window.open('herramientasUtlizadas.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Se ha producido un error en la actualización')</script>";
            echo "<script>window.open('herramientasUtlizadas.php', '_self')</script>";
        }
    } else {
        echo "<script>alert('Se ha producido un error en la inserción')</script>";
        echo "<script>window.open('herramientasUtlizadas.php', '_self')</script>";
    }
}
}
?>
</body>
</html>

