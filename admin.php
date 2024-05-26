<?php

include 'funciones.php';
    session_start();

    // Controlamos que la sesion sigue activa
    if (!isset($_SESSION['num_user'])) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'login.php';
        header("Location: http://$host$uri/$extra");  
    }
    conectar_BD();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
        body{
            background-color: #ADD8E6;
        }

        h1{
            color: blue;
        }

        th, td{
            font-size:100%;
            padding: 7px;
        }
        .boton {
            padding: 10px 20px;
            margin: 5px;
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
    <h1>Panel de Administración</h1>
     
    <?php

        $consulta="SELECT * FROM citas";
        $resultado=ejecuta_SQL($consulta);
        $matriz = $resultado->fetchAll();

        echo "<br><TABLE BORDER='0' cellspacing='1' cellpadding='1' width='60%' align='center'>
            <TR><th bgcolor='blue'><FONT color='white' face='arial, helvetica'>ID</FONT></th>
                <th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Nombre</FONT></th>
                <th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Fecha</FONT></th>
                <th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Teléfono</FONT></th>
                <th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Tipo</FONT></th>
            </TR>";

            foreach ($matriz as $myrow) {	
                list($num_cita, $fecha, $nombre, $num_usuario, $telefono, $tipo)=$myrow;
                echo "<TR>
                <TD bgcolor='white' align='center'>$num_cita</TD>
                    <TD bgcolor='white' align='center'>$nombre</TD>
                    <TD bgcolor='white' align='center'>$fecha</TD>
                    <TD bgcolor='white' align='center'>$telefono</TD>
                    <TD bgcolor='white' align='center'>$tipo</TD>
                </TR>";
            }
            echo "</table><br><br>";

            echo '<form action="login.php" method="post">
            <input id="logout" type="submit" name="logout" value="Cerrar Sesión" class="boton">
            </form>';
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: login.php");
        }
    ?>
    </center>
</body>
</html>