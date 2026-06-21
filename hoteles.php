<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Agencia de Turismo Cerrato | Lista de Hoteles</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
    body {
        background: url('./images/eleganfont.jpg');
        background-size: cover;
    }
</style>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<!--//end-animate-->
</head>
<body>
<?php include('includes/header.php'); ?>
<!--- banner ---->
<div class="banner-3">
    <div class="container">
        <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">
            Agencia de Turismo Cerrato - Lista de Hoteles
        </h1>
    </div>
</div>
<!--- /banner ---->
<!--- rooms ---->
<div class="rooms">
    <div class="container">
        <div class="room-bottom">
            <h3>Lista de Hoteles</h3>

<?php 
$sql = "SELECT * FROM hoteles";  // Consulta para la tabla hoteles
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) { ?>
            <div class="rom-btm">
                <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                    <img src="admin/includes/<?php echo htmlentities($result->imagen); ?>" class="img-responsive" alt="Hotel Image">
                </div>
                <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                    <h4>Nombre del Hotel: <?php echo htmlentities($result->nombre_hotel); ?></h4>
                    <p><b>Ciudad:</b> <?php echo htmlentities($result->ciudad); ?></p>
                    <p><b>Descripción:</b> <?php echo htmlentities($result->descripcion); ?></p>
                </div>
                <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                    <h5>L <?php echo htmlentities($result->precio_por_noche); ?> por noche</h5>
                    <a href="reservar.php?hotel_id=<?php echo htmlentities($result->id); ?>" class="view">Reservar</a>
                </div>
                <div class="clearfix"></div>
            </div>
<?php 
    }
} 
?>
        </div>
    </div>
</div>
<!--- /rooms ---->

<!--- /footer-top ---->
<?php include('includes/footer.php'); ?>
<!-- signup -->
<?php include('includes/signup.php'); ?>            
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php'); ?>            
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php'); ?>            
<!-- //write us -->
</body>
</html>