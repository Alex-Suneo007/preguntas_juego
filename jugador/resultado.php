<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login/login.php');
    exit();
}

$puntos = 0;

foreach ($_POST as $pregunta_id => $respuesta_id) {
    // Verificar si la respuesta es correcta
    $stmt = $pdo->prepare('SELECT es_correcta FROM respuestas WHERE id = :respuesta_id');
    $stmt->execute(['respuesta_id' => $respuesta_id]);
    $respuesta = $stmt->fetch();

    if ($respuesta && $respuesta['es_correcta']) {
        $puntos++;
    }
}

// Mostrar el resultado
echo "<h1>Resultados</h1>";
echo "<p>Has obtenido $puntos puntos.</p>";

// Aquí puedes agregar más lógica para almacenar los resultados en la base de datos o realizar otras acciones
?>
