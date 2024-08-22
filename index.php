<?php
// Incluye el archivo de configuración y funciones
include('includes/db.php');
include('includes/funciones.php');

// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido al Juego de Preguntas</h1>
        <nav>
            <ul>
                <?php if ($usuario_autenticado): ?>
                    <li><a href="jugador/index.php">Jugar</a></li>
                    <li><a href="jugador/resultado.php">Ver Resultados</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="login/login.php">Iniciar sesión</a></li>
                    <li><a href="registro/index.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Descripción del Juego</h2>
            <p>Este es un juego de preguntas donde puedes probar tus conocimientos y ver cómo te comparas con otros jugadores.</p>
            <?php if ($usuario_autenticado): ?>
                <p>Hola, <?php echo htmlspecialchars($nombre_usuario); ?>. ¡Gracias por volver!</p>
            <?php else: ?>
                <p>¡Regístrate y comienza a jugar!</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Juego de Preguntas. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
