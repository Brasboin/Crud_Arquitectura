
<?php

session_start();
include "../conexionBase/conexion.php";
 if(isset($_POST['enviar'])){
$credencial = $_POST['usu'];
$contra = $_POST['con'];


$consulta = "SELECT * from usuarios WHERE usuario = '$credencial' and contrasena = '$contra'";
$resultado = mysqli_query($conexion, $consulta);
$cant = mysqli_num_rows ($resultado);
 
if($cant > 0)
{  
     if($credencial == 'andres'){
      $_SESSION['user'] = $credencial;
    header("Location: ../pagina principal/paginaPrincipal.php");
}else{
    $_SESSION['user'] = $credencial;
    header("Location: ../pagina principal/paginaPrincipalEmpleados.php");    
  }
} else{
    ?>
    <h2 class="bad">usuario o contraseña invalidos</h2>
    <?php   
}

}
?>