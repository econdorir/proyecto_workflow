<div>
    <h3>Seleccionar Beca - Datos del Estudiante</h3>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nombre_completo ?? '') ?></p>
    <label>Tipo de Beca:</label>
    <div><?= htmlspecialchars($app['tipo_beca'] ?? '') ?></div>

    <label>Año de inicio:</label>
    <input type="number" name="anio_inicio" id="anio_inicio" min="2000" max="2100" >

    <label>Año de fin:</label>
    <input type="number" name="anio_fin" id="anio_fin" min="2000" max="2100" >

    <label>Semestre de inicio:</label>
    <input type="text" name="semestre_inicio" id="semestre_inicio" placeholder="Ej: 2024-I" >

    <label>Semestre de fin:</label>
    <input type="text" name="semestre_fin" id="semestre_fin" placeholder="Ej: 2025-II" >
</div>
<script>
['anio_inicio','anio_fin','semestre_inicio','semestre_fin'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) {
        el.addEventListener('input', function() {
            sessionStorage.setItem(id, el.value);
        });
        if (sessionStorage.getItem(id)) {
            el.value = sessionStorage.getItem(id);
        }
    }
});
window.addEventListener('DOMContentLoaded', function() {
    var inputs = ['anio_inicio','anio_fin','semestre_inicio','semestre_fin'];
    var siguienteBtn = document.querySelector('button[name="siguiente"]');
    if (siguienteBtn) {
        siguienteBtn.addEventListener('click', function(e) {
            var data = {};
            inputs.forEach(function(id) {
                data[id] = document.getElementById(id).value;
            });
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'procesos/save_seleccion_session.php', false);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        });
    }
});
</script> 