<?php

function armarArrayUsuario($array){
    $usuarioRegistro = [
        "nombre" => trim($array["nombre"]),
        "email" => $array["email"],
        "password" => password_hash($array["password"], PASSWORD_DEFAULT)
    ];

    return $usuarioRegistro;
}




?>