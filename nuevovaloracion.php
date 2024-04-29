<?php

    include ("funciones.php");
    session_start();

    if (!isset($_SESSION['num_user'])) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");  
    }

    conectar_BD();
    imprimir_cabecera();
        
    $fecha=date("Y-m-d");
    $array_fecha=explode ("-",$fecha);
    $fecha_modificada="$array_fecha[2]/$array_fecha[1]/$array_fecha[0]";

  //Este if hace que no se entre al contenido php de este if en el que se inserta los valores en la bd hasta que js valide el formulario y lo envie.
  //Asi evitamos errores de undefined.  
  if(isset($_REQUEST['asunto']) && isset($_REQUEST['contenido'])){


        //Si existe en el formulario num_valoracion_origen, se la asignamos si no le ponemos -1
        if(isset($_REQUEST['num_valoracion_origen'])) $num_valoracion_origen=$_REQUEST['num_valoracion_origen'];
        else $num_valoracion_origen=-1;


        //Si el existe el campo estrellas ejecutamos una consulta. Sino ejecutamos otra y asignamos 0 estrellas a la respuesta.
        if (isset($_REQUEST['estrellas'])){
        $consulta="INSERT INTO valoraciones values(NULL,NOW(),'".$_REQUEST['asunto']."', '".str_replace("'", "\'", $_REQUEST['contenido'])."','".$_SESSION['num_user']."', '".$_REQUEST['estrellas']."','$num_valoracion_origen', 0)";
        $datos=ejecuta_SQL($consulta);
        }
       else{
        $consulta="INSERT INTO valoraciones values(NULL,NOW(),'".$_REQUEST['asunto']."', '".str_replace("'", "\'", $_REQUEST['contenido'])."','".$_SESSION['num_user']."', 0,'$num_valoracion_origen', 0)";
        $datos=ejecuta_SQL($consulta);
       }

       //Modificar para que salgan el numeros de respuestas modificados
        if ($num_valoracion_origen>0) {
            $consulta="UPDATE valoraciones SET num_respuestas=num_respuestas+1 WHERE num_valoracion=".$num_valoracion_origen;
            $datos=ejecuta_SQL($consulta);
        }
        echo "<center><br><br><br><h2 id='correcto'>La valoracion se ha dado de alta correctamente</h2><center>";
    }
    else if (isset($_REQUEST['num_valoracion'])) { 

    //Formulario en el que no se piden las estrellas es decir ha accedido desde el boton responder
        echo "<center><br><br><div class='container'>
        <h2>Responde a la valoración</h2>
        <form id='form1' method='post' action='nuevovaloracion.php'>
        <b><label id='label'>Asunto: </label></b><input id='asunto' type='text' name='asunto' value='' size='40' maxlength='50'><br><br>
        <b><label id='label'>Contenido: </label></b><textarea id='contenido' name='contenido' rows='20' cols='60' wrap=on></textarea><br><br>
        <input type='hidden' name='num_user' value='".$_SESSION['num_user']."'>
        <input type='hidden' name='num_valoracion_origen' value='".$_REQUEST['num_valoracion']."'>
        <input id='aceptar' type='submit' name='enviar' value='Enviar valoración'>
        <input id='borrar' type='reset' name='Borrar' value='Borrar datos'><br><br>
        <label id='mensajeerror'></label>
        </form>
</center></div>";
    }
    else
    //Formulario en el que se piden las estrellas es decir ha accedido desde el boton añadir nueva
        echo "<center><br><br><div class='container'>
            <h2>Publica tu valoración</h2>
            <form id='form1' method='post' action='nuevovaloracion.php'>
            <b><label id='label'>Asunto: </label></b><input id='asunto' type='text' name='asunto' value='' size='40' maxlength='50'><br><br>
            <b><label id='label'>Contenido: </label></b><textarea id='contenido' name='contenido' rows='20' cols='60' wrap=on></textarea><br><br>
            <input type='hidden' name='num_user' value='".$_SESSION['num_user']."'>
            <b><label id='label'>Estrellas: </label></b><select name='estrellas'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
          </select><br><br>
            <input id='aceptar' type='submit' name='enviar' value='Enviar valoración'>
            <input id='borrar' type='reset' name='Borrar' value='Borrar datos'><br><br>
            <label id='mensajeerror'></label>
            </form>
    </center></div>";

    echo "<BR><CENTER><button><a id='volver' href='valoraciones.php'>Volver a las valoraciones</a></button><br></CENTER><br><br>";
    imprimir_piepagina();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Valoración</title>
    <style>
         body{
        background-color: #ADD8E6;
    }
    
    #correcto{
        color:blue;
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
        text-decoration:none;
        color:#FFFF;
        font-size:120%;
    }

    #label{
        font-size:120%;
    }

    .container {
        width: 50%;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    #asunto,textarea,
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #aceptar, #borrar {
        padding: 10px 20px;
        font-size:110%;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #mensajeerror{
        font-size:120%;
        color:blue;
    }
    </style>
</head>
<body>
    <script>
        document.getElementById('form1').addEventListener('submit', function(){
            event.preventDefault();
            var asunto =document.getElementById('asunto').value;
            var contenido =document.getElementById('contenido').value;

            if(asunto==="" || contenido===""){
                document.getElementById('mensajeerror').textContent="No pueden haber campos vacios";
            }
            else if(asunto.length<5 || contenido.length<15) {
                document.getElementById('mensajeerror').textContent = "El asunto debe tener 5 caracteres y el contenido 15 caracteres al menos";
            }
            else {
                document.getElementById('mensajeerror').textContent = ""; 
                this.submit(); 
            }
        });
    </script>
</body>
</html>