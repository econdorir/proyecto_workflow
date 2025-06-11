<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$data = json_decode(file_get_contents('php://input'), true);
if ($data) {
    $_SESSION['anio_inicio'] = $data['anio_inicio'] ?? '';
    $_SESSION['anio_fin'] = $data['anio_fin'] ?? '';
    $_SESSION['semestre_inicio'] = $data['semestre_inicio'] ?? '';
    $_SESSION['semestre_fin'] = $data['semestre_fin'] ?? '';
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'No data received']);
} 