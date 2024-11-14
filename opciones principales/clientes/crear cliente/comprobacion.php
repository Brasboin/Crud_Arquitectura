<?php


include "../../../conexionBase/conexion.php";





if(isset($_POST['enviar'])){
    $id_cli=$_POST['identi'];
    $nom_cli=$_POST['nombre'];
    $ape_cli=$_POST['apellido'];
    $direc_cli=$_POST['direccion'];
    $tel_cli=$_POST['tel'];
    $corr_cli=$_POST['correo'];


    $consulta="INSERT INTO clientes(iden_cli, nom_cli, ape_cli, direc_cli, tel_cli,correo) VALUES ('$id_cli','$nom_cli','$ape_cli','$direc_cli','$tel_cli','$corr_cli')";
    $ejecucion=mysqli_query($conexion,$consulta);
    if($ejecucion){
        ?>
        <h3 class="ok">SE HA REGISTRADO CORRECTAMENTE EL CLIENTE</h3>
        <?php
    }else{
        ?>
        <h3 class="bad">HA OCURRIDO UN ERROR</h3>
        <?php
    }
}



?>

