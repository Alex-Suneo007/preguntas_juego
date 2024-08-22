<?php
session_start(); // Asegúrate de que session_start() esté aquí solo una vez
include('../includes/db.php');
include('../includes/funciones.php');

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['usuario_id']) || !esAdmin($_SESSION['usuario_id'])) {
    header('Location: ../login/index.php');
    exit();
}

// Manejo de eliminación de respuestas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['eliminar_respuesta'])) {
        $respuesta_id = $_POST['respuesta_id'];
        if (eliminarRespuesta($respuesta_id)) {
            $exito = 'Respuesta eliminada exitosamente.';
        } else {
            $error = 'Error al eliminar la respuesta.';
        }
    }
}

// Obtener respuestas para una pregunta específica
$pregunta_id = $_GET['pregunta_id'] ?? 0;
$respuestas = obtenerRespuestas($pregunta_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuestas - Admin</title>
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
                            <a class="nav-link" href="index.php">Inicio Admin</a>
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
                <h1>Respuestas para la Pregunta <?php echo htmlspecialchars($pregunta_id); ?></h1>
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
                            <th>Respuesta</th>
                            <th>Correcta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($respuestas as $respuesta): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($respuesta['id']); ?></td>
                                <td><?php echo htmlspecialchars($respuesta['respuesta']); ?></td>
                                <td><?php echo htmlspecialchars($respuesta['es_correcta'] ? 'Sí' : 'No'); ?></td>
                                <td>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="respuesta_id" value="<?php echo htmlspecialchars($respuesta['id']); ?>">
                                        <button type="submit" name="eliminar_respuesta" class="btn btn-danger btn-sm">Eliminar Respuesta</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-secondary mt-3">Volver</a>
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
