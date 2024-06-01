<?php

    include ('funciones.php');
    conectar_BD();
    session_start();

    if (!isset($_SESSION['num_user'])) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'login.php';
        header("Location: http://$host$uri/$extra");  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cita</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
        body{
            background-color: #ADD8E6;
            margin-top: 7%
        }
        h1{
            color: blue;
        }
        .formulario {
            width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }
        #nombre, #telefono, #fecha, #tipo {
            width: 70%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }  
        #actualizar {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size:100%;
        }   
    </style>
</head>
<body>
<center>
    <?php
    $consulta="select * from citas WHERE num_cita='".$_REQUEST['num_cita']."'";
    $resultado = ejecuta_SQL($consulta);
    $matriz = $resultado->fetchAll();

    foreach ($matriz as $myrow) {	
        list($num_cita, $fecha, $nombre, $num_usuario, $telefono, $tipo)=$myrow;
        echo "<div class='formulario'><form id='form1' action='adminedit.php' method='post'>
        <h1>Edición de la cita</h1>
        <label>Nombre:</label>
        <input type='text' id='nombre' name='nombre' value='$nombre'><br><br>

        <label>Teléfono:</label>
        <input type='tel' id='telefono' name='telefono' value='$telefono'><br><br>

        <label>Fecha:</label>
        <input type='datetime' id='fecha' name='fecha' value='$fecha'><br><br>

        <input type='hidden' name='num_user' value='".$_SESSION['num_user']."'>
        
        <label>Servicio:</label>
        <select id='tipo' name='tipo' value='$tipo'>
            <option value='Corte de cabello'>Corte de cabello</option>
            <option value='Tinte'>Tinte</option>
            <option value='Corte y Barba'>Corte y Barba</option>
            <option value='Lavado y secado'>Lavado y secado</option>
            <option value='Peinado'>Peinado</option>
        </select><br><br>
        <button id='actualizar' type='submit'>Actualizar cita</button><br>
        </form></div>";
    }
    ?>
</center>
</body>
</html>