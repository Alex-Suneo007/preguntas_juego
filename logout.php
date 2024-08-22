<?php
session_start();
session_unset();
session_destroy();
header('Location: index.php'); // Redirige a la página principal después de cerrar sesión
exit();
?>
