<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valoraciones</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
         body{
        background-color: #ADD8E6;
    }

    td{
        font-size:150%;
    }

    th{
        font-size:150%;
        padding: 7px;
    }
    
    h1{
        text-align:center;
        color: blue;
    }

    button{
        width: 15%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #007bff;
        cursor:pointer;
    }
    #añadir{
        font-size:120%;
        text-decoration:none;
        color:#FFFF;
    }
    </style>
</head>
<body>


<?php
    include 'funciones.php';
    imprimir_cabecera();
    session_start();

    // Controlamos que la sesion sigue activa
    if (!isset($_SESSION['num_user'])) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'login.php';
        header("Location: http://$host$uri/$extra");  
    }
    conectar_BD(); 
    
    echo "<br><h1>Valoraciones aportadas por los usuarios</h1><br>";
        
        //Consulta que coje dos tablas puesto que pide información de dos tablas y además deja fuera las que son respuestas.
        $consulta="SELECT num_valoracion, fecha, asunto, nombre, estrellas, num_respuestas
            FROM valoraciones M, usuarios U WHERE M.num_usuario=U.num_usuario and num_valoracion_origen<0";
        $resultado=ejecuta_SQL($consulta);
        $matriz = $resultado->fetchAll();
        echo "<br><TABLE BORDER='0' cellspacing='1' cellpadding='1' width='60%' align='center'>
            <TR><th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Fecha</FONT></th>
                <th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Asunto</FONT></th>
                <th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Autor</FONT></th>
                <th bgcolor='blue'><FONT color='white' face='arial, helvetica'>Estrellas</FONT></th>
                <th bgcolor='blue' width=100><FONT color='white' face='arial, helvetica'>Respuestas</FONT></th>
            </TR>";
        foreach ($matriz as $myrow) {	
            list($num_valoracion, $fecha, $asunto, $nombre, $estrellas, $num_respuestas)=$myrow;
            $array_fecha=explode ("-",$fecha);
            $fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";
            echo "<TR>
                <TD bgcolor='white' align='center'>$fecha_modificada</TD>
                    <TD bgcolor='white' align='center'><a href='contenido.php?num_valoracion=$num_valoracion'>$asunto</a></TD>
                    <TD bgcolor='white' align='center'>$nombre</TD>
                    <TD bgcolor='white' align='center'>$estrellas</TD>
                    <TD bgcolor='white' align='center'>$num_respuestas</TD>
                </TR>";       
        }
        echo "</table><BR><Center>";
        echo "<br><button>";
       echo "<a id='añadir' href='nuevovaloracion.php'>Añadir Valoración</a>";
    echo "</button><br><br>";

    imprimir_piepagina();
?>


</body>
</html>