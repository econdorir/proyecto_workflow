<!-- form_convocatoria.inc.php -->
<div>
    <h3>Formulario de Detalles de la Convocatoria</h3>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" rows="4" required><?= htmlspecialchars($_SESSION['descripcion'] ?? '') ?></textarea>

    <label for="fecha_inicio">Fecha de inicio:</label>
    <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?= htmlspecialchars($_SESSION['fecha_inicio'] ?? '') ?>" required>

    <label for="fecha_fin">Fecha de finalización:</label>
    <input type="date" name="fecha_fin" id="fecha_fin" value="<?= htmlspecialchars($_SESSION['fecha_fin'] ?? '') ?>" required>

    <label for="requisitos">Requisitos:</label>
    <textarea name="requisitos" id="requisitos" rows="3" required><?= htmlspecialchars($_SESSION['requisitos'] ?? '') ?></textarea>

    <label for="monto">Monto de la beca (en Bs):</label>
    <input type="number" step="0.01" name="monto" id="monto" value="<?= htmlspecialchars($_SESSION['monto'] ?? '') ?>" required>
</div>
