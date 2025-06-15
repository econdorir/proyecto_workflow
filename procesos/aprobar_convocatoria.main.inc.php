<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// No es necesario cargar nada desde la base de datos en esta etapa.
?>
