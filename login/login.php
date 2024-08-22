<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE correo = :correo');
    $stmt->execute(['correo' => $correo]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['rol_id'] = $usuario['rol_id'];
        header('Location: ../index.php');
        exit();
    } else {
        $error = 'Correo o contraseña incorrectos';
    }
}
?>

<form method="post">
    <input type="email" name="correo" placeholder="Correo" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit">Iniciar sesión</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
