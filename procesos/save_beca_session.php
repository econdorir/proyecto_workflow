<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$data = json_decode(file_get_contents('php://input'), true);
if ($data) {
    $_SESSION['tipo_beca'] = $data['tipo_beca'] ?? '';
    $_SESSION['motivo'] = $data['motivo'] ?? '';
    $_SESSION['monto_solicitado'] = $data['monto_solicitado'] ?? '';
    $_SESSION['observaciones'] = $data['observaciones'] ?? '';
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'No data received']);
} 