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
    <title>Lista de paquetes</title>
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
    </header>
    <a href="../principalPaquetes.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <center>
    <a href="excel4.php"  class="myy"><i class="far fa-file-excel">Exportar lista de paquetes</i></a>
                

</center>
    <table >
              <tr class="uno">
                  <td>codigo paquete</td>
                  <td>valor</td>
                  <td>descripcion</td>
                  <td colspan="2">acciones</td>
                
              </tr>
              <?php
              $consulta="SELECT * FROM paquetes";
              $resultado=mysqli_query($conexion,$consulta);
              while($mostrar=mysqli_fetch_array($resultado)){
              ?>
              <tr>
         
                <td><?php echo $mostrar['cod_paquete']   ?></td>
                <td><?php echo $mostrar['valor']   ?></td>
                <td><?php echo $mostrar['descrip']   ?></td>
                <td><a href="eliminar/eliminar.php?id=<?php echo $mostrar['cod_paquete']?>"><button class="eliminar" onclick="return confirmDelete()">eliminar</button></a></td>
                <td><a  href="editar/editar.php?id=<?php echo $mostrar['cod_paquete'] ?>"><button class="btn-outline-success">editar</button></a></td>
             
                
              
                </tr>
                <?php
              }
              
                ?>
            </table>
</body>
</html>