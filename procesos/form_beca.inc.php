<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
    <div style="color: green;">¡Solicitud de beca enviada correctamente!</div>
<?php endif; ?>
<div>
    <h3>Formulario de Solicitud de Beca</h3>
    <label for="tipo_beca">Tipo de Beca:</label>
    <input type="text" name="tipo_beca" id="tipo_beca" value="<?= htmlspecialchars($app['tipo_beca'] ?? '') ?>" required>

    <label for="motivo">Motivo de la Solicitud:</label>
    <textarea name="motivo" id="motivo" required><?= htmlspecialchars($app['motivo'] ?? '') ?></textarea>

    <label for="monto_solicitado">Monto Solicitado:</label>
    <input type="number" name="monto_solicitado" id="monto_solicitado" min="0" value="<?= htmlspecialchars($app['monto_solicitado'] ?? '') ?>" required>

    <label for="observaciones">Observaciones:</label>
    <textarea name="observaciones" id="observaciones"><?= htmlspecialchars($app['observaciones'] ?? '') ?></textarea>
</div> 