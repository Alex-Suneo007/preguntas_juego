<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pregunta = $_POST['pregunta'];

    $stmt = $pdo->prepare('INSERT INTO preguntas (pregunta) VALUES (:pregunta)');
    $stmt->execute(['pregunta' => $pregunta]);

    header('Location: index.php');
    exit();
}
?>

<form method="post">
    <textarea name="pregunta" placeholder="Ingrese la pregunta" required></textarea>
    <button type="submit">Agregar Pregunta</button>
</form>
