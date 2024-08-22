<?php
include_once('../includes/funciones.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (verificarUsuario($correo, $contrasena)) {
        if (esAdmin()) {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../jugador/index.php');
        }
        exit();
    } else {
        $error = 'Correo o contraseña incorrectos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Juego de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                            <a class="nav-link" href="index.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../registro/index.php">Registrarse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1>Iniciar sesión</h1>
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
                                        <label for="correo" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contrasena" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                                    </div>
                                    <button type="submit" class="btn btn-light">Iniciar sesión</button>
                                </form>
                                <p class="mt-3">¿No tienes una cuenta? <a href="../registro/index.php">Regístrate aquí</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p class="text-center">&copy; <?php echo date("Y"); ?> Juego de Preguntas</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9fMWfMTh9HfPz72P7AXzmL3lTVZlGo6jF2w0hb8MY4u1Zx7Qp5Jb" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-fQ9g6e5C9iRtgiQnE6I4f6v8Gv5tq5N11brM4TO5AhYXocVZHpN6T6xD0I8jzjOWp" crossorigin="anonymous"></script>
</body>
</html>
