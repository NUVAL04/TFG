<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="Imagenes/logo.jpg" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body{
            background-color: #ADD8E6;
    }
    h1{
        font-family: 'Dancing Script', cursive;
        font-size: 36px;
        color: #333; 
        text-align: center; 
        margin-top: 20px; 
        margin-bottom: 20px; 
        text-transform: uppercase; 
        letter-spacing: 2px;
        color:blue;
    }
        
    .banner img {
        width: 100%;
        height: 420px;
    }


    #precios {
        padding: 2em 0;
        text-align: center;
    }

    .precios {
        display: flex;
        justify-content: center;
    }

    .servicio {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        margin: 0.5em;
        padding: 1em;
        width: 150px;
        border-radius: 8px;
    }

    .slider-frame {
	    width: 700px;
        height: auto;
	    margin:50px auto 0;
	    overflow: hidden;
    }

    .slider-frame ul {
	    display: flex;
	    padding: 0;
	    width: 300%;
	    animation: slide 15s infinite alternate ease-in-out; //evita animaciones bruscas.
    }

    .slider-frame li {
	    width: 100%;
	    list-style: none;
    }

    .slider-frame img {
	    width: 100%;
    }

    @keyframes slide {
     //El porcentaje del principio indica el porcentaje del tiempo indicado al slide
	    0% {margin-left: 0;}
	    30% {margin-left: 0;}
	
        //5% que falta es para que se pare
	    35% {margin-left: -100%;} //100% de desplazamiento a la izquierda por tanto sale la segunda foto.
	    65% {margin-left: -100%;}
	
	    70% {margin-left: -200%;}
	    100% {margin-left: -200%;}
    }

    #ubicacion {
        padding: 2em 0;
        text-align: center;
    }

    #ubicacion iframe {
        border: none;
        width: 80%;
        height: 450px;
    }
    </style>
</head>
<body>
<?php
    include 'funciones.php';
    imprimir_cabecera();
?>
    <br><br>
    <section class="banner">
        <img src="Imagenes/SMARTPELU.png">
    </section>

    <section id="precios">
        <h1>Nuestros servicios</h1>
        <div class="precios">
            <div class="servicio">
                <h3>Corte de cabello</h3>
                <p>15€</p>
            </div>
            <div class="servicio">
                <h3>Tinte</h3>
                <p>25€</p>
            </div>
            <div class="servicio">
                <h3>Corte y Barba</h3>
                <p>20€</p>
            </div>
            <div class="servicio">
                <h3>Lavado y Secado</h3>
                <p>10€</p>
            </div>
            <div class="servicio">
                <h3>Peinado</h3>
                <p>13€</p>
            </div>
        </div>
    </section>

        <h1>Satisfacemos vuestras necesidades</h1>
        <div class="slider-frame">
            <ul>
                <li><img src="Imagenes/foto3.jpg" alt="corte 1"></li>
                <li><img src="Imagenes/foto1.jpg" alt="corte 2"></li>
                <li><img src="Imagenes/foto2.jpg" alt="corte 3"></li>
            </ul>
        </div>

    <section id="ubicacion">
        <h1>Nuestra ubicación</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3219.6869928397537!2d-5.427433176037678!3d36.198493529328985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0cea4f69e9f8f5%3A0x29fba6f1afc629c9!2sWilliams%20Bruce%20Hogg!5e0!3m2!1ses!2ses!4v1714118664843!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>
  </center><br><br>

    <?php
    imprimir_piepagina();
    ?>

</body>
</html>