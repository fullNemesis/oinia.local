<?php 
    $rutaBase = dirname(dirname(__FILE__));
    require_once $rutaBase . '/partials/header.view.php'; 
?>

<div class="container mt-4">
    <h1>Crear Nuevo Curso</h1>

    <?php if (isset($_SESSION['errores'])): ?>
        <div class="alert alert-danger">
            <?php foreach ($_SESSION['errores'] as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/cursos/crear">
        <div class="form-group">
            <label for="nombre">Nombre del curso</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="idioma_id">Idioma</label>
            <select class="form-control" id="idioma_id" name="idioma_id" required>
                <?php foreach ($idiomas as $idioma): ?>
                    <option value="<?= $idioma->getId() ?>"><?= htmlspecialchars($idioma->getNombre()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="nivel">Nivel</label>
            <select class="form-control" id="nivel" name="nivel" required>
                <option value="Principiante">Principiante</option>
                <option value="Intermedio">Intermedio</option>
                <option value="Avanzado">Avanzado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
        </div>

        <div class="form-group">
            <label for="plazas">Número de plazas</label>
            <input type="number" class="form-control" id="plazas" name="plazas" min="1" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Curso</button>
        <a href="/cursos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once $rutaBase . '/partials/footer.view.php'; ?> 