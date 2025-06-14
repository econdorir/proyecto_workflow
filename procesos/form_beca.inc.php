<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
    <div style="color: green;">¡Solicitud de beca enviada correctamente!</div>
<?php endif; ?>
<div>
    <h3>Formulario de Solicitud de Beca</h3>
    <label for="tipo_beca">Tipo de Beca:</label>
    <input type="text" name="tipo_beca" id="tipo_beca" value="<?= htmlspecialchars($app['tipo_beca'] ?? '') ?>" >

    <label for="motivo">Motivo de la Solicitud:</label>
    <textarea name="motivo" id="motivo"><?= htmlspecialchars($app['motivo'] ?? '') ?></textarea>

    <label for="monto_solicitado">Monto Solicitado:</label>
    <input type="number" name="monto_solicitado" id="monto_solicitado" min="0" value="<?= htmlspecialchars($app['monto_solicitado'] ?? '') ?>" >

    <label for="observaciones">Observaciones:</label>
    <textarea name="observaciones" id="observaciones"><?= htmlspecialchars($app['observaciones'] ?? '') ?></textarea>
</div>
<script>
// Save inputs to sessionStorage on change
['tipo_beca','motivo','monto_solicitado','observaciones'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) {
        el.addEventListener('input', function() {
            sessionStorage.setItem(id, el.value);
        });
        // Restore from sessionStorage if available
        if (sessionStorage.getItem(id)) {
            el.value = sessionStorage.getItem(id);
        }
    }
});
// On Siguiente, send data to PHP session
window.addEventListener('DOMContentLoaded', function() {
    var formInputs = ['tipo_beca','motivo','monto_solicitado','observaciones'];
    var siguienteBtn = document.querySelector('button[name="siguiente"]');
    if (siguienteBtn) {
        siguienteBtn.addEventListener('click', function(e) {
            var data = {};
            formInputs.forEach(function(id) {
                data[id] = document.getElementById(id).value;
            });
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'procesos/save_beca_session.php', false); // sync to ensure session is set before navigation
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        });
    }
});
</script> 