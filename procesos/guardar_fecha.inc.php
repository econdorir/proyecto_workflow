<div>
    <h3>Guardar Fecha de Aprobación/Reprobación</h3>
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
    <label for="fecha_aprobacion">Fecha de aprobación/reprobación:</label>
    <input type="date" id="fecha_aprobacion" name="fecha_aprobacion" required>
</div>
<script>
var fechaInput = document.getElementById('fecha_aprobacion');
fechaInput.addEventListener('input', function() {
    sessionStorage.setItem('fecha_aprobacion', this.value);
});
if (sessionStorage.getItem('fecha_aprobacion')) {
    fechaInput.value = sessionStorage.getItem('fecha_aprobacion');
}
window.addEventListener('DOMContentLoaded', function() {
    var siguienteBtn = document.querySelector('button[name="siguiente"]');
    if (siguienteBtn) {
        siguienteBtn.addEventListener('click', function(e) {
            var data = { fecha_aprobacion: document.getElementById('fecha_aprobacion').value };
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'procesos/save_fecha_aprobacion.php', false);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        });
    }
});
</script> 