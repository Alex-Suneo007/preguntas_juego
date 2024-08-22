<?php
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, correo, contrasena, rol_id) VALUES (:nombre, :correo, :contrasena, 2)');
    $stmt->execute(['nombre' => $nombre, 'correo' => $correo, 'contrasena' => $contrasena]);

    header('Location: login.php');
    exit();
}
?>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="correo" placeholder="Correo" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
</form>
