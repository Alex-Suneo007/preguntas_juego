<?php
session_start();
include('../includes/db.php');
include('../includes/funciones.php');

if (!verificarAutenticacion()) {
    header('Location: ../login/index.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$nombre_usuario = '';

$stmt = $pdo->prepare("SELECT nombre FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    $nombre_usuario = htmlspecialchars($usuario['nombre']);
} else {
    // Manejo de errores si el usuario no se encuentra
    $nombre_usuario = 'Usuario desconocido';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Juego de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Juego de Preguntas</a>
                <!-- ... otras partes del navbar ... -->
                <form method="post" action="../logout.php" class="d-inline">
                    <button type="submit" class="btn btn-light">Cerrar sesión</button>
                </form>
            </div>
        </nav>
    </header>
    
    <main>
        <section class="hero-section">
            <div class="container">
                <h1>Bienvenido, <?php echo $nombre_usuario; ?>!</h1>
                <!-- Contenido del juego aquí -->
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p class="mb-0">Desarrollado por Alex 👻</p>
        </div>
    </footer>
</body>
</html>
