<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login/login.php');
    exit();
}

$stmt = $pdo->query('SELECT * FROM preguntas');
$preguntas = $stmt->fetchAll();
?>

<form method="post" action="resultado.php">
    <?php foreach ($preguntas as $pregunta): ?>
        <fieldset>
            <legend><?php echo htmlspecialchars($pregunta['pregunta']); ?></legend>
            <?php
            $stmt = $pdo->prepare('SELECT * FROM respuestas WHERE pregunta_id = :pregunta_id');
            $stmt->execute(['pregunta_id' => $pregunta['id']]);
            $respuestas = $stmt->fetchAll();
            ?>
            <?php foreach ($respuestas as $respuesta): ?>
                <label>
                    <input type="radio" name="pregunta_<?php echo $pregunta['id']; ?>" value="<?php echo $respuesta['id']; ?>">
                    <?php echo htmlspecialchars($respuesta['respuesta']); ?>
                </label><br>
            <?php endforeach; ?>
        </fieldset>
    <?php endforeach; ?>
    <button type="submit">Enviar respuestas</button>
</form>
