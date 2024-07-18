<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $fecha = $_POST['fecha'];
    $plazas_disponibles = $_POST['plazas_disponibles'];
    $precio = $_POST['precio'];

    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio) VALUES (:origen, :destino, :fecha, :plazas_disponibles, :precio)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':plazas_disponibles', $plazas_disponibles);
    $stmt->bindParam(':precio', $precio);

    if ($stmt->execute()) {
        // Obtener el id del vuelo insertado
        $id_vuelo = $db->lastInsertId();

        // Insertar en la tabla RESERVA
        $id_cliente = 1; // Asumiendo un id_cliente fijo para este ejemplo
        $fecha_reserva = date('Y-m-d');
        $id_hotel = NULL; // Por ahora no hay hotel asignado

        $query_reserva = "INSERT INTO RESERVA (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (:id_cliente, :fecha_reserva, :id_vuelo, :id_hotel)";
        $stmt_reserva = $db->prepare($query_reserva);

        $stmt_reserva->bindParam(':id_cliente', $id_cliente);
        $stmt_reserva->bindParam(':fecha_reserva', $fecha_reserva);
        $stmt_reserva->bindParam(':id_vuelo', $id_vuelo);
        $stmt_reserva->bindParam(':id_hotel', $id_hotel);

        if ($stmt_reserva->execute()) {
            echo "Vuelo y reserva agregados correctamente.";
        } else {
            echo "Error al agregar la reserva.";
        }
    } else {
        echo "Error al agregar el vuelo.";
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
