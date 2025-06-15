<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// No se realiza ninguna operación, solo confirmación visual (opcional)
?>
<div style="color: blue;">Revise los datos antes de continuar a la aprobación final.</div>
