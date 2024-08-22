<?php
session_start();
include('../includes/db.php');
include('../includes/funciones.php');

verificarAutenticacion(); // Verifica si el usuario está autenticado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuesta_id = $_POST['respuesta_id'];
    $pregunta_id = $_POST['pregunta_id'];

    // Verificar si la respuesta es correcta
    $sql = 'SELECT es_correcta FROM respuestas WHERE id = :respuesta_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['respuesta_id' => $respuesta_id]);
    $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($respuesta && $respuesta['es_correcta']) {
        $mensaje = '¡Correcto! Has respondido correctamente.';
    } else {
        $mensaje = 'Incorrecto. La respuesta correcta no ha sido seleccionada.';
    }
} else {
    header('Location: jugar.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Juego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
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
        <section class="hero-section">
            <div class="container">
                <h1>Resultado</h1>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
                <a href="jugar.php" class="btn btn-light">Volver a jugar</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p class="mb-0">Desarrollado por Alex 👻</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
