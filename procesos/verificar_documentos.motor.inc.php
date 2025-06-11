<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';
// No logic needed yet; approval will be handled in aprobar_beca
?> 