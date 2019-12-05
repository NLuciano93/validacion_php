<?php
    session_start();
    include_once 'controladores/helpers.php';
    include_once 'controladores/controladorValidacion.php';
    include_once 'controladores/controladorUsuario.php';

    $erroresRegistro =[];
    $erroresArchivo=[];

    if($_POST){

        $erroresRegistro= validarFormulario($_POST);
        $erroresArchivo = validarImagenPerfil($_FILES);  
       
        
        
        if(count($erroresRegistro) == 0 && count($erroresArchivo) == 0){

            $usuarioRegistro = armarArrayUsuario($_POST);
            $nombreImagen = guardarAvatar($_FILES);

            $usuarioRegistro['avatar'] = $nombreImagen;  
            
        //Guardar en base de datos un array transformado enJSON
          
          $usuarioRegistro = json_encode($usuarioRegistro);
          file_put_contents("usuarios.json", $usuarioRegistro . PHP_EOL, FILE_APPEND);
          header("Location: login.php");
        };

        


       /*  $errores =[];

        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $errores[]= "El mail ingresado no tiene un formato válido";
            
        }else{
            $email = $_POST["email"];
        }

        if (strlen(trim($_POST["nombre"])) < 2) {
            $errores[] = "El nombre ingresado tiene que ser de más de 2 caracteres";
        }else{
            $nombre = $_POST["nombre"];
        }
        if (strlen(trim($_POST["password"])) < 8 || strlen(trim($_POST["password"])) > 15) {
            $errores[] = "La contraseña tiene que tener entre 8 y 15 caracteres";

        }elseif($_POST["password"] != $_POST["rep_password"]){

            $errores[]= "Las contraseñas no coinciden";
        }else{
            $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
        if (count($errores) === 0) {
            header('Location:bienvenido.php');
        }
 */
        
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
       

        <form action="registro.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email" value="<?= persistirDato($erroresRegistro, "email"); ?>">
                    <small id="emailHelp" class="form-text text-danger">
                    <?= existeError($erroresRegistro, "email"); ?>
                    
                    </small>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp" placeholder="Nombre" name="nombre" value="<?= persistirDato($erroresRegistro, "nombre"); ?>">
                    <small id="nombrelHelp" class="form-text text-danger"><?= existeError($erroresRegistro, "nombre");?></small>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                    <small id="passwordlHelp" class="form-text text-danger"><?= existeError($erroresRegistro, "password");?></small>
                </div>
                <div class="form-group">
                    <label for="repassword">Repetir contraseña</label>
                    <input type="password" class="form-control" id="rep_password" placeholder="Repetir Contraseña" name="repassword">
                    <small id="repasswordHelp" class="form-text text-danger"><?=existeError($erroresRegistro, "repassword");?></small>
                </div>
               
                <div class="custom-file mt-3">
                    
                    <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="imagenPerfil">
                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                    <small id="archivoHelp" class="form-text text-danger"><?=existeError($erroresArchivo, "imagenPerfil");?></small>
                </div>
                    
                

                <button type="submit" class="btn btn-primary mt-5">Enviar</button>
        </form>
        
        </div>
        
        
        
        
        
        
        
        </div>
    
    
    </div>






<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
        $('.custom-file-input').on('change', function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).parent()
                .find('.custom-file-label')
                .html(inputFile.files[0].name);
        }); 
</script>
</body>
</html>