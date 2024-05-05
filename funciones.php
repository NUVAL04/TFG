<?php

$DBHost="localhost";
$DBUser="root";
$DBPass="";
$DB="tfg";
$id_conexion=-1;

function conectar_BD() 
   {
      global $DBHost, $DBUser, $DBPass, $DB, $id_conexion;

      try {
         $id_conexion = new PDO("mysql:host=" . $DBHost. ";dbname=" . $DB. ";charset=utf8", 
            $DBUser, $DBPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
         $id_conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,  true);
         $id_conexion->setAttribute(PDO::NULL_TO_STRING, true);
      } 
      catch (PDOException $e) {
         die ("<p><H3>No se ha podido establecer la conexión.<P>Compruebe si está activado el 
         servidor de bases de datos MySQL.</H3></p>\n <p>Error: " . $e->getMessage() . "</p>\n");
      } 
   }

   function ejecuta_SQL($sql) 
   {
      global $id_conexion;

		$resultado=$id_conexion->query($sql);
		if (!$resultado){
			echo"<H3>No se ha podido ejecutar la consulta: <PRE>$sql</PRE><P><U> Errores</U>: </H3><PRE>";
			print_r($id_conexion->errorInfo());					
			die ("</PRE>");
		}
		return $resultado;
	}

    function insert_id() {
        global $id_conexion;
        return $id_conexion->lastInsertId();
     }

     function imprimir_cabecera()
     {
        echo "<header class='cabecera' style='background-color: #ffffff;padding: 10px 0;'>
        <div class='contenedor' style='display: flex; justify-content: space-between; margin-left:8%; margin-right:8%; align-items: center; padding: 0 20px;'><div class='logo'>
            <img style='width: 180px; heigth: 100px;' src='Imagenes/logo.jpg' alt='Logo de la empresa'>
        </div><nav class='enlaces'><ul style=' list-style: none;  padding: 0;  margin: 0; display: flex;'>
            <li style='margin-left: 20px; font-size: 120%;'><a style='text-decoration: none; font-size:130%;' href='home.php'>Inico</a></li>
            <li style='margin-left: 20px; font-size: 120%;'><a style='text-decoration: none; font-size:130%;' href='citas.php'>Citas</a></li>
            <li style='margin-left: 20px; font-size: 120%;'><a style='text-decoration: none; font-size:130%;' href='valoraciones.php'>Valoraciones</a></li>
            <li style='margin-left: 20px; font-size: 120%;'><a style='text-decoration: none; font-size:130%;' href='login.php'>Inicio Sesión</a></li>
        </ul></nav></div></header>";
     } 
  
     function imprimir_piepagina(){
        echo "<footer style='background-color:#FFFF; padding: 20px; text-align: center;'>
        <div style='margin-bottom: 20px;'>
          <a target='_blank' href='https://www.facebook.com/login/?locale=es_ES' style='text-decoration: none; color: #333; margin: 0 10px;'>Facebook</a>
          <a target='_blank' href='https://twitter.com/' style='text-decoration: none; color: #333; margin: 0 10px;'>Twitter</a>
          <a target='_blank' href='https://www.instagram.com/' style='text-decoration: none; color: #333; margin: 0 10px;'>Instagram</a>

        </div>
        <p style='font-size: 14px; color: #666; margin-bottom: 10px;'>Síguenos en nuestras redes sociales para estar al tanto de las últimas novedades.</p>
        <p style='font-size: 14px; color: #666;'>© 2024 Todos los derechos reservados.</p>
      </footer>";
     }
?> 