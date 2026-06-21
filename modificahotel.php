<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Conexión a la base de datos para los hoteles
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agencia_turismo";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verifica si hay una solicitud para editar un hotel específico
if (isset($_GET['hotel_id'])) {
    $hotel_id = intval($_GET['hotel_id']);
    $sql_hotel = "SELECT id, nombre_hotel, descripcion, precio_por_noche, imagen, ciudad FROM hoteles WHERE id = ?";
    $stmt = $conn->prepare($sql_hotel);
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $result_hotel = $stmt->get_result();

    if ($result_hotel->num_rows > 0) {
        $hotel = $result_hotel->fetch_assoc();
    } else {
        echo "<p class='no-hoteles'>Hotel no encontrado.</p>";
    }
}

// Si el formulario fue enviado, actualiza los datos del hotel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hotel_id = intval($_POST['hotel_id']);
    $nombre_hotel = $_POST['nombre_hotel'];
    $descripcion = $_POST['descripcion'];
    $precio_por_noche = $_POST['precio_por_noche'];
    $ciudad = $_POST['ciudad'];
    $imagen = $_POST['imagen'];

    $sql_update = "UPDATE hoteles SET nombre_hotel=?, descripcion=?, precio_por_noche=?, ciudad=?, imagen=? WHERE id=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssisii", $nombre_hotel, $descripcion, $precio_por_noche, $ciudad, $imagen, $hotel_id);

    if ($stmt_update->execute()) {
        echo "<p class='success-msg'>Hotel actualizado correctamente.</p>";
    } else {
        echo "<p class='error-msg'>Error al actualizar el hotel: " . $conn->error . "</p>";
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Agencia de Turismo Cerrato | Editar Hotel</title>
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <style>
        /* Estilos adicionales */
        .form-container {
            background: #ffffff;
            margin: 40px auto;
            padding: 20px;
            border-radius: 15px;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .form-container h2 {
            color: #00796b;
            text-align: center;
        }
        .form-container label {
            display: block;
            font-size: 1.2em;
            color: #555;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
<?php include('includes/header.php');?>

<div class="form-container">
    <h2>Editar Hotel</h2>
    <?php if (isset($hotel)): ?>
    <form method="POST" action="">
        <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
        
        <label for="nombre_hotel">Nombre del Hotel:</label>
        <input type="text" id="nombre_hotel" name="nombre_hotel" value="<?php echo htmlspecialchars($hotel['nombre_hotel']); ?>" required>
        
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($hotel['descripcion']); ?>" required>
        
        <label for="precio_por_noche">Precio por Noche:</label>
        <input type="number" id="precio_por_noche" name="precio_por_noche" value="<?php echo htmlspecialchars($hotel['precio_por_noche']); ?>" required>
        
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($hotel['ciudad']); ?>" required>
        
        <label for="imagen">Imagen (ruta de la imagen):</label>
        <input type="text" id="imagen" name="imagen" value="<?php echo htmlspecialchars($hotel['imagen']); ?>" required>

        <button type="submit">Actualizar Hotel</button>
    </form>
    <?php else: ?>
        <p class='no-hoteles'>No se encontró el hotel para editar.</p>
    <?php endif; ?>
</div>

<?php include('includes/footer.php');?>
</body>
</html>

<?php
$conn->close();
?>
