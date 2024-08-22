<?php
include('../includes/db.php');
include('../includes/funciones.php');

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = sanitizar($_POST['nombre']);
    $correo = sanitizar($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $rol_id = 2; // Por ejemplo, 2 para jugadores

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="bg-primary text-white p-3 mb-4">
        <div class="container">
            <h1 class="h3">Registro de Usuario</h1>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Juego de Preguntas</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="../login/login.php">Iniciar sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php">Inicio</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="my-4">
            <h2 class="h4">Regístrate para jugar</h2>
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            <?php if ($mensaje): ?>
                <div class="alert alert-info mt-3"><?php echo $mensaje; ?></div>
            <?php endif; ?>
        </section>
    </main>

    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; <?php echo date('Y'); ?> Juego de Preguntas. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
