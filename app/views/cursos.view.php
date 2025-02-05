<?php
use oinia\core\App;
?>
<div class="container mt-5">
    <h1 class="mb-4">Cursos Disponibles</h1>

    <?php if (App::get('appUser')->getRole() === 'ROLE_ADMIN'): ?>
        <div class="mb-4">
            <a href="/cursos/nuevo" class="btn btn-primary">Crear Nuevo Curso</a>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Filtrar por Idioma</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="/cursos" class="list-group-item list-group-item-action <?= !isset($_GET['idioma']) ? 'active' : '' ?>">
                            Todos los idiomas
                        </a>
                        <?php foreach ($idiomas as $idioma): ?>
                            <a href="/cursos?idioma=<?= $idioma->getId() ?>" 
                               class="list-group-item list-group-item-action <?= isset($_GET['idioma']) && $_GET['idioma'] == $idioma->getId() ? 'active' : '' ?>">
                                <?= htmlspecialchars($idioma->getNombre()) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <?php if (empty($cursos)): ?>
                <div class="alert alert-info">
                    No hay cursos disponibles en este momento.
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($cursos as $curso): ?>
                        <div class="col-md-6 mb-4">
                            <?php include __DIR__ . '/partials/curso-card.view.php'; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div> 