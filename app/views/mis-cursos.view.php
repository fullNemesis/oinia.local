<?php
use oinia\core\App;
?>

<div class="container mt-5">
    <h1 class="mb-4">Mis Cursos</h1>

    <?php if (empty($inscripciones)): ?>
        <div class="alert alert-info">
            No estás inscrito en ningún curso todavía. 
            <a href="cursos" class="alert-link">Ver cursos disponibles</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($inscripciones as $inscripcion): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="badge badge-<?= $inscripcion->getEstado() === 'confirmado' ? 'success' : 
                                                    ($inscripcion->getEstado() === 'pendiente' ? 'warning' : 'danger') ?>">
                                <?= ucfirst($inscripcion->getEstado()) ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($inscripcion->getCurso()->getNombre()) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Nivel: <?= htmlspecialchars($inscripcion->getCurso()->getNivel()) ?>
                            </h6>
                            <p class="card-text">
                                <?= htmlspecialchars($inscripcion->getCurso()->getDescripcion()) ?>
                            </p>
                            <ul class="list-unstyled">
                                <li><strong>Inicio:</strong> <?= $inscripcion->getCurso()->getFechaInicio()->format('d/m/Y') ?></li>
                                <li><strong>Fin:</strong> <?= $inscripcion->getCurso()->getFechaFin()->format('d/m/Y') ?></li>
                                <li><strong>Fecha de inscripción:</strong> <?= $inscripcion->getFechaInscripcion()->format('d/m/Y H:i') ?></li>
                            </ul>
                        </div>
                        <?php if ($inscripcion->getEstado() !== 'cancelado'): ?>
                            <div class="card-footer">
                                <form action="cursos/cancelar/<?= $inscripcion->getId() ?>" method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas cancelar la inscripción?')">
                                        Cancelar inscripción
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div> 