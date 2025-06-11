<div>
    <h3>Resultado de la Postulación a la Beca</h3>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nombre_completo ?? '') ?></p>
    <label>Tipo de Beca:</label>
    <div><?= htmlspecialchars($app['tipo_beca'] ?? '') ?></div>
    <label>Motivo de la Solicitud:</label>
    <div><?= nl2br(htmlspecialchars($app['motivo'] ?? '')) ?></div>
    <label>Monto Solicitado:</label>
    <div><?= htmlspecialchars($app['monto_solicitado'] ?? '') ?></div>
    <label>Observaciones:</label>
    <div><?= nl2br(htmlspecialchars($app['observaciones'] ?? '')) ?></div>
    <br>
    <?php if (($app['estado'] ?? '') === 'aprobado'): ?>
        <div style="color: green; font-weight: bold; font-size: 1.2em;">¡Felicidades! Tu beca ha sido <u>aprobada</u>.</div>
    <?php elseif (($app['estado'] ?? '') === 'reprobado' || ($app['estado'] ?? '') === 'rechazado'): ?>
        <div style="color: red; font-weight: bold; font-size: 1.2em;">Lamentablemente, tu beca ha sido <u>rechazada</u>.</div>
    <?php else: ?>
        <div style="color: orange; font-weight: bold; font-size: 1.2em;">Tu postulación está en proceso de evaluación.</div>
    <?php endif; ?>
</div> 