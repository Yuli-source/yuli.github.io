<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Agencia de Turismo Cerrato | Galería</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
     body {
        background-image: url('images/fondoreserva.png'); /* Cambia esta ruta a la ubicación de tu imagen de fondo */
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Hace que la imagen de fondo se mantenga fija al hacer scroll */
        font-family: 'Open Sans', sans-serif;
    }
    .container {
        
        margin-top: 50px;
        margin-bottom: 30px;

    }
    .h3{
        color:white;
    }
    .gallery-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        gap: 20px;
        margin-top: 20px;
    }
    .gallery-item {
        width: 250px;
        height: 250px;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    h3 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-weight: bold;
    }
</style>
</head>
<body>
<?php include('includes/header.php'); ?>

<div class="container">
    <h3 style=color:white >Galería de Imágenes</h3>
    <div class="gallery-container">
        <?php
        $dir = "admin/pacakgeimages/";  // Carpeta donde están las imágenes
        $images = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);  // Obtiene todas las imágenes

        if ($images) {
            foreach ($images as $image) {
                echo '<div class="gallery-item">';
                echo '<img src="' . $image . '" alt="Imagen de galería">';
                echo '</div>';
            }
        } else {
            echo '<p>No se encontraron imágenes en la galería.</p>';
        }
        ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
