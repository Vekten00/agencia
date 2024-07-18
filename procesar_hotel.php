<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $habitaciones_disponibles = $_POST['habitaciones_disponibles'];
    $tarifa_noche = $_POST['tarifa_noche'];

    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO HOTEL (nombre, ubicacion, habitaciones_disponibles, tarifa_noche) VALUES (:nombre, :ubicacion, :habitaciones_disponibles, :tarifa_noche)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':ubicacion', $ubicacion);
    $stmt->bindParam(':habitaciones_disponibles', $habitaciones_disponibles);
    $stmt->bindParam(':tarifa_noche', $tarifa_noche);

    if ($stmt->execute()) {
        // Obtener el id del hotel insertado
        $id_hotel = $db->lastInsertId();

        // Insertar en la tabla RESERVA
        $id_cliente = 1; // Asumiendo un id_cliente fijo para este ejemplo
        $fecha_reserva = date('Y-m-d');
        $id_vuelo = NULL; // Por ahora no hay vuelo asignado

        $query_reserva = "INSERT INTO RESERVA (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (:id_cliente, :fecha_reserva, :id_vuelo, :id_hotel)";
        $stmt_reserva = $db->prepare($query_reserva);

        $stmt_reserva->bindParam(':id_cliente', $id_cliente);
        $stmt_reserva->bindParam(':fecha_reserva', $fecha_reserva);
        $stmt_reserva->bindParam(':id_vuelo', $id_vuelo);
        $stmt_reserva->bindParam(':id_hotel', $id_hotel);

        if ($stmt_reserva->execute()) {
            echo "Hotel y reserva agregados correctamente.";
        } else {
            echo "Error al agregar la reserva.";
        }
    } else {
        echo "Error al agregar el hotel.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Reserva</title>
</head>
<body>
    <button onclick="window.location.href='index.html'">Volver a la página principal</button>
</body>
</html>
