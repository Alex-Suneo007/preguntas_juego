<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pregunta_id = $_POST['pregunta_id'];
    $respuesta = $_POST['respuesta'];
    $es_correcta = isset($_POST['es_correcta']) ? 1 : 0;

    $stmt = $pdo->prepare('INSERT INTO respuestas (pregunta_id, respuesta, es_correcta) VALUES (:pregunta_id, :respuesta, :es_correcta)');
    $stmt->execute(['pregunta_id' => $pregunta_id, 'respuesta' => $respuesta, 'es_correcta' => $es_correcta]);

    header('Location: index.php');
    exit();
}
?>

<form method="post">
    <select name="pregunta_id" required>
        <?php
        $stmt = $pdo->query('SELECT id, pregunta FROM preguntas');
        while ($row = $stmt->fetch()) {
            echo "<option value=\"{$row['id']}\">{$row['pregunta']}</option>";
        }
        ?>
    </select>
    <input type="text" name="respuesta" placeholder="Ingrese la respuesta" required>
    <input type="checkbox" name="es_correcta"> Correcta
    <button type="submit">Agregar Respuesta</button>
</form>
