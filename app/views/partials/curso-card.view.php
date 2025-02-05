<div class="card h-100">
    <div class="card-body">
        <h5 class="card-title">
            <a href="/cursos/<?= $curso->getId() ?>" class="text-decoration-none">
                <?= htmlspecialchars($curso->getNombre()) ?>
            </a>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">
            Nivel: <?= htmlspecialchars($curso->getNivel()) ?>
        </h6>
        <p class="card-text">
            <?= htmlspecialchars($curso->getDescripcion()) ?>
        </p>
        <ul class="list-unstyled">
            <li><strong>Inicio:</strong> <?= $curso->getFechaInicio()->format('d/m/Y') ?></li>
            <li><strong>Fin:</strong> <?= $curso->getFechaFin()->format('d/m/Y') ?></li>
            <li><strong>Plazas:</strong> <?= $curso->getPlazas() ?></li>
            <li><strong>Precio:</strong> <?= number_format($curso->getPrecio(), 2) ?> €</li>
        </ul>
    </div>
    <div class="card-footer">
        <a href="/cursos/inscribirse/<?= $curso->getId() ?>" class="btn btn-success">
            Inscribirse
        </a>
    </div>
</div> 