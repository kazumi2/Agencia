<?php 

  
  session_start();    // Siempre iniciar la sesión antes de usar $_SESSION
  if($_SERVER["REQUEST_METHOD"]== "POST"){
  if(($_POST['usuario']=="brenda") && ($_POST['contrasenia']=="sistema")){
    $_SESSION['usuario']="OK";
    $_SESSION['nombreUsuario']="brenda";
    header('Location:inicio.php');
    exit(); // Redirige solo si es correcto
  } else{
    $mensaje="Error: El usuario y la contrasenia son incorrectos";
  }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
      <link rel="stylesheet" href="../assets/css/adminitrador.css">

    <title>Document</title>
</head>
<body>     

<div class="container">
        <div class="row">          
<div class="col-md-4">   <!-- agrego b4grid-col-->    
    </div>
    
            <div class="col-md-4">
                  <br> <br> <!-- espacio-->
              <div class="card">
                <div class="card-header">
                Iniciar sección
                </div>
                <div class="card-body">
                <!--mensaje de error-->
                <?php if(isset($mensaje)){?>
                <div class="alert alert-danger" role="alert">
                  <strong>danger</strong>
                  <?php echo $mensaje;}?>
                
                </div>

                
                   <form method="post">

                   <div class = "form-group">
                   <label for="exampleInputEmail1">Usuario</label>
                   <input type="text" class="form-control" id="exampleInputEmail1" name="usuario" aria-describedby="emailHelp" placeholder="Ingrese Usuario">                 
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputPassword1">Contraseña</label>
                   <input type="password" class="form-control" id="exampleInputPassword1" name="contrasenia" placeholder="contraseña">
                   </div>
                   
                   <button type="submit" class="btn btn-primary">Ingresar al Administrador</button>
                   </form>
                   
                   
                </div>
                
              </div>
            
            </div>
            
        </div>
     </div>
    
  </body>
</html>