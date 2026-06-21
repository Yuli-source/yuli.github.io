<?php
include('includes/config.php');

$sql = "SELECT * FROM hoteles";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

$cnt = 1;
foreach ($results as $result) {
    echo "<tr>
            <td>" . htmlentities($cnt) . "</td>
            <td>" . htmlentities($result->nombre_hotel) . "</td>
            <td>" . htmlentities($result->ciudad) . "</td>
            <td>L" . htmlentities($result->precio_por_noche) . "</td>
            <td>" . htmlentities($result->fecha_creacion) . "</td>
            <td><a href='update-hotel.php?hotel_id=" . htmlentities($result->id) . "'><button type='button' class='btn btn-primary btn-block'>Ver detalles</button></a></td>
          </tr>";
    $cnt++;
}
?>
