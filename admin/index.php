<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Preguntas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Bienvenido al Juego de Preguntas</h1>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <p><a href="jugador/jugar.php">Jugar</a></p>
        <?php if ($_SESSION['rol_id'] == 1): // Rol de administrador ?>
            <p><a href="admin/index.php">Administrar Preguntas y Respuestas</a></p>
        <?php endif; ?>
        <p><a href="logout.php">Cerrar sesión</a></p>
    <?php else: ?>
        <p><a href="login/login.php">Iniciar sesión</a></p>
        <p><a href="registro/registro.php">Registrarse</a></p>
    <?php endif; ?>
</body>
</html>
