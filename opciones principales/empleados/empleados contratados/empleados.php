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
    <title>Lista Empleados</title>
    <link rel="stylesheet" href="../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../estilos/tablas.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>

    <script type="text/javascript" >
    function confirmDelete(id){
        var respuesta = confirm("¿Estas seguro de que quieres eliminar a el empleado?");

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
    </header>
    <a href="../PrincipalEmpleados.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <mein><center>
    <a href="tabla_excel.php"  class="myy"><i class="far fa-file-excel">Exporta datos de empleados</i></a>
                

</center>
        <table>
            <tr class="uno">
                <td>Código</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Dirrección</td>
                <td>Teléfono</td>
                <td>RH</td>
                <td>usuario</td>
                <td>contraseña</td>

                <td colspan="2">Acciones</td>
            </tr>
            <?php
            $consulta="SELECT * FROM empleados";
            $resultado=mysqli_query($conexion,$consulta);
            while($mostrar=mysqli_fetch_array($resultado)){
            ?>
            <tr>
                <td><?php echo $iden=$mostrar['iden_emp']  ?></td>
                <td><?php echo $mostrar['nom_emp']  ?></td>
                <td><?php echo $mostrar['ape_emp']  ?></td>
                <td><?php echo $mostrar['direc_emp']  ?></td>
                <td><?php echo $mostrar['tel_emp']  ?></td>
                <td><?php echo $mostrar['rh']  ?></td>

                <?php
                $consultar="SELECT * FROM usuarios WHERE iden_emp = '$iden'";
                $accion=mysqli_query($conexion,$consultar);
                while($ver=mysqli_fetch_array($accion)){                
                ?>
                <td><?php echo $ver['usuario']  ?></td>
                <td><?php echo $ver['contrasena']?></td>
                <td><a href="eliminar/eliminar.php?id=<?php echo $mostrar['iden_emp'] ?>"><button class="eliminar" onclick="return confirmDelete()">eliminar</button></td></a>
                <td><a  href="actualizar/nuevosDatos.php?id=<?php echo $mostrar['iden_emp'] ?>"><button class="btn-outline-success">editar</button></td>
                <br><br>
                
            </tr>
           
            <?php
            }      
            }

            ?>
        </table>
        
    </mein>
</body>
</html>