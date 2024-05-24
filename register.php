<?php
require("funciones.php");

conectar_BD();
if (isset($_REQUEST['nombre']) && isset($_REQUEST['login']) && isset($_REQUEST['password']) && isset($_REQUEST['email'])){

    $consulta="SELECT nombre, login FROM usuarios WHERE nombre='".$_REQUEST['nombre']."' or login='".$_REQUEST['login']."' ";
    $resultado = ejecuta_SQL($consulta);

    //Si contamos las filas de la consulta y obtenemos un valor distinto de 0 quiere decir que ya esta ese usuario metido en la base de datos.
    if ($resultado->rowCount()>0)
          $errorregister="<p id='fallo'>No se ha podido crear el usuario. Cambie los valores.<p>";
    else   
    {
        $consulta="INSERT INTO usuarios VALUES (NULL,'".$_REQUEST['nombre']."','".$_REQUEST['login']."','".$_REQUEST['password']."','".$_REQUEST['email']."')";
        $resultado = ejecuta_SQL($consulta);
        header('Location: login.php');
}
}   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
         body{
        background-color: #ADD8E6;
        margin-top: 10%;
    }
    .container {
    width: 400px;:
    margin: 0 auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    }

    #mensajeerror, #errorregister{
        font-size:120%;
        color:blue;
    }

    #fallo{
        font-size:120%;
        color:blue;
    }

    #nombre, #username, #contrasena, #email {
    width: 90%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }

    #botones {
    margin-top:25px;
    margin-left:30px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size:100%;
    }

    a{
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    font-size:120%;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <center>
<div class="container">
<h3>NUEVA ALTA</h3>
     <form id='form1' method='post' action='register.php'>
     <table align='center'>
     <tr><td >Nombre:</td>
         <td><input id="nombre" type='text' name='nombre' value='' size='20' maxlength='30'></td></tr>
     <tr><td >Username:</td>
         <td><input id="username" type='text' name='login' value='' size='12' maxlength='20'></td></tr>
     <tr><td >Contraseña:</td>
         <td><input id="contrasena" type='password' name='password' value='' size='12' maxlength='12'></td></tr>
     <tr><td >Email:</td>
         <td><input id="email" type='text' name='email' value='' size='20' maxlength='30'></td></tr>
         <tr align='center'>       
         <td><input id="botones" type='submit' name='Alta' value='Dar de Alta'></td>
         <td><input id="botones" type='reset' name='Borrar' value='Borrar datos'></td></tr>            
    </table><br>

    <?php
        if(isset($errorregister)){
            echo $errorregister;
        }
    ?>
    <label id="mensajeerror"></label>
    </form>
    <br><br><a href='login.php'>Volver a Inicio de Sesión</a>
<div>
<center>

    <script>

        function validarnumero(password){
            for(var i=0; i<password.length; i++){
                if(password[i]==0 || password[i]==1 || password[i]==2 || password[i]==3 || password[i]==4 || password[i]==5 || password[i]==6 || password[i]==7 || password[i]==8 || password[i]==9){
                    return true;
                }
            }
            return false;
        }

        document.getElementById('form1').addEventListener('submit', function(){
            event.preventDefault();
            var username = document.getElementById('username').value;
            var contrasena = document.getElementById('contrasena').value;
            var nombre = document.getElementById('nombre').value;
            var email = document.getElementById('email').value;
            var cajaemail=document.getElementById('email');
            var cajacontrasena=document.getElementById('contrasena');
            var cajausername=document.getElementById('username');

            if (username === "" || contrasena === "" || nombre === "" || email === "") {
                document.getElementById('mensajeerror').textContent = "No pueden haber campos vacios";
             } 
             else if(nombre==username){
                document.getElementById('mensajeerror').textContent = "El nombre y el username no pueden ser iguales ";
                cajausername.focus();
            }
             else if(contrasena.length<8 || !validarnumero(contrasena)){
                document.getElementById('mensajeerror').textContent ="La contrasña debe tener al menos 8 caracteres y contener al menos un número";
                cajacontresena.focus();
             }
             else if (email.indexOf('@') === -1 || (email.endsWith('.com') === false && email.endsWith('.es') === false)) {
                document.getElementById('mensajeerror').textContent ="El email debe contener al menos un '@' y terminar en '.com' o '.es'";
                cajaemail.focus();
             }
             else {
                document.getElementById('mensajeerror').textContent = ""; 
                this.submit();
             }
            });
    </script>
</body>
</html>