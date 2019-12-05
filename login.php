<?php 
    session_start();
    include_once 'controladores/helpers.php';
    include_once 'controladores/controladorValidacion.php';
    include_once 'controladores/controladorUsuario.php';

    $erroresLogin =[];


    if ($_POST) {
        $erroresLogin = validarFormulario($_POST);
        if (count($erroresLogin) == 0) {
            $usuariosGuardados = file_get_contents("usuarios.json");
             
            $usuariosGuardados = explode(PHP_EOL, $usuariosGuardados);
            array_pop($usuariosGuardados);
            
            
            foreach ($usuariosGuardados as $usuario) {
                $usuario = json_decode($usuario, true);
                if($usuario["email"] == $_POST["email"]){
                    if (password_verify($_POST["password"], $usuario["password"])) {
                        $_SESSION["email"]= $usuario["email"];
                        $_SESSION["nombre"] = $usuario["nombre"];
                        if (isset($_POST["recordarme"]) && $_POST["recordarme"] =="on") {
                            setcookie('emailUsuario', $usuario["email"], time()+ 60 * 60 * 24 *7);
                            setcookie('passUsuario', $usuario["password"], time()+ 60 * 60 * 24 *7);
                        }
                        header("Location:bienvenido.php");
                    }
                }

                
            }
        }
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-12 mt-5">
        <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email" value="<?= persistirDato($erroresLogin, "email"); ?>">
                    <small id="emailHelp" class="form-text text-danger">
                    <?= existeError($erroresLogin, "email"); ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                    <small id="passwordlHelp" class="form-text text-danger"><?= existeError($erroresLogin, "password");?></small>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="recordarme">
                    <label class="custom-control-label" for="customCheck1">Recordarme</label>
                </div>

                <button type="submit" class="btn btn-primary mt-5">Enviar</button>



        </div>
        
        
        
        
        
        
        
        </div>
    
    
    </div>






<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>