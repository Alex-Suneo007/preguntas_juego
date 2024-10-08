<?php
session_start();
include('../includes/db.php');
include('../includes/funciones.php');

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['usuario_id']) || !esAdmin($_SESSION['usuario_id'])) {
    header('Location: ../login/index.php');
    exit();
}

// Obtener estadísticas o información relevante para el administrador
$sql = 'SELECT COUNT(*) as total_preguntas FROM preguntas';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total_preguntas = $stmt->fetch(PDO::FETCH_ASSOC)['total_preguntas'];

$sql = 'SELECT COUNT(*) as total_respuestas FROM respuestas';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total_respuestas = $stmt->fetch(PDO::FETCH_ASSOC)['total_respuestas'];

// Manejo de eliminación de preguntas y respuestas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['eliminar_pregunta'])) {
        $pregunta_id = $_POST['pregunta_id'];
        if (eliminarPregunta($pregunta_id)) {
            $exito = 'Pregunta eliminada exitosamente.';
        } else {
            $error = 'Error al eliminar la pregunta.';
        }
    }
    
    if (isset($_POST['eliminar_respuesta'])) {
        $respuesta_id = $_POST['respuesta_id'];
        if (eliminarRespuesta($respuesta_id)) {
            $exito = 'Respuesta eliminada exitosamente.';
        } else {
            $error = 'Error al eliminar la respuesta.';
        }
    }
}

$preguntas = obtenerPreguntas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Administración</title>
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
                            <a class="nav-link active" href="index.php">Inicio Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agregar_pregunta.php">Agregar Pregunta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="agregar_respuesta.php">Agregar Respuesta</a>
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
            <div class="container text-center">
                <h1>Bienvenido al Área de Administración</h1>
                <p>Gestión de preguntas y respuestas</p>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Estadísticas</h5>
                        <p class="card-text">Número total de preguntas: <?php echo htmlspecialchars($total_preguntas); ?></p>
                        <p class="card-text">Número total de respuestas: <?php echo htmlspecialchars($total_respuestas); ?></p>
                    </div>
                </div>
                
                <!-- Administrar Preguntas -->
                <h2 class="mt-5">Administrar Preguntas</h2>
                <?php if (isset($error) && $error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($exito) && $exito): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($exito); ?>
                    </div>
                <?php endif; ?>
                <table class="table table-dark table-striped mt-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pregunta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($preguntas as $pregunta): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pregunta['id']); ?></td>
                                <td><?php echo htmlspecialchars($pregunta['pregunta']); ?></td>
                                <td>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="pregunta_id" value="<?php echo htmlspecialchars($pregunta['id']); ?>">
                                        <button type="submit" name="eliminar_pregunta" class="btn btn-danger btn-sm">Eliminar Pregunta</button>
                                    </form>
                                    <a href="respuestas.php?pregunta_id=<?php echo htmlspecialchars($pregunta['id']); ?>" class="btn btn-info btn-sm">Ver Respuestas</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
