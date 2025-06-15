<!-- confirmar_convocatoria.inc.php -->
<div>
    <h3>Confirmar Datos de la Convocatoria</h3>

    <label>Nombre de la Beca:</label>
    <div><?= htmlspecialchars($_SESSION['nombre_beca'] ?? '') ?></div>

    <label>Descripción:</label>
    <div><?= nl2br(htmlspecialchars($_SESSION['descripcion'] ?? '')) ?></div>

    <label>Fecha de Inicio:</label>
    <div><?= htmlspecialchars($_SESSION['fecha_inicio'] ?? '') ?></div>

    <label>Fecha de Finalización:</label>
    <div><?= htmlspecialchars($_SESSION['fecha_fin'] ?? '') ?></div>

    <label>Requisitos:</label>
    <div><?= nl2br(htmlspecialchars($_SESSION['requisitos'] ?? '')) ?></div>

    <label>Monto:</label>
    <div><?= htmlspecialchars($_SESSION['monto'] ?? '') ?> Bs</div>

    <p>Verifique que todos los datos estén correctos antes de aprobar.</p>
</div>
