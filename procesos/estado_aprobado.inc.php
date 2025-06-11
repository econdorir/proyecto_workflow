<div>
    <h3>Confirmar Aprobación de Estudiante</h3>
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
    <label><input type="checkbox" id="confirm_aprobado"> Confirmo que el estudiante está aprobado</label>
</div>
<script>
// Save checkbox state to sessionStorage
var confirmBox = document.getElementById('confirm_aprobado');
confirmBox.addEventListener('change', function() {
    sessionStorage.setItem('confirm_aprobado', this.checked ? '1' : '');
});
if (sessionStorage.getItem('confirm_aprobado') === '1') {
    confirmBox.checked = true;
}
window.addEventListener('DOMContentLoaded', function() {
    var siguienteBtn = document.querySelector('button[name="siguiente"]');
    if (siguienteBtn) {
        siguienteBtn.addEventListener('click', function(e) {
            var data = { confirm_aprobado: document.getElementById('confirm_aprobado').checked ? '1' : '' };
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'procesos/save_confirm_aprobado.php', false);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        });
    }
});
</script> 