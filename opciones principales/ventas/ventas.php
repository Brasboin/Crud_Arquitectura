<?php

session_start();

include "../../conexionBase/conexion.php";
$user = $_SESSION['user'];
if($user == null || $user == '')
{
    header("Location: ../validacion/ingresoCorrupto.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../estilos/botones.css">
    <link rel="stylesheet" href="../../estilos/loggin.css">
    <link rel="stylesheet" href="../../estilos/tablas.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<body>
<header>
    
        <div class="banerSuperior">
            <a href="../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
            <img src="../../anexos/LOGO.gif" class="imagen1">
        </div>
     </header>
     <?php
       if($user =='andres'){
        ?>
        <a href="../../pagina principal/paginaPrincipal.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
        <?php
    }else{
        ?>
        <a href="../../pagina principal/paginaPrincipalEmpleados.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
        <?php
    }
     ?>  
     <mein>
     <center>
    <a href="excel6.php"  class="myy"><i class="far fa-file-excel">Exportar lista de ventas</i></a>
                

</center>
        <form action="" method="POST" class="filtro" >
            <table>
                <tr class="uno">
                    <td>buscar identificacion</td>
                    <td>buscar fecha especifica</td>
                    <td>buscar año</td>
                    <td>buscar mes</td>
                    <td>consultar</td>
                   
                    
                </tr>
                <tr>  
                    <td><input type="text" name="identificacion_cliente" placeholder="identificación cliente"></td>
                    <td><input type="date" name="fecha"> </td>
                    <td><input type="number" name="año" maxlength="4" oninput="maxlengthNumber(this);"></td>
                    <td><input type="number" name="mes" max="12" min="1"  maxlength="2" oninput="maxlengthNumber(this);"></td>
                    <td><input type="submit" name="consultar" value="consultar" class="botonLoggin"></td>

        
                </tr> 
          
                
                    
                 

            </table>
        </form>

        <script>
            function maxlengthNumber(obj){
                console.log(obj.value);
                if(obj.value.length>obj.maxLength){
                    obj.value=obj.value.slice(0,obj.maxLength);
                }
            }
        </script>


        <table>
            <tr class="uno">
                <td>codigo venta</td>
                <td>código encargo</td>
                <td>identificación cliente</td>
                <td>identificación empleado</td>
                <td>fecha</td>
                <td>codigo_paquetes</td>
               
            </tr>
            <?php
            
            if(isset($_POST['consultar'])){
                //reinicio
            if(isset($_POST['consultar']) && $_POST['identificacion_cliente'] == null && $_POST['fecha'] == null && $_POST['año']== null && $_POST['mes']==null ){
                
                $consulta="SELECT * FROM ventas";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                ?>

                <tr>
                        <td><?php echo $mostrar['cod_venta']; ?></td>
                        <td><?php echo $mostrar['cod_encargo']; ?></td>
                        <td><?php echo $mostrar['cod_cliente']; ?></td>
                        <td><?php echo $mostrar['cod_empleado']; ?></td>
                        <td><?php echo $mostrar['fecha']; ?></td>
                        <td><?php echo $mostrar['cod_paquetes'];?></td>
                   
                </tr>
                <?php
                }
            
            }
                //solo identificacion
            if(isset($_POST['consultar']) && strlen($_POST['identificacion_cliente']) > 0 && $_POST['fecha'] == null && $_POST['año']== null && $_POST['mes']==null){
             $identificacion=$_POST['identificacion_cliente'];
             $consulta="SELECT * FROM  ventas  WHERE cod_cliente='$identificacion'";
             $resultado=mysqli_query($conexion,$consulta);
             while($mostrar=mysqli_fetch_array($resultado)){
             ?>
                 <a href="excel_identi.php?<?php echo$_POST['identificacion_cliente'] ?>" class="myy"><i class="far fa-file-excel">Exportar lista de ventas</i></a>     
             <tr>
                    <td><?php echo $mostrar['cod_venta']; ?></td>
                    <td><?php echo $mostrar['cod_encargo']; ?></td>
                    <td><?php echo $mostrar['cod_cliente']; ?></td>
                    <td><?php echo $mostrar['cod_empleado']; ?></td>
                    <td><?php echo $mostrar['fecha']; ?></td>
                    <td><?php echo $mostrar['cod_paquetes'];?></td>
                
             </tr>
             <?php
             } 
             
             }
             //solo fecha especifica
             if(isset($_POST['consultar']) && strlen($_POST['fecha']) > 0 && $_POST['identificacion_cliente'] == null && $_POST['año']== null && $_POST['mes']==null){
                 $fecha=$_POST['fecha'];
                $consulta="SELECT * FROM  ventas  WHERE fecha='$fecha'";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                ?>
                <tr>
                    <td><?php echo $mostrar['cod_venta']; ?></td>
                    <td><?php echo $mostrar['cod_encargo']; ?></td>
                    <td><?php echo $mostrar['cod_cliente']; ?></td>
                    <td><?php echo $mostrar['cod_empleado']; ?></td>
                    <td><?php echo $mostrar['fecha']; ?></td>
                    <td><?php echo $mostrar['cod_paquetes'];?></td>
                   
                </tr>
                <?php
                }
             }
             //solo año
             if(isset($_POST['consultar']) && strlen($_POST['año'])>0 && $_POST['fecha'] == null && $_POST['identificacion_cliente']== null && $_POST['mes']==null){


                $año=$_POST['año'];
                $consulta="SELECT * FROM  ventas  WHERE YEAR(fecha)='$año'";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                ?>
                <tr>
                    <td><?php echo $mostrar['cod_venta']; ?></td>
                    <td><?php echo $mostrar['cod_encargo']; ?></td>
                    <td><?php echo $mostrar['cod_cliente']; ?></td>
                    <td><?php echo $mostrar['cod_empleado']; ?></td>
                    <td><?php echo $mostrar['fecha']; ?></td>
                    <td><?php echo $mostrar['cod_paquetes'];?></td>
                   
                </tr>
                <?php
                }


             }
             //solo mes
             if(isset($_POST['consultar']) && strlen($_POST['mes'])> 0 && $_POST['fecha'] == null && $_POST['año']== null && $_POST['identificacion_cliente']==null){
                $mes=$_POST['mes'];
                $consulta="SELECT * FROM ventas WHERE MONTH(fecha)='$mes'";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cod_venta']; ?></td>
                        <td><?php echo $mostrar['cod_encargo']; ?></td>
                        <td><?php echo $mostrar['cod_cliente']; ?></td>
                        <td><?php echo $mostrar['cod_empleado']; ?></td>
                        <td><?php echo $mostrar['fecha']; ?></td>
                        <td><?php echo $mostrar['cod_paquetes'];?></td>
                       
                    </tr>
                    <?php
                    }
    
             }
             //todo
             if(isset($_POST['consultar']) && strlen($_POST['mes'])> 0 && $_POST['fecha']==null && strlen($_POST['año'])> 0 && strlen($_POST['identificacion_cliente'])> 0){
                 $mes=$_POST['mes'];
                 $identificacion=$_POST['identificacion_cliente'];
                 $año=$_POST['año'];
                $consulta="SELECT * FROM ventas WHERE MONTH(fecha)= '$mes' and cod_cliente='$identificacion' and YEAR(fecha)='$año'";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cod_venta']; ?></td>
                        <td><?php echo $mostrar['cod_encargo']; ?></td>
                        <td><?php echo $mostrar['cod_cliente']; ?></td>
                        <td><?php echo $mostrar['cod_empleado']; ?></td>
                        <td><?php echo $mostrar['fecha']; ?></td>
                        <td><?php echo $mostrar['cod_paquetes'];?></td>
                       
                    </tr>
                    <?php
                    }
             }
             //mes y año
             if(isset($_POST['consultar']) && $_POST['identificacion_cliente'] ==null && $_POST['fecha'] == null && strlen($_POST['año'])>0 && strlen($_POST['mes'])>0){
                $año=$_POST['año'];
                $mes=$_POST['mes'];

                $consulta="SELECT * FROM  ventas  WHERE MONTH(fecha)='$mes' and YEAR(fecha)='$año'";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                ?>
                <tr>
                       <td><?php echo $mostrar['cod_venta']; ?></td>
                       <td><?php echo $mostrar['cod_encargo']; ?></td>
                       <td><?php echo $mostrar['cod_cliente']; ?></td>
                       <td><?php echo $mostrar['cod_empleado']; ?></td>
                       <td><?php echo $mostrar['fecha']; ?></td>
                       <td><?php echo $mostrar['cod_paquetes'];?></td>
                   
                </tr>
                <?php
                } 
                
                }


            }else{

            $consulta="SELECT * FROM ventas";
            $resultado=mysqli_query($conexion,$consulta);
            while($mostrar=mysqli_fetch_array($resultado)){
            ?>
            <tr>
                    <td><?php echo $mostrar['cod_venta']; ?></td>
                    <td><?php echo $mostrar['cod_encargo']; ?></td>
                    <td><?php echo $mostrar['cod_cliente']; ?></td>
                    <td><?php echo $mostrar['cod_empleado']; ?></td>
                    <td><?php echo $mostrar['fecha']; ?></td>
                    <td><?php echo $mostrar['cod_paquetes'];?></td>
               
            </tr>
            <?php
            }
                }
            ?>
        </table>
    </mein>
</body>
</html>
