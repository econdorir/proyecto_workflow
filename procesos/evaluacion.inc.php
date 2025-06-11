<div>
    <h3>Evaluación de Solicitud de Beca</h3>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nombre_completo ?? '') ?></p>
    <h4>Datos del Estudiante</h4>
    <ul>
        <li><strong>Código:</strong> <?= htmlspecialchars($app['codigo_estudiante'] ?? '') ?></li>
        <li><strong>DNI:</strong> <?= htmlspecialchars($app['dni'] ?? '') ?></li>
        <li><strong>Correo:</strong> <?= htmlspecialchars($app['correo'] ?? '') ?></li>
        <li><strong>Teléfono:</strong> <?= htmlspecialchars($app['telefono'] ?? '') ?></li>
        <li><strong>Dirección:</strong> <?= htmlspecialchars($app['direccion'] ?? '') ?></li>
        <li><strong>Carrera:</strong> <?= htmlspecialchars($app['carrera'] ?? '') ?></li>
        <li><strong>Ciclo académico:</strong> <?= htmlspecialchars($app['ciclo_academico'] ?? '') ?></li>
    </ul>
    <h4>Datos de la Aplicación a la Beca</h4>
    <ul>
        <li><strong>Tipo de Beca:</strong> <?= htmlspecialchars($app['tipo_beca'] ?? '') ?></li>
        <li><strong>Motivo:</strong> <?= nl2br(htmlspecialchars($app['motivo'] ?? '')) ?></li>
        <li><strong>Monto Solicitado:</strong> <?= htmlspecialchars($app['monto_solicitado'] ?? '') ?></li>
        <li><strong>Observaciones:</strong> <?= nl2br(htmlspecialchars($app['observaciones'] ?? '')) ?></li>
        <li><strong>Año de inicio:</strong> <?= htmlspecialchars($app['anio_inicio'] ?? '') ?></li>
        <li><strong>Año de fin:</strong> <?= htmlspecialchars($app['anio_fin'] ?? '') ?></li>
        <li><strong>Semestre de inicio:</strong> <?= htmlspecialchars($app['semestre_inicio'] ?? '') ?></li>
        <li><strong>Semestre de fin:</strong> <?= htmlspecialchars($app['semestre_fin'] ?? '') ?></li>
    </ul>
</div> 