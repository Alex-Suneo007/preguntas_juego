<?php
session_start();
include('../includes/funciones.php');

if (!verificarAutenticacion() || !esAdmin()) {
    header('Location: ../login/index.php');
    exit();
}

$error = '';
$exito = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../includes/db.php');

    $pregunta = $_POST['pregunta'];
    $respuesta_correcta = $_POST['respuesta_correcta'];
    $respuesta_incorrecta1 = $_POST['respuesta_incorrecta1'];
    $respuesta_incorrecta2 = $_POST['respuesta_incorrecta2'];
    $respuesta_incorrecta3 = $_POST['respuesta_incorrecta3'];
    $categoria = $_POST['categoria'];

    try {
        // Insertar la pregunta
        $stmt = $pdo->prepare('INSERT INTO preguntas (pregunta, categoria) VALUES (?, ?)');
        $stmt->execute([$pregunta, $categoria]);
        $pregunta_id = $pdo->lastInsertId();
        
        // Insertar las respuestas
        $respuestas = [
            ['respuesta' => $respuesta_correcta, 'es_correcta' => 1],
            ['respuesta' => $respuesta_incorrecta1, 'es_correcta' => 0],
            ['respuesta' => $respuesta_incorrecta2, 'es_correcta' => 0],
            ['respuesta' => $respuesta_incorrecta3, 'es_correcta' => 0],
        ];

        foreach ($respuestas as $respuesta) {
            $stmt = $pdo->prepare('INSERT INTO respuestas (pregunta_id, respuesta, es_correcta) VALUES (?, ?, ?)');
            $stmt->execute([$pregunta_id, $respuesta['respuesta'], $respuesta['es_correcta']]);
        }

        $exito = 'Pregunta y respuestas agregadas exitosamente.';
    } catch (PDOException $e) {
        $error = 'Error al agregar la pregunta: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pregunta - Admin</title>
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
                <h1>Agregar Pregunta</h1>
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
                                        <label for="pregunta" class="form-label">Pregunta</label>
                                        <input type="text" class="form-control" id="pregunta" name="pregunta" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respuesta_correcta" class="form-label">Respuesta Correcta</label>
                                        <input type="text" class="form-control" id="respuesta_correcta" name="respuesta_correcta" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respuesta_incorrecta1" class="form-label">Respuesta Incorrecta 1</label>
                                        <input type="text" class="form-control" id="respuesta_incorrecta1" name="respuesta_incorrecta1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respuesta_incorrecta2" class="form-label">Respuesta Incorrecta 2</label>
                                        <input type="text" class="form-control" id="respuesta_incorrecta2" name="respuesta_incorrecta2" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respuesta_incorrecta3" class="form-label">Respuesta Incorrecta 3</label>
                                        <input type="text" class="form-control" id="respuesta_incorrecta3" name="respuesta_incorrecta3" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoria" class="form-label">Categoría</label>
                                        <input type="text" class="form-control" id="categoria" name="categoria" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar Pregunta</button>
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
