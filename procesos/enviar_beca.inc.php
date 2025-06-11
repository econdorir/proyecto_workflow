<div>
    <h3>Revisión de Solicitud de Beca</h3>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nombre_completo ?? '') ?></p>
    <label>Tipo de Beca:</label>
    <div><?= htmlspecialchars($_SESSION['tipo_beca'] ?? '') ?></div>

    <label>Motivo de la Solicitud:</label>
    <div><?= nl2br(htmlspecialchars($_SESSION['motivo'] ?? '')) ?></div>

    <label>Monto Solicitado:</label>
    <div><?= htmlspecialchars($_SESSION['monto_solicitado'] ?? '') ?></div>

    <label>Observaciones:</label>
    <div><?= nl2br(htmlspecialchars($_SESSION['observaciones'] ?? '')) ?></div>
</div> 