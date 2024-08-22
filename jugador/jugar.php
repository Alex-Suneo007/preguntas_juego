<?php
session_start();
include('../includes/db.php');
include('../includes/funciones.php');

verificarAutenticacion(); // Verifica si el usuario está autenticado

// Obtener una pregunta aleatoria
$sql = 'SELECT id, pregunta FROM preguntas ORDER BY RAND() LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pregunta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pregunta) {
    die('No hay preguntas disponibles.');
}

$pregunta_id = $pregunta['id'];
$pregunta_texto = $pregunta['pregunta'];

// Obtener las respuestas para la pregunta seleccionada
$sql = 'SELECT id, respuesta, es_correcta FROM respuestas WHERE pregunta_id = :pregunta_id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['pregunta_id' => $pregunta_id]);
$respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Juego de Preguntas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="jugar.php">Jugar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section py-5">
            <div class="container">
                <h1 class="mb-4">Pregunta del Juego</h1>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="resultado.php">
                            <fieldset>
                                <legend><?php echo htmlspecialchars($pregunta_texto); ?></legend>
                                <?php foreach ($respuestas as $respuesta): ?>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="respuesta_id" id="respuesta<?php echo $respuesta['id']; ?>" value="<?php echo $respuesta['id']; ?>" required>
                                        <label class="form-check-label" for="respuesta<?php echo $respuesta['id']; ?>">
                                            <?php echo htmlspecialchars($respuesta['respuesta']); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </fieldset>
                            <input type="hidden" name="pregunta_id" value="<?php echo $pregunta_id; ?>">
                            <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p class="mb-0">Desarrollado por Alex 👻</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
