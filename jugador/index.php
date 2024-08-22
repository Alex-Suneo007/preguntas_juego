<?php
// Incluye el archivo de configuración y funciones
include('../includes/db.php');
include('../includes/funciones.php');

// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
verificarAutenticacion();

// Obtiene el nombre del usuario
$usuario_id = $_SESSION['usuario_id'];
$nombre_usuario = obtenerNombreUsuario($usuario_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Juego de Preguntas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</h1>
        <nav>
            <ul>
                <li><a href="jugar.php">Comenzar Juego</a></li>
                <li><a href="resultado.php">Ver Resultados</a></li>
                <li><a href="../logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Información del Juego</h2>
            <p>En este juego, puedes responder preguntas y ver tus resultados.</p>
            <p>Utiliza los enlaces de arriba para comenzar a jugar o ver tus resultados.</p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Juego de Preguntas. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
