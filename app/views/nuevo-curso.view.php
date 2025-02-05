<?php
use oinia\core\App;

// Verificar si el usuario es administrador
if (is_null(App::get('appUser')) || App::get('appUser')->getRole() !== 'ROLE_ADMIN') {
    header('Location: /login');
    exit;
}
?>

<div class="container mt-5">
    <h1 class="mb-4">Crear Nuevo Curso</h1>

    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errores as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="/cursos/nuevo" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre del Curso *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required
                           value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="idioma">Idioma *</label>
                    <select class="form-control" id="idioma" name="idioma_id" required>
                        <option value="">Selecciona un idioma</option>
                        <?php foreach ($idiomas as $idioma): ?>
                            <option value="<?= $idioma->getId() ?>" 
                                    <?= isset($_POST['idioma_id']) && $_POST['idioma_id'] == $idioma->getId() ? 'selected' : '' ?>>
                                <?= htmlspecialchars($idioma->getNombre()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción *</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?= 
                        isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '' 
                    ?></textarea>
                </div>

                <div class="form-group">
                    <label for="nivel">Nivel *</label>
                    <select class="form-control" id="nivel" name="nivel" required>
                        <option value="">Selecciona un nivel</option>
                        <option value="Básico" <?= isset($_POST['nivel']) && $_POST['nivel'] == 'Básico' ? 'selected' : '' ?>>Básico</option>
                        <option value="Intermedio" <?= isset($_POST['nivel']) && $_POST['nivel'] == 'Intermedio' ? 'selected' : '' ?>>Intermedio</option>
                        <option value="Avanzado" <?= isset($_POST['nivel']) && $_POST['nivel'] == 'Avanzado' ? 'selected' : '' ?>>Avanzado</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio *</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required
                                   value="<?= isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin *</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required
                                   value="<?= isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '' ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="plazas">Número de Plazas *</label>
                            <input type="number" class="form-control" id="plazas" name="plazas" required min="1"
                                   value="<?= isset($_POST['plazas']) ? $_POST['plazas'] : '20' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio">Precio (€) *</label>
                            <input type="number" class="form-control" id="precio" name="precio" required min="0" step="0.01"
                                   value="<?= isset($_POST['precio']) ? $_POST['precio'] : '' ?>">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Crear Curso</button>
                    <a href="/cursos" class="btn btn-secondary ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validar que la fecha de fin sea posterior a la fecha de inicio
    document.querySelector('form').addEventListener('submit', function(e) {
        var fechaInicio = new Date(document.getElementById('fecha_inicio').value);
        var fechaFin = new Date(document.getElementById('fecha_fin').value);
        
        if (fechaFin <= fechaInicio) {
            e.preventDefault();
            alert('La fecha de fin debe ser posterior a la fecha de inicio');
        }
    });
});
</script> 