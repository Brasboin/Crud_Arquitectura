 <?php
session_start();
include "../../../conexionBase/conexion.php";

if (isset($_GET['id']) && isset($_GET['fecha'])) {
    $id_proyecto = $_GET['id'];
    $fecha_final = $_GET['fecha'];

    $consulta = "UPDATE proyectos SET fecha_final='$fecha_final' WHERE Id_proyecto='$id_proyecto'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script>alert('El proyecto ha sido cerrado correctamente.')</script>";
        echo "<script>window.open('../lista clientes/clientes.php', '_self')</script>";
    } else {
        echo "<script>alert('Ocurrió un error al cerrar el proyecto.')</script>";
        echo "<script>window.open('../clientes.php', '_self')</script>";
    }
}
?>
