<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../jugador/index.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../includes/db.php');
    include('../includes/funciones.php');

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    if (registrarUsuario($nombre, $correo, $contrasena)) {
        $_SESSION['usuario_id'] = obtenerUsuarioId($correo);
        header('Location: ../jugador/index.php');
        exit();
    } else {
        $error = 'Error al registrar el usuario. Inténtalo de nuevo.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Juego de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Juego de Preguntas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/index.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Registrarse</a>
                        </li>
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger text-white" href="../logout.php">Cerrar sesión</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1>Registrarse</h1>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($error): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo htmlspecialchars($error); ?>
                                    </div>
                                <?php endif; ?>
                                <form method="post" action="">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contrasena" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                                    </div>
                                    <button type="submit" class="btn btn-light">Registrarse</button>
                                </form>
                                <p class="mt-3">¿Ya tienes una cuenta? <a href="../login/index.php">Inicia sesión aquí</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p class="mb-0">Desarrollado por [Tu Nombre]</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
