<?php
session_start(); // Asegúrate de que esté solo una vez en el flujo de tu aplicación
require_once 'db.php'; // Asegúrate de que el archivo db.php esté en la ubicación correcta

function redirigirSiNoAutenticado($url) {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . $url);
        exit();
    }
}

function redirigirSiNoEsAdmin($url) {
    if (isset($_SESSION['usuario_id'])) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT es_admin FROM usuarios WHERE id = ?');
        $stmt->execute([$_SESSION['usuario_id']]);
        $usuario = $stmt->fetch();
        
        if (!$usuario || $usuario['es_admin'] != 1) {
            header('Location: ' . $url);
            exit();
        }
    } else {
        header('Location: ' . $url);
        exit();
    }
}

function verificarAutenticacion() {
    return isset($_SESSION['usuario_id']);
}

function esAdmin() {
    if (isset($_SESSION['usuario_id'])) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT es_admin FROM usuarios WHERE id = ?');
        $stmt->execute([$_SESSION['usuario_id']]);
        $usuario = $stmt->fetch();
        return $usuario['es_admin'] == 1;
    }
    return false;
}

function agregarPregunta($pregunta, $categoria) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('INSERT INTO preguntas (pregunta, categoria) VALUES (?, ?)');
        return $stmt->execute([$pregunta, $categoria]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function agregarRespuesta($pregunta_id, $respuesta, $es_correcta) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('INSERT INTO respuestas (pregunta_id, respuesta, es_correcta) VALUES (?, ?, ?)');
        return $stmt->execute([$pregunta_id, $respuesta, $es_correcta]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function obtenerPreguntas() {
    global $pdo;
    try {
        $stmt = $pdo->query('SELECT id, pregunta FROM preguntas');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return [];
    }
}

function obtenerRespuestas($pregunta_id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('SELECT id, respuesta, es_correcta FROM respuestas WHERE pregunta_id = ?');
        $stmt->execute([$pregunta_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return [];
    }
}

function eliminarRespuesta($respuesta_id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('DELETE FROM respuestas WHERE id = ?');
        return $stmt->execute([$respuesta_id]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function verificarUsuario($correo, $contrasena) {
    global $pdo;
    try {
        $stmt = $pdo->prepare('SELECT id, contrasena, es_admin FROM usuarios WHERE correo = ?');
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            // Guardar la información del usuario en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['es_admin'] = $usuario['es_admin'];
            return true;
        }
        return false;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function obtenerNombreUsuario() {
    global $pdo;
    if (isset($_SESSION['usuario_id'])) {
        $stmt = $pdo->prepare('SELECT nombre FROM usuarios WHERE id = ?');
        $stmt->execute([$_SESSION['usuario_id']]);
        $usuario = $stmt->fetch();
        return $usuario['nombre'] ?? '';
    }
    return '';
}
?>
