<div>
    <h3>Verificación de Documentos</h3>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nombre_completo ?? '') ?></p>
    <label>Tipo de Beca:</label>
    <div><?= htmlspecialchars($app['tipo_beca'] ?? '') ?></div>

    <label>Motivo de la Solicitud:</label>
    <div><?= nl2br(htmlspecialchars($app['motivo'] ?? '')) ?></div>

    <label>Monto Solicitado:</label>
    <div><?= htmlspecialchars($app['monto_solicitado'] ?? '') ?></div>

    <label>Observaciones:</label>
    <div><?= nl2br(htmlspecialchars($app['observaciones'] ?? '')) ?></div>

    <p style="margin-top:20px; color:blue;">Si está bien los documentos y quiere continuar, presione Siguiente.</p>
</div>