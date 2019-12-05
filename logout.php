<?php
    session_start();
    session_destroy();
    setcookie('emailUsuario', null, -1);
    setcookie('passUsuario', null, -1);
    header("Location: index.php");

    ?>