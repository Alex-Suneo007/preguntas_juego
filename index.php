<?php
session_start();
include('includes/db.php');
include('includes/funciones.php');

// Verifica si el usuario está autenticado y es administrador
$es_admin = isset($_SESSION['usuario_id']) && esAdmin($_SESSION['usuario_id']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Preguntas - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Juego de Preguntas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login/index.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registro/index.php">Registrarse</a>
                        </li>
                        <?php if ($es_admin): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/index.php">Administrar</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section py-5">
            <div class="container text-center">
                <h1>Bienvenido al Juego de Preguntas</h1>
                <p>¡Juega y diviértete con nuestras preguntas!</p>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="jugador/jugar.php" class="btn btn-primary">Comenzar a Jugar</a>
                    <a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>
                <?php else: ?>
                    <a href="login/index.php" class="btn btn-primary">Iniciar sesión</a>
                    <a href="registro/index.php" class="btn btn-secondary">Registrarse</a>
                <?php endif; ?>
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
