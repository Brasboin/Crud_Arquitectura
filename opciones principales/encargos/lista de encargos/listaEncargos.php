<?php

session_start();
include "../../../conexionBase/conexion.php";

$user =$_SESSION['user'];
if($user == null || $user =='')
{
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
    <title>Lista Encargos</title>
    <link rel="stylesheet" href="../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../estilos/tablas.css">
    <link rel="stylesheet" href="../../../estilos/loggin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<script type="text/javascript" >
    function confirmcompra(id){
        var respuesta = confirm("¿Estas seguro de que quieres realizar la venta?");

        if(respuesta == true){
            return true;
        }else{
            return false;
        }
    }
    </script>

<script type="text/javascript" >
    function confircancela(id){
        var respuesta = confirm("¿Estas seguro de que quieres realizar la venta?");

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
    <a href="../principalEncargos.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>

        <p class="indice">Lista de Encargos</p>
        <center>
            <br><br>
            <a href="excel/tabla_excel_encargos.php"  class="myy"><i class="far fa-file-excel">Exporta encargos</i></a>
            
</center>
    </div>
    <mein>
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
                    <td><input type="text" name="identificacion_cliente" placeholder="identificación cliente" autocomplete="off"></td>
                    <td><input type="date" name="fecha" autocomplete="off"> </td>
                    <td><input type="number" name="año" autocomplete="off"  maxlength="4" oninput="maxlengthNumber(this);"></td>
                    <td><input type="number" name="mes" max="12" min="1" autocomplete="off"  maxlength="2" oninput="maxlengthNumber(this);"></td>
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
                <td>código encargo</td>
                <td>identificación cliente</td>
                <td>código empleado</td>
                <td>fecha</td>
                <td>codigo_paquetes</td>
                <td colspan="2">acciones</td>
               
            </tr>
            <?php
            
            if(isset($_POST['consultar'])){
                //reseteo
                if(isset($_POST['consultar']) && $_POST['identificacion_cliente'] == null && $_POST['fecha'] == null && $_POST['año']== null && $_POST['mes']==null ){
                    $consulta="SELECT * FROM encargos";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cod_encargo']  ?></td>
                        <td><?php echo $mostrar['cod_cliente']  ?></td>
                        <td><?php echo $mostrar['cod_empleado']  ?></td>
                        <td><?php echo $mostrar['fecha']  ?></td>
                        <td><?php echo $mostrar['cod_paquetes']  ?></td>
                        <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                        <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                    </tr>
                    <?php
                }
                }
                

                
                // solo identificacion
                if(isset($_POST['consultar']) && strlen($_POST['identificacion_cliente']) > 0 && $_POST['fecha'] == null && $_POST['año'] ==null && $_POST['mes'] ==null ){
                $identificacion=$_POST['identificacion_cliente'];
                $consulta="SELECT * FROM  encargos  WHERE cod_cliente='$identificacion'";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                ?>
                 
                 <tr>
                    <td><?php echo $mostrar['cod_encargo']  ?></td>
                    <td><?php echo $mostrar['cod_cliente']  ?></td>
                    <td><?php echo $mostrar['cod_empleado']  ?></td>
                    <td><?php echo $mostrar['fecha']  ?></td>
                    <td><?php echo $mostrar['cod_paquetes']  ?></td>
                    <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                    <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                    
                </tr>
                <?php
                }
                    
                
                }
                //solo fecha
                if( strlen($_POST['fecha']) > 0 && $_POST['identificacion_cliente'] == null && $_POST['año'] ==null && $_POST['mes'] ==null){
                    $fecha=$_POST['fecha'];
                    $consulta="SELECT * FROM  encargos  WHERE fecha='$fecha'";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    

                    <tr>
                        <td><?php echo $mostrar['cod_encargo']  ?></td>
                        <td><?php echo $mostrar['cod_cliente']  ?></td>
                        <td><?php echo $mostrar['cod_empleado']  ?></td>
                        <td><?php echo $mostrar['fecha']  ?></td>
                        <td><?php echo $mostrar['cod_paquetes']  ?></td>
                        <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                        <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                    </tr>
                    <?php
                    }
                }
                //solo año
                if(strlen($_POST['año'])> 0 && $_POST['identificacion_cliente'] == null && $_POST['fecha'] ==null && $_POST['mes'] ==null ){


                    $año=$_POST['año'];
                    $consulta="SELECT * FROM  encargos  WHERE YEAR(fecha)='$año'";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cod_encargo']  ?></td>
                        <td><?php echo $mostrar['cod_cliente']  ?></td>
                        <td><?php echo $mostrar['cod_empleado']  ?></td>
                        <td><?php echo $mostrar['fecha']  ?></td>
                        <td><?php echo $mostrar['cod_paquetes']  ?></td>
                        <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                        <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                    </tr>
                    <?php
                    }


                }
                //solo mes
                if(strlen($_POST['mes'])> 0 && $_POST['identificacion_cliente'] == null && $_POST['año'] ==null && $_POST['fecha'] ==null){
                    $mes=$_POST['mes'];
                    $consulta="SELECT * FROM  encargos  WHERE MONTH(fecha)='$mes'";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cod_encargo']  ?></td>
                        <td><?php echo $mostrar['cod_cliente']  ?></td>
                        <td><?php echo $mostrar['cod_empleado']  ?></td>
                        <td><?php echo $mostrar['fecha']  ?></td>
                        <td><?php echo $mostrar['cod_paquetes']  ?></td>
                        <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                        <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                    </tr>
                    <?php
                    }
                }
                //todo
                if(isset($_POST['consultar']) && strlen($_POST['identificacion_cliente']) >0 && strlen($_POST['año'])>0 && strlen($_POST['mes'])>0){
                    $mes=$_POST['mes'];
                    $año=$_POST['año'];
                    $identi=$_POST['identificacion_cliente'];
                    $consulta="SELECT * FROM encargos WHERE cod_cliente='$identi' AND YEAR(fecha)='$año' AND MONTH(fecha)='$mes'";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cod_encargo']  ?></td>
                        <td><?php echo $mostrar['cod_cliente']  ?></td>
                        <td><?php echo $mostrar['cod_empleado']  ?></td>
                        <td><?php echo $mostrar['fecha']  ?></td>
                        <td><?php echo $mostrar['cod_paquetes']  ?></td>
                        <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                        <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                    </tr>
                    <?php
                }
                }
                //año y mes
                if(isset($_POST['consultar']) && $_POST['identificacion_cliente']==null && strlen($_POST['año'])>0 && strlen($_POST['mes'])>0){
                    $mes=$_POST['mes'];
                    $año=$_POST['año'];
                    $consulta="SELECT * FROM encargos WHERE YEAR(fecha) = '$año' AND MONTH(fecha)='$mes'";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cod_encargo']  ?></td>
                        <td><?php echo $mostrar['cod_cliente']  ?></td>
                        <td><?php echo $mostrar['cod_empleado']  ?></td>
                        <td><?php echo $mostrar['fecha']  ?></td>
                        <td><?php echo $mostrar['cod_paquetes']  ?></td>
                        <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                        <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                    </tr>
                    <?php
                }
                }

            }else{

                $consulta="SELECT * FROM encargos";
                $resultado=mysqli_query($conexion,$consulta);
                while($mostrar=mysqli_fetch_array($resultado)){
                ?>
                <tr>
                    <td><?php echo $mostrar['cod_encargo']  ?></td>
                    <td><?php echo $mostrar['cod_cliente']  ?></td>
                    <td><?php echo $mostrar['cod_empleado']  ?></td>
                    <td><?php echo $mostrar['fecha']  ?></td>
                    <td><?php echo $mostrar['cod_paquetes']  ?></td>
                    <td><a href="confirmacion.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="btn-outline-success" onclick="return  confirmcompra()">Venta</button></a></td>
                    <td><a href="rechazo.php?id=<?php echo $mostrar['cod_encargo'] ?>" ><button class="eliminar" onclick="return  confircancela()">Cancelación</button></a></td>
                </tr>
                <?php
            }
                }
            ?>
        </table>
    </mein>
</body>
</html>