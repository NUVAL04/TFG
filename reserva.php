<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Reserva</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
        body{
            background-color:#ADD8E6;
        }

        button{
            width: 15%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #007bff;
            cursor:pointer;
         }

        #volver{
            color:#FFFF;
            text-decoration:none;
            font-size:120%;
        }   
        
        td{
            padding:15px;
            font-size:120%;
        }

        th{
            padding:15px;
            color:#FFFF;
            background-color:#007bff;
            font-size:120%;
        }
    </style>
</head>
<body>
    <?php
        include('funciones.php');
        session_start();

        if (!isset($_SESSION['num_user'])) {
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'login.php';
        header("Location: http://$host$uri/$extra");  
        }

        conectar_BD();

        imprimir_cabecera(); 
        $consulta = "SELECT * FROM citas ORDER BY num_cita DESC LIMIT 1";
        $resultado = ejecuta_SQL($consulta);
        if ($resultado->rowCount() > 0) {
            $matriz = $resultado->fetchAll();

            echo "<br><br><center><table><thead><th colspan='2'>Datos de la reserva</th></thead>";
            foreach ($matriz as $myrow) {	
                list($num_cita, $fecha, $nombre, $num_usuario, $telefono, $tipo)=$myrow;
                $fecha_modificada = date("d-m-Y H:i:s", strtotime($fecha));
                echo "<tr><td><b>Número cita:</b></td><td bgcolor='white' align='center'>$num_cita</td></tr>
                      <tr><td><b>Nombre:</b></td><td bgcolor='white' align='center'>$nombre</td></tr>
                      <tr><td><b>Fecha y hora:</b></td><td bgcolor='white' align='center'>$fecha_modificada</td></tr>
                      <tr><td><b>Teléfono:</b></td><td bgcolor='white' align='center'>$telefono</td></tr>
                      <tr><td><b>Servicio:</b></td><td bgcolor='white' align='center'>$tipo</td></tr>";       
            }
            echo "</table></center><br><br>";
        } else {
            echo "No se encontraron reservas.";
        }
        echo "<center><button><a id='volver' href='citas.php'>Volver a las citas</a></button></center><br><br>"; 

        imprimir_piepagina();
    ?>
</body>
</html>