<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agencia_turismo"; // Cambia esto al nombre de tu base de datos

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener todos los hoteles
$sql_hoteles = "SELECT id, nombre_hotel FROM hoteles";
$result_hoteles = $conn->query($sql_hoteles);
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Seleccionar Hotel</title>
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <style>
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
        .form-container select {
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
    <h2>Seleccionar Hotel para Editar</h2>
    <form method="GET" action="editar_hotel.php">
        <label for="hotel">Selecciona un hotel:</label>
        <select id="hotel" name="hotel_id" required>
            <option value="">-- Selecciona un hotel --</option>
            <?php
            if ($result_hoteles->num_rows > 0) {
                while($row = $result_hoteles->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nombre_hotel']) . "</option>";
                }
            } else {
                echo "<option value=''>No hay hoteles disponibles</option>";
            }
            ?>
        </select>
        <button type="submit">Editar Hotel</button>
    </form>
</div>

<?php include('includes/footer.php');?>
</body>
</html>

<?php
$conn->close();
?>
