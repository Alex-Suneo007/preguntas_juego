<?php
session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    
    // Insertar el primer administrador
    $sql = "INSERT INTO usuarios (correo, contrasena, es_admin) VALUES (:correo, :contrasena, 1)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['correo' => $correo, 'contrasena' => $contrasena])) {
        echo "Administrador registrado exitosamente.";
    } else {
        echo "Error al registrar el administrador.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Registrar Administrador</h1>
        <form method="post">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Administrador</button>
        </form>
    </div>
</body>
</html>
