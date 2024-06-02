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

    if(isset($_REQUEST['actualizar'])){
        $num_cita = $_REQUEST['num_cita'];
        $nombre_nuevo = $_REQUEST['nombre'];
        $telefono_nuevo = $_REQUEST['telefono'];
        $fecha_nueva = $_REQUEST['fecha'];
        $tipo_nuevo = $_REQUEST['tipo'];
        $num_user = $_SESSION['num_user'];
    
        $consulta = "SELECT fecha FROM citas WHERE num_cita = '$num_cita'";
        $resultado = ejecuta_SQL($consulta);
        $fecha_actual = $resultado->fetchColumn();
    
        $timestamp_actual = strtotime($fecha_actual);
        $timestamp_nuevo = strtotime($fecha_nueva);
        // Comprobar si la fecha ha cambiado

        if ($timestamp_nuevo != $timestamp_actual) {
            // Consulta para verificar si la nueva fecha ya está reservada
            $consulta = "SELECT COUNT(*) FROM citas WHERE fecha = '$fecha_nueva'";
            $resultado = ejecuta_SQL($consulta);
            $matriz = $resultado->fetchColumn();
    
            if ($matriz > 0) {
                $errorcita = "<p id='errorcita'>Esta hora ya está reservada. Intente coger otra.<p>";
            } else {
                // Actualizar la cita si la nueva fecha no está reservada
                $consulta = "UPDATE citas SET nombre = '$nombre_nuevo' , telefono = '$telefono_nuevo', fecha = '$fecha_nueva', tipo = '$tipo_nuevo' , num_usuario = '$num_user' WHERE num_cita = '$num_cita'";
                ejecuta_SQL($consulta);
                header("Location: admin.php");
                $errorcita="";
                exit;
            }
        } else {
            // Actualizar la cita si la fecha no ha cambiado
            $consulta = "UPDATE citas SET nombre = '$nombre_nuevo', telefono = '$telefono_nuevo', tipo = '$tipo_nuevo' , num_usuario = '$num_user' WHERE num_cita = '$num_cita'";
            ejecuta_SQL($consulta);
            header("Location: admin.php");
            $errorcita="";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cita</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
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

        #volver{
            text-decoration:none;
            color:#FFFF;
            font-size:120%;
        }
        #botonvolver{
            width: 12%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #007bff;
            cursor:pointer;
        }

        #mensajeerror, #errorcita{
        font-size:120%;
        color:blue;
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
        echo "<div class='formulario'><form id='form1' action='adminedit.php?num_cita=$num_cita' method='post'>
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
        </select><br><br>";
        if(isset($errorcita)){
            echo $errorcita;
        }
        echo "<label id='mensajeerror'></label><br><br>
        <button id='actualizar' name='actualizar' type='submit'>Actualizar cita</button><br>
        </form></div><br><br>";

        echo "<button id='botonvolver'><a id='volver' href='admin.php'>Volver al panel</a></button>";
    }

    ?>
</center>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr("#fecha", {
        enableTime: true,
        minDate: "today",
        dateFormat: "Y-m-d H:i",
        minTime: "09:00",
        maxTime: "18:00",
        minuteIncrement: 30,
        disable: [
            function(date) {
                // Aquí deshabilitamos los sábados (6) y domingos (0)
                return (date.getDay() === 6 || date.getDay() === 0);
            }
        ],
        locale: {
            firstDayOfWeek: 1, // Lunes como primer día de la semana
            weekdays: {
                shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            },
            months: {
                shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            }
        }
    });

    function validarnombre(nombre) {
        for (var i = 0; i < nombre.length; i++) {
            var charCode = nombre.charCodeAt(i);
            // Los códigos de caracteres de A-Z, a-z son entre 65-90, 97-122 respectivamente. El 32 es codigo del espacio
            if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode !== 32) {
                return false;
            }
        }
        return true;
    }

    document.getElementById('form1').addEventListener('submit', function() {
        var nombre = document.getElementById('nombre').value;
        var fecha = document.getElementById('fecha').value;
        var tipo = document.getElementById('tipo').value;
        var telefono = document.getElementById('telefono').value;
        var cajatelefono = document.getElementById('telefono');
        var cajanombre = document.getElementById('nombre');

        if (nombre === "" || fecha === "" || tipo === "" || telefono === "") {
            document.getElementById('mensajeerror').textContent = "No pueden haber campos vacios";
            event.preventDefault();
        } else if (!validarnombre(nombre)) {
            document.getElementById('mensajeerror').textContent = "El nombre no puede tener números ni caracteres especiales";
            cajanombre.focus();
            event.preventDefault();
        } else if (telefono.length !== 9 || isNaN(telefono)) {
            document.getElementById('mensajeerror').textContent = "El teléfono tiene que tener 9 digitos y solo pueden ser números";
            cajatelefono.focus();
            event.preventDefault();
        } else {
            document.getElementById('mensajeerror').textContent = "";
        }
    });
</script>
</body>
</html>