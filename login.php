<?php

include("funciones.php");

conectar_BD();
 if (isset($_REQUEST['login']) && isset($_REQUEST['password'])){
    
    $consulta="select nombre, num_usuario from usuarios 
        WHERE login='".$_REQUEST['login']."' and password='".$_REQUEST['password']."' ";
    
    $resultado = ejecuta_SQL($consulta);
    if ($resultado->rowCount()>0) {
        $myrow = $resultado->fetchAll();
        //Ahora activamos la sesion con el id del usuario nuevo
        session_start();
        $_SESSION['num_user'] = $myrow[0][1]; //es el num_usuario de select
        
        //Saltamos de pagina
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'home.php';
        header("Location: http://$host$uri/$extra");  
    }
    else
        echo "<BR><BR><center>El usuario y/o la contraseña no coinciden.<br><br></center>";
}
else if (isset($_GET['logout'])){
    $_SESSION[] = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
    
    body{
        background-color: #ADD8E6;
            margin-top: 150px;
    }

.container {
    width: 400px;:
    margin: 0 auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
}

.formulario {
    width: 100%;
}

.label {
    padding-left: 10px;
}

#mensajeerror{
        font-size:120%;
        color:blue;
    }

#username, #password {
    width: 70%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

#aceptar{
    width: 60%;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size:100%;
}
.boton {
    padding: 10px 20px;
    margin: 5px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.boton:hover {
    background-color: #0056b3;
}

.enlace {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}
.enlace:hover {
    text-decoration: underline;
}
p{
    font-size:120%;
}
    </style>
</head>
<body>
    <center>
<div class="container">
    <h3>INICIO DE SESIÓN</h3>
    <form id="form1" method="post" action="login.php">
        <table class="formulario">
            <tr>
                <td class="label">Usuario</td>
                <td><input id="username" type="text" name="login" value="" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <td class="label">Contraseña</td>
                <td><input id="password" type="password" name="password" value="" size="12" maxlength="12"></td>
            </tr>
        </table>
        <br>
        <input id="aceptar" type="submit" name="pulsa" value="Aceptar" class="boton">
    </form>
    <br>
    <label id="mensajeerror"></label>
    <br>
    <p>¿Aún no tienes cuenta? <a href="register.php" class="enlace">Regístrate</a></p>
</div>
</center>

<!--Importante la ubicacion del script. Tiene que estar aqui despues el HTML para que valga-->
<script>
         document.getElementById('form1').addEventListener('submit', function(){
            event.preventDefault();
            var username = document.getElementById('username').value;
            var contrasena = document.getElementById('password').value;

            if (username === "" || contrasena === "") {
                document.getElementById('mensajeerror').textContent = "No pueden haber campos vacios";
             } else {
                document.getElementById('mensajeerror').textContent = ""; 
                this.submit();
             }
    });
    </script>
</body>
</html>