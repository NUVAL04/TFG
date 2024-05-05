<?php
    include 'funciones.php';
    session_start();
    
    if (!isset($_SESSION['num_user'])) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'login.php';
        header("Location: http://$host$uri/$extra");  
    }
    conectar_BD(); 

    if(isset($_REQUEST['nombre']) && isset($_REQUEST['telefono']) && isset($_REQUEST['fecha']) && isset($_REQUEST['tipo'])){
        $consulta="SELECT fecha, nombre, telefono, tipo FROM citas WHERE fecha='".$_REQUEST['fecha']."'";
        $resultado = ejecuta_SQL($consulta);

        if ($resultado->rowCount()>0){
           echo "<BR><BR><center>
            <p id='fallo'>Esta hora ya está reservada. Intente coger otra.<p></center><br>";
        }
        else{
            $fecha= $_REQUEST['fecha'];
            $fecha_formateada = date('Y-m-d H:i:s', strtotime($fecha));
            $consulta="INSERT INTO citas VALUES (NULL, '".$_REQUEST['fecha']."', '".$_REQUEST['nombre']."', '".$_SESSION['num_user']."','".$_REQUEST['telefono']."','".$_REQUEST['tipo']."')";
            $resultado = ejecuta_SQL($consulta);
            header("Location: reserva.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <style>
         body{
        background-color: #ADD8E6;
    }
    .container {
        width: 400px;:
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
    }

    #reservar {
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

    #nombre, #telefono, #fecha, #tipo {
        width: 90%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }  
    
    label{
        font-size:120%;
    }

    #mensajeerror{
        font-size:120%;
        color:blue;
    }

   </style> 
</head>
<body>
<?php
    imprimir_cabecera();
?>

<br><br><center><div class="container">
<h3>RESERVA TU CITA</h3>
    <form id="form1" action="citas.php" method="post">
        <label>Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label>Teléfono:</label>
        <input type="tel" id="telefono" name="telefono"><br><br>

        <label>Fecha:</label>
        <input type="date" id="fecha" name="fecha"><br><br>

        <?php
         //Input para coger el id del usuario que esta logueado
        echo "<input type='hidden' name='num_user' value='".$_SESSION['num_user']."'>"
        ?>

        <label>Tipo de pelado:</label>
        <select id="tipo" name="tipo">
            <option value="Corte de pelo">Corte de pelo</option>
            <option value="Tinte">Tinte</option>
            <option value="Peinado">Peinado</option>
            <option value="Lavado y secado">Lavado y secado</option>
        </select><br><br>
        <label id="mensajeerror"></label><br>
    <button id="reservar" type="submit">Reservar cita</button>
    </form>
</div></center><br><br>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#fecha", {
            enableTime:true,
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
    </script>
    
    <?php
        imprimir_piepagina();
    ?>

    <script>
        function validarnombre(nombre) {
            for(var i = 0; i < nombre.length; i++) {
                var charCode = nombre.charCodeAt(i);
                    // Los códigos de caracteres de A-Z, a-z son entre 65-90, 97-122 respectivamente. El 32 es codigo del espacio
                if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode !== 32) {
                    return false;
                }
            }
        return true;
    }

    document.getElementById('form1').addEventListener('submit', function(event) {
        event.preventDefault();
        var nombre = document.getElementById('nombre').value;
        var fecha = document.getElementById('fecha').value;
        var tipo = document.getElementById('tipo').value;
        var telefono = document.getElementById('telefono').value;
        var cajatelefono = document.getElementById('telefono');
        var cajanombre = document.getElementById('nombre');

        if (nombre === "" || fecha === "" || tipo === "" || telefono === "") {
            document.getElementById('mensajeerror').textContent = "No pueden haber campos vacios";
        } 
        else if(!validarnombre(nombre)){
            document.getElementById('mensajeerror').textContent = "El nombre no puede tener números ni caracteres especiales";
            cajanombre.focus();
        }
        else if(telefono.length !== 9 || isNaN(telefono)){
            document.getElementById('mensajeerror').textContent = "El teléfono tiene que tener 9 digitos y solo pueden ser números";
            cajatelefono.focus();
        }
        else {
            document.getElementById('mensajeerror').textContent = ""; 
            this.submit();
        }
    });
    </script>
</body>
</html>