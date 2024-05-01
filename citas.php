<?php
    include 'funciones.php';
    imprimir_cabecera();
    session_start();
    
    if (!isset($_SESSION['num_user'])) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'login.php';
        header("Location: http://$host$uri/$extra");  
    }
    conectar_BD(); 

    imprimir_piepagina();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
         body{
        background-color: #ADD8E6;
    }
   </style> 
</head>
<body>
</body>
</html>