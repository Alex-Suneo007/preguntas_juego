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
    <link href="css/styles.css" rel="stylesheet">
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

    <main>
        <section class="hero-section">
            <div class="container">
                <h1>¡Pon a prueba tus conocimientos!</h1>
                <p class="lead">Únete a nuestro juego de preguntas y desafía tu mente.</p>
                <a href="<?php echo $usuario_autenticado ? 'jugador/index.php' : 'login/login.php'; ?>" class="btn btn-light btn-lg mt-3"><?php echo $usuario_autenticado ? 'Comenzar a Jugar' : 'Iniciar sesión'; ?></a>
            </div>
        </section>

        <section class="container my-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img src="images/feature1.jpg" class="card-img-top" alt="Características del juego">
                        <div class="card-body">
                            <h5 class="card-title">Características del Juego</h5>
                            <p class="card-text">Disfruta de una amplia gama de preguntas y desafíos que te mantendrán entretenido.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img src="images/feature2.jpg" class="card-img-top" alt="Ranking de Jugadores">
                        <div class="card-body">
                            <h5 class="card-title">Ranking de Jugadores</h5>
                            <p class="card-text">Compite con otros jugadores y muestra tus habilidades en el ranking.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img src="images/feature3.jpg" class="card-img-top" alt="Interfaz Amigable">
                        <div class="card-body">
                            <h5 class="card-title">Interfaz Amigable</h5>
                            <p class="card-text">Una interfaz intuitiva que te permitirá jugar sin complicaciones.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Juego de Preguntas. Todos los derechos reservados.</p>
            <a href="index.php">Inicio</a> | 
            <a href="login/login.php">Iniciar sesión</a> | 
            <a href="registro/index.php">Registrarse</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
