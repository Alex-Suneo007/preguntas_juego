<?php
session_start();
include('../includes/db.php');

// Verificar si el usuario es un administrador
if (!isset($_SESSION['usuario_id']) || !esAdministrador($_SESSION['usuario_id'])) {
    header('Location: ../login/index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $es_admin = 1; // Asegura que el nuevo usuario es un administrador

    try {
        $sql = "INSERT INTO usuarios (usuario, contrasena, es_admin) VALUES (:usuario, :contrasena, :es_admin)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'usuario' => $usuario,
            'contrasena' => password_hash($contrasena, PASSWORD_BCRYPT),
            'es_admin' => $es_admin
        ]);

        $success = 'Administrador agregado correctamente.';
    } catch (PDOException $e) {
        $error = 'Error al agregar el administrador: ' . htmlspecialchars($e->getMessage());
    }
}

function esAdministrador($usuario_id) {
    global $pdo;
    $sql = "SELECT es_admin FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    return isset($usuario['es_admin']) && $usuario['es_admin'] == 1;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Administrador - Juego de Preguntas</title>
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
                            <a class="nav-link" href="../registro/index.php">Registrarse</a>
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
        <section class="hero-section">
            <div class="container">
                <h1>Agregar Nuevo Administrador</h1>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <?php if ($error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo htmlspecialchars($success); ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                            </div>
                            <button type="submit" class="btn btn-light">Agregar Administrador</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p class="mb-0">Desarrollado por Alex 👻</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
