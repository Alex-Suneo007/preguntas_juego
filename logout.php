<?php
// Inicia la sesión
session_start();

// Destruye la sesión actual
session_unset();
session_destroy();

// Redirige al usuario a la página principal
header("Location: index.php");
exit();
?>
