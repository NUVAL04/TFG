<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
    body{
        background-color: #ADD8E6;
    }
    button{
    width: 15%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #007bff;
    cursor:pointer;
}

#responderboton{
    width: 50%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #007bff;
    cursor:pointer;
}

#responder{
        font-size:120%;
        text-decoration:none;
        color:#FFFF;
    }
#volver{
    color:#FFFF;
    text-decoration:none;
    font-size:120%;
}

td{
    font-size:120%;
}
    </style>
</head>
<body>
<?php

require("funciones.php");
session_start();

if (!isset($_SESSION['num_user'])) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'login.php';
    header("Location: http://$host$uri/$extra");  
}

conectar_BD();
imprimir_cabecera();

$consulta="SELECT num_valoracion, fecha, asunto, contenido, nombre, estrellas, email FROM valoraciones M, usuarios U
    WHERE M.num_usuario=U.num_usuario AND num_valoracion=".$_REQUEST["num_valoracion"];

$resultado = ejecuta_SQL($consulta);
$matriz = $resultado->fetchAll();
list($num_valoracion, $fecha, $asunto, $contenido, $nombre, $estrellas, $email)=$matriz[0];
$array_fecha=explode ("-",$fecha);
$fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";

echo "<br><table align='center' border=0 width='80%' bgcolor='white'>
    <tr><td colspan='3'><b><U>ASUNTO:</U> <I>$asunto</b></I><td><td align=left rowspan=5><button id='responderboton'><a id='responder' href='nuevovaloracion.php?&num_valoracion=$num_valoracion'>Responder</a></button></td></tr>
    <tr><td width='80%'><b><U>FECHA</U> : $fecha_modificada</b></td></tr>
    <tr><td width='80%'><b><U>ESTRELLAS</U> : $estrellas</b></td></tr>
    <tr><td colspan='3'><b><U>AUTOR</U> : $nombre</b> (<a href='mailto:$email'>$email</a>)<td></tr>
    <tr><td colspan='3'></td></tr></table><br>";
echo "<table  bgcolor='#45ABD9' align='center' border=0 width='80%'><tr><td>$contenido</td></tr></table><BR>"; 

$consulta="SELECT num_valoracion, fecha, asunto, contenido, nombre, email FROM valoraciones M, usuarios U
    WHERE M.num_usuario=U.num_usuario AND num_valoracion_origen=".$_REQUEST["num_valoracion"]." ORDER BY num_valoracion ASC";

$resultado = ejecuta_SQL($consulta);

if ($resultado->rowCount()==0) {
    echo "<table bgcolor='#45ABD9' align='center' border=0 width='80%'><tr><td align='center'>Todavía no hay respuestas</td></tr></table><BR>";
} else {
    echo "<table bgcolor='#45ABD9' align='center' border=0 width='80%'><tr><td align='center'><b><u>Respuestas:</u></b></td></tr></table><BR>";
$matriz = $resultado->fetchAll();
foreach ($matriz as $myrow) {	
    $fecha  =$myrow[1];
    $asunto =$myrow[2];
    $contenido=$myrow[3];
    $nombre =$myrow[4];
    $email  =$myrow[5];
    $array_fecha=explode ("-",$fecha);
    $fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";
    echo "<table bgcolor='#45ABD9' align='center' border=0 width='80%'><tr><td><b>$nombre</b> (<a href='mailto:$email'>$email</a>) respondió el día <b>$fecha_modificada</b>: $contenido</td></tr></table><BR>";
}
}    	     	
echo "</table><br><center><button>
<a id='volver' href='valoraciones.php'>Volver a las valoraciones</a>
</button></center><br><br>";
imprimir_piepagina();
?>
</body>
</html>