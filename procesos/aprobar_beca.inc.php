<div>
    <h3>Aprobar Beca</h3>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nombre_completo ?? '') ?></p>
    <label>Tipo de Beca:</label>
    <div><?= htmlspecialchars($app['tipo_beca'] ?? '') ?></div>

    <label>Motivo de la Solicitud:</label>
    <div><?= nl2br(htmlspecialchars($app['motivo'] ?? '')) ?></div>

    <label>Monto Solicitado:</label>
    <div><?= htmlspecialchars($app['monto_solicitado'] ?? '') ?></div>

    <label>Observaciones:</label>
    <div><?= nl2br(htmlspecialchars($app['observaciones'] ?? '')) ?></div>

    <p style="margin-top:20px; color:blue;">¿Desea aprobar la beca para este estudiante?</p>
    <label><input type="radio" name="aprobado" value="si" required> Sí</label>
    <label><input type="radio" name="aprobado" value="no"> No</label>
</div>
<script>
// Store the selected value in sessionStorage for the motor file to use
const radios = document.getElementsByName('aprobado');
radios.forEach(radio => {
    radio.addEventListener('change', function() {
        sessionStorage.setItem('aprobado', this.value);
    });
    // Restore selection if available
    if (sessionStorage.getItem('aprobado') === radio.value) {
        radio.checked = true;
    }
});
// On Siguiente, send the value to PHP session
window.addEventListener('DOMContentLoaded', function() {
    var siguienteBtn = document.querySelector('button[name="siguiente"]');
    if (siguienteBtn) {
        siguienteBtn.addEventListener('click', function(e) {
            var data = { aprobado: document.querySelector('input[name="aprobado"]:checked')?.value || '' };
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'procesos/save_aprobado_session.php', false);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        });
    }
});
</script> 