<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <style>
        body{
            background-color: #ADD8E6;
    }
    h1{
        font-family: 'Arial', sans-serif;
        font-size: 36px;
        color: #333; 
        text-align: left; 
        margin-top: 20px; 
        margin-bottom: 20px; 
        text-transform: uppercase; 
        letter-spacing: 2px;
        color:blue;
    }
        
    .hero {
        background-image: url('Imagenes/corte4.jpg');
        background-size: cover;
        background-position: center;
        text-align: left;
        padding: 160px 50px;
    }

    .hero h2 {
        font-size: 36px;
        text-align: left; 
        margin-top: 20px; 
        margin-bottom: 20px; 
        text-transform: uppercase; 
        letter-spacing: 2px;
        color:blue;
    }
    </style>
</head>
<body>
<?php
    include 'funciones.php';
    imprimir_cabecera();
?>
    <br><br>
    <section class="hero">
        <h2>Transforma tu estilo <br>con nosotros</h2>
    </section>

    <h1>Formas de trabajar</h1><br>
    <center><video width="700" height="400" controls>
        <source src="Videos/video.mp4" type="video/mp4">
    </video></center>

    <br><h1>Nuestra ubicación</h1><br>
    <center>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3219.6869928397537!2d-5.427433176037678!3d36.198493529328985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0cea4f69e9f8f5%3A0x29fba6f1afc629c9!2sWilliams%20Bruce%20Hogg!5e0!3m2!1ses!2ses!4v1714118664843!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </center><br><br>

    <?php
    imprimir_piepagina();
    ?>

</body>
</html>