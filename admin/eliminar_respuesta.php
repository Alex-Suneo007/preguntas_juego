<?php
session_start();
include('../includes/funciones.php');

if (!verificarAutenticacion() || !esAdmin()) {
    header('Location: ../login/index.php');
    exit();
}

$error = '';
$exito = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_respuesta_id'])) {
    include('../includes/db.php');

    $respuesta_id = $_POST['eliminar_respuesta_id'];

    try {
        // Eliminar la respuesta
        $stmt = $pdo->prepare('DELETE FROM respuestas WHERE id = ?');
        $stmt->execute([$respuesta_id]);

        $exito = 'Respuesta eliminada exitosamente.';
    } catch (PDOException $e) {
        $error = 'Error al eliminar la respuesta: ' . $e->getMessage();
    }
}

// Obtener todas las respuestas para mostrar en la lista
// Puedes ajustar esta consulta para obtener respuestas asociadas a una pregunta específica si es necesario
$statement = $pdo->query('SELECT id, respuesta FROM respuestas');
$respuestas = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Respuesta - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Admin - Juego de Preguntas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agregar_pregunta.php">Agregar Pregunta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agregar_respuesta.php">Agregar Respuesta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eliminar_pregunta.php">Eliminar Pregunta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eliminar_respuesta.php">Eliminar Respuesta</a>
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
                <h1>Eliminar Respuesta</h1>
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <?php if ($exito): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($exito); ?>
                    </div>
                <?php endif; ?>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="">
                                    <div class="mb-3">
                                        <label for="eliminar_respuesta_id" class="form-label">Seleccione una respuesta para eliminar:</label>
                                        <select id="eliminar_respuesta_id" name="eliminar_respuesta_id" class="form-select" required>
                                            <?php foreach ($respuestas as $respuesta): ?>
                                                <option value="<?= htmlspecialchars($respuesta['id']) ?>">
                                                    <?= htmlspecialchars($respuesta['respuesta']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Eliminar Respuesta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p class="mb-0">Desarrollado por Alex 👻</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
