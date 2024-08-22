<?php
include('includes/db.php');
include('includes/funciones.php');

session_start();
$usuario_autenticado = false;
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $nombre_usuario = obtenerNombreUsuario($usuario_id);
    $usuario_autenticado = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Juego de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="bg-primary text-white p-3 mb-4">
        <div class="container">
            <h1 class="h3">Bienvenido al Juego de Preguntas</h1>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Juego de Preguntas</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <?php if ($usuario_autenticado): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="jugador/index.php">Jugar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="jugador/resultado.php">Ver Resultados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="login/login.php">Iniciar sesión</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="registro/index.php">Registrarse</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="my-4">
            <h2 class="h4">Descripción del Juego</h2>
            <p>Este es un juego de preguntas donde puedes probar tus conocimientos y ver cómo te comparas con otros jugadores.</p>
            <?php if ($usuario_autenticado): ?>
                <p>Hola, <?php echo htmlspecialchars($nombre_usuario); ?>. ¡Gracias por volver!</p>
            <?php else: ?>
                <p>¡Regístrate y comienza a jugar!</p>
            <?php endif; ?>
        </section>
    </main>

    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; <?php echo date('Y'); ?> Juego de Preguntas. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
