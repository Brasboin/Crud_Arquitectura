<?php
session_start();

include "../../../../conexionBase/conexion.php";

$user=$_SESSION['user'];
if($user == null || $user == ''){
    header("Location:../../../../validacion/ingresoCorrupto.php ");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar herramienta</title>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevos Datos</title>
    <link rel="stylesheet" href="../../../../estilos/estilogeneral.css">
    <link rel="stylesheet" href="../../../../estilos/botones.css">
    <link rel="stylesheet" href="../../../../estilos/tablas.css">
    <link rel="stylesheet" href="../../../../estilos/loggin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
</head>
<body>
<header>
        <div class="banerSuperior">
            <a href="../../../../cerrar sesion/cierre.php" ><button class="cerrar">CERRAR SESIÓN</button></a>
            <img src="../../../../anexos/LOGO.gif" class="imagen1">
    </header>
    <a href="../herramientas.php"><button class="icon"><i class="fas fa-undo" title="regresar"></button></i></a>
    <div>
        <p class="indice">Formulario Para editar Herramientas</p>
    </div>
    <?php
    
    $id_herra=$_GET['id'];
    
   $consulta = "SELECT * FROM herramientas_totales WHERE cod_herramienta = '$id_herra'";
   $ejecucion = mysqli_query($conexion,$consulta);
   while($mostrar=mysqli_fetch_array($ejecucion)){



     $cant_ant =$mostrar['cantidad_empresa'];
     $mar_ant=$mostrar['marca'];
     $tipo_ant=$mostrar['tipo'];
     $descrp_ant=$mostrar['descrip'];





    
    
    ?>
    <mein class="formula">
        <form action="" method="POST" class="formulario"  >
            <input type="text" name="codigo" value="<?php echo $mostrar['cod_herramienta'];  ?>" readonly class="registro">
            <input type="number" name="cantidad_empres" value="<?php echo $mostrar['cantidad_empresa'];  ?>" class="registro" autocomplete="off">
            <input type="text" name="marc" value="<?php echo $mostrar['marca'];  ?>" class="registro" autocomplete="off">
            <input type="text" name="tipo" value="<?php echo $mostrar['tipo'];  ?>" class="registro" autocomplete="off">
            <input type="text" name="descri" value="<?php echo $mostrar['descrip'];  ?>" class="registro" autocomplete="off">
            <input type="number" name="cantidad_inicial" value="<?php echo $mostrar['cantidad_empresa'];  ?>" hidden>
            <input type="number" name="cantidad_stock" value="<?php echo $mostrar['cant_stock'];  ?>" hidden>


            <input type="submit" name="enviar" value="actualizar" class="botonLoggin">
        </form>

        <?php
        
        }

        if(isset($_POST['enviar'])){

            $cod=$_POST['codigo'];
            $cant=$_POST['cantidad_empres'];
            $marca=$_POST['marc'];
            $tipo=$_POST['tipo'];
            $descrip=$_POST['descri'];
            $cantidad_stock=$_POST['cantidad_stock'];
            $ini=$_POST['cantidad_inicial'];
            $fecha=date("y/m/d");
            
            

            $consul="SELECT * FROM usuarios WHERE usuario='$user'";
            $ejecuta=mysqli_query($conexion,$consul);
            while($mostrarr=mysqli_fetch_array($ejecuta)){
                echo $identificacion=$mostrarr['iden_emp'];
            }
            if($ejecuta){




            if($cant== $ini){
                $cantidad_stock_total =$cantidad_stock;
            }else{
                if($cant > $ini){
                    $operacion = $cant - $ini;
                    $cantidad_stock_total=$cantidad_stock + $operacion;
                }else{
                    $operacion = $ini - $cant;
                    $cantidad_stock_total=$cantidad_stock - $operacion;
                }
            }
        
            

               
                

                if($ejecuta){

                    $insertar="INSERT INTO actualizaciones(cod_herramienta, iden_emp, fecha, cantidad_ant, marca_ant, descrip_ant, tipo_ant, cantidad_new, marca_new, descrip_new, tipo_new) VALUES ('$id_herra','$identificacion','$fecha','$cant_ant','$mar_ant','$descrp_ant','$tipo_ant','$cant','$marca','$descrip','$tipo')";
                    $realizar= mysqli_query($conexion,$insertar);
            


                        if($realizar){
                            $consulta="UPDATE herramientas_totales set cantidad_empresa='$cant', marca='$marca',tipo='$tipo',descrip='$descrip', cant_stock='$cantidad_stock_total' WHERE cod_herramienta = '$id_herra'";
                            $ejecucion=mysqli_query($conexion,$consulta);
                    
            


                            if($ejecucion){
                                echo "<script>
                                    alert('SE HA ACTUALIZADO CORRECTAMENTE');
                                    window.location.href = '../herramientas.php';
                                  </script>";
                            }else{
                                
                            }
                        }else{
                                ?>
                                <h3 class="bad">SE HA PRODUCIDO UN ERROR EN LA SEGUNDA INSERCIÓN </h3>
                                <?php
                        }







                    }

                }
            }
                    



        ?>



    </mein>
</body>
</html>