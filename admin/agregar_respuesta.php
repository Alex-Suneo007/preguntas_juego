<?php
require_once '../includes/funciones.php';

// Verificar si el usuario está autenticado y si es administrador
redirigirSiNoAutenticado('../login/index.php');
redirigirSiNoEsAdmin('../jugador/index.php');

// Manejo del formulario de agregar respuesta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pregunta_id = $_POST['pregunta_id'];
    $respuesta = $_POST['respuesta'];
    $es_correcta = isset($_POST['es_correcta']) ? 1 : 0;

    if (agregarRespuesta($pregunta_id, $respuesta, $es_correcta)) {
        $mensaje = 'Respuesta agregada exitosamente.';
    } else {
        $mensaje = 'Error al agregar la respuesta.';
    }
}

// Obtener todas las preguntas para el formulario
$preguntas = obtenerPreguntas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Respuesta - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                <h1>Agregar Respuesta</h1>
                <?php if (isset($mensaje)): ?>
                    <div class="alert alert-info" role="alert">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="">
                                    <div class="mb-3">
                                        <label for="pregunta_id" class="form-label">Pregunta</label>
                                        <select id="pregunta_id" name="pregunta_id" class="form-select" required>
                                            <?php foreach ($preguntas as $pregunta): ?>
                                                <option value="<?= htmlspecialchars($pregunta['id']) ?>"><?= htmlspecialchars($pregunta['pregunta']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respuesta" class="form-label">Respuesta</label>
                                        <input type="text" id="respuesta" name="respuesta" class="form-control" required>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" id="es_correcta" name="es_correcta" class="form-check-input">
                                        <label for="es_correcta" class="form-check-label">¿Es la respuesta correcta?</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar Respuesta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Juego de Preguntas</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9fMWfMTh9HfPz72P7AXzmL3lTVZlGo6jF2w0hb8MY4u1Zx7Qp5Jb" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
