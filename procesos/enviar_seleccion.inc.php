<div>
    <h3>Confirmar Selección de Beca</h3>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nombre_completo ?? '') ?></p>
    <label>Tipo de Beca:</label>
    <div><?= htmlspecialchars($app['tipo_beca'] ?? '') ?></div>

    <label>Año de inicio:</label>
    <div><?= htmlspecialchars($_SESSION['anio_inicio'] ?? '') ?></div>

    <label>Año de fin:</label>
    <div><?= htmlspecialchars($_SESSION['anio_fin'] ?? '') ?></div>

    <label>Semestre de inicio:</label>
    <div><?= htmlspecialchars($_SESSION['semestre_inicio'] ?? '') ?></div>

    <label>Semestre de fin:</label>
    <div><?= htmlspecialchars($_SESSION['semestre_fin'] ?? '') ?></div>

    <p style="margin-top:20px; color:blue;">Revise los datos y presione Siguiente para guardar la selección.</p>
</div> 