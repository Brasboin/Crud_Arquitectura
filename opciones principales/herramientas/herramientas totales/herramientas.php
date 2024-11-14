<?php
session_start();

include "../../../conexionBase/conexion.php";

$user=$_SESSION['user'];
if($user == null || $user == ''){
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
    <title>Herramientas Totales</title>
    <link rel="stylesheet" href="../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../estilos/tablas.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<script type="text/javascript" >
    function confirmDelete(id){
        var respuesta = confirm("¿Estas seguro de que quieres eliminar la herramienta?");

        if(respuesta == true){
            return true;
        }else{
            return false;
        }
    }
    </script>
<body>
    <header>
        <div class="banerSuperior">
            <a href="../../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
            <img src="../../../anexos/LOGO.gif" class="imagen1">

            
        </div>
    </header>
    <a href="../principalHerramientas.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <mein>
    <center>
    <a href="excel2.php"  class="myy"><i class="far fa-file-excel">Exportar herramientas totales</i></a>
    </center>
        <table>
            <tr class="uno">
                <td>Código</td>
                <td>Cantidad en empresa</td>
                <td>Nombre</td>
                <td>Marca</td>
                <td>Descripción</td>
                <td>Cantidad Stock</td>
                <td colspan="2">acciones</td>
                <td>solicitar</td>
            </tr>
            <?php
            
            $consulta= "SELECT * FROM herramientas_totales";
            $resultado = mysqli_query($conexion,$consulta);
            while($mostrar=mysqli_fetch_array($resultado)){
                
            ?>
               <tr>
                   
                <td><?php echo $mostrar['cod_herramienta'] ?></td>
                <td><?php echo $mostrar['cantidad_empresa'] ?></td>
                <td><?php echo $mostrar['tipo'] ?></td>
                <td><?php echo $mostrar['marca'] ?></td>
                <td><?php echo $mostrar['descrip'] ?></td>
                <td><?php echo $mostrar['cant_stock'] ?></td>
                <td><a href="eliminar/eliminar.php?id=<?php echo $mostrar['cod_herramienta']?>"><button class="eliminar" onclick="return confirmDelete()">eliminar</button></td></a>
                <td><a  href="editar/editar.php?id=<?php echo $mostrar['cod_herramienta'] ?>"><button class="btn-outline-success">editar</button></a></td>
                <td><a href="solicitar/solicitar.php?id=<?php echo $mostrar['cod_herramienta'] ?>"><button class="btn-outline-success">solicitar</button></a></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </mein>
</body>
</html>