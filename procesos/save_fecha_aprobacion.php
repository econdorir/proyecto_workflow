<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$data = json_decode(file_get_contents('php://input'), true);
if ($data) {
    $_SESSION['fecha_aprobacion'] = $data['fecha_aprobacion'] ?? '';
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'No data received']);
} 