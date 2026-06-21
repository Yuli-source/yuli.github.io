<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agencia_turismo"; // Cambia esto al nombre de tu base de datos

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel_id = $_POST["hotel_id"];
    $nombre_cliente = $_POST["nombre_cliente"];
    $fecha_entrada = $_POST["fecha_entrada"];
    $fecha_salida = $_POST["fecha_salida"];
    
    // Insertar reserva en la base de datos
    $sql = "INSERT INTO reservas (hotel_id, nombre_cliente, fecha_entrada, fecha_salida) VALUES ('$hotel_id', '$nombre_cliente', '$fecha_entrada', '$fecha_salida')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a index.php después de la reserva
        header("Location: index.php");
        exit(); // Asegúrate de que el script se detenga después de la redirección
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener información del hotel
if (isset($_GET["hotel_id"])) {
    $hotel_id = $_GET["hotel_id"];
    $sql = "SELECT nombre_hotel FROM hoteles WHERE id = '$hotel_id'";
    $result = $conn->query($sql);
    $hotel = $result->fetch_assoc();
} else {
    die("Hotel no especificado");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Hotel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
    <div class="login-container">
<h2>Agencia de Turismo Cerrato</h2>
</div>
        <h1>Reservar en <?php echo htmlspecialchars($hotel["nombre_hotel"]); ?></h1>
        <form action="reservar.php" method="POST">
            <input type="hidden" name="hotel_id" value="<?php echo htmlspecialchars($hotel_id); ?>">
            
            <label for="nombre_cliente">Nombre del cliente:</label>
            <input type="text" id="nombre_cliente" name="nombre_cliente" required>

            <label for="fecha_entrada">Fecha de entrada:</label>
            <input type="date" id="fecha_entrada" name="fecha_entrada" required>

            <label for="fecha_salida">Fecha de salida:</label>
            <input type="date" id="fecha_salida" name="fecha_salida" required>

            <button type="submit">Reservar</button>
        </form>
    </div>
</body>
</html>
