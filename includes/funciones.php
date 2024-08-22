<?php
// Incluye la conexión a la base de datos
include_once('db.php');

// Función para sanitizar datos de entrada
function sanitizar($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Función para verificar si un usuario está autenticado
function verificarAutenticacion() {
    session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login/login.php");
        exit();
    }
}

// Función para obtener el nombre del rol del usuario
function obtenerNombreRol($rol_id) {
    global $conn; // Usa la conexión a la base de datos
    $stmt = $conn->prepare("SELECT nombre FROM roles WHERE id = ?");
    $stmt->bind_param("i", $rol_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['nombre'];
}

// Función para agregar una nueva pregunta
function agregarPregunta($texto_pregunta) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO preguntas (texto) VALUES (?)");
    $stmt->bind_param("s", $texto_pregunta);
    return $stmt->execute();
}

// Función para agregar una nueva respuesta
function agregarRespuesta($pregunta_id, $texto_respuesta, $es_correcta) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO respuestas (pregunta_id, texto, es_correcta) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $pregunta_id, $texto_respuesta, $es_correcta);
    return $stmt->execute();
}

// Función para obtener todas las preguntas
function obtenerPreguntas() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM preguntas");
    $stmt->execute();
    return $stmt->get_result();
}

// Función para obtener respuestas de una pregunta
function obtenerRespuestas($pregunta_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM respuestas WHERE pregunta_id = ?");
    $stmt->bind_param("i", $pregunta_id);
    $stmt->execute();
    return $stmt->get_result();
}

// Función para verificar las credenciales del usuario
function verificarCredenciales($correo, $contrasena) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, contrasena FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($contrasena, $user['contrasena'])) {
        return $user['id'];
    } else {
        return false;
    }
}

// Función para crear un nuevo usuario
function crearUsuario($nombre, $correo, $contrasena, $rol_id) {
    global $conn;
    $hashed_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena, rol_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nombre, $correo, $hashed_contrasena, $rol_id);
    return $stmt->execute();
}

// Función para obtener el nombre de un usuario por su ID
function obtenerNombreUsuario($usuario_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT nombre FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['nombre'];
}
?>
