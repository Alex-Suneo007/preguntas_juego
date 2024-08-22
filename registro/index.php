<?php
// Incluye el archivo de configuración y funciones
include('../includes/db.php');
include('../includes/funciones.php');

// Manejo de mensajes de error y éxito
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = sanitizar($_POST['nombre']);
    $correo = sanitizar($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $rol_id = 2; // Por ejemplo, 2 para jugadores

    // Validación simple de datos
    if (!empty($nombre) && !empty($correo) && !empty($contrasena)) {
        if (crearUsuario($nombre, $correo, $contrasena, $rol_id)) {
            $mensaje = 'Usuario registrado exitosamente. Puedes <a href="../login/login.php">iniciar sesión aquí</a>.';
        } else {
            $mensaje = 'Error al registrar el usuario. Intenta de nuevo.';
        }
    } else {
        $mensaje = 'Por favor completa todos los campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Juego de Preguntas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Registro de Usuario</h1>
        <nav>
            <ul>
                <li><a href="../login/login.php">Iniciar sesión</a></li>
                <li><a href="../index.php">Inicio</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Regístrate para jugar</h2>
            <form action="index.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>
                
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                
                <button type="submit">Registrarse</button>
            </form>
            <?php if ($mensaje): ?>
                <p><?php echo $mensaje; ?></p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Juego de Preguntas. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
