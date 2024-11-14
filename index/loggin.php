<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loggin</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="../estilos/loggin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
</head>
<body>
    <header>
     <div class="banerSuperior">
         <!-- <img src="../anexos/LOGO.gif" class="imagen1"> -->
         
         
        </div>
     </header>
     <mein>
         <div class="saludo">
            <p>Bienvenido al sistema de informacion de la empresa VOGRUP</p>
         </div>
         <div class="formula">
          
           <form  method="POST">
             <p class="linea" ><i class="far fa-user"></i>  Ingrese el Usuario:</p>
             <input type="text" name="usu" placeholder="usuario" autocomplete="off"  required >
             <br>
             <p class="linea"><i class="fas fa-unlock"></i> Ingrese la Contraseña:</p>
             <input type="password" name="con" placeholder="contraseña" required>
             <br>
             <input type="submit" name="enviar" value="validar" class="botonLoggin">
             <br>
             
            </form>
              
          <?php
          
          include '../validacion/validar.php';
          ?>
         </div>  
         
     </mein>
        <footer>
       
        </footer>

</body>
</html>