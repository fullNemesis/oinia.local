<?php
use oinia\core\App;
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0"><?= htmlspecialchars($curso->getNombre()) ?></h1>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-muted">Detalles del Curso</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><strong>Idioma:</strong> <?= htmlspecialchars($idioma->getNombre()) ?></li>
                                    <li><strong>Nivel:</strong> <?= htmlspecialchars($curso->getNivel()) ?></li>
                                    <li><strong>Fecha de inicio:</strong> <?= $curso->getFechaInicio() ?></li>
                                    <li><strong>Fecha de fin:</strong> <?= $curso->getFechaFin()?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><strong>Plazas totales:</strong> <?= $curso->getPlazas() ?></li>
                                    <li><strong>Plazas disponibles:</strong> <?= $plazasDisponibles ?></li>
                                    <li><strong>Precio:</strong> <?= number_format($curso->getPrecio(), 2) ?> €</li>
                                    <li>
                                        <strong>Estado:</strong>
                                        <?php if ($plazasDisponibles > 0): ?>
                                            <span class="badge bg-success">Disponible</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Completo</span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Descripción</h5>
                        <p><?= nl2br(htmlspecialchars($curso->getDescripcion())) ?></p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/cursos" class="btn btn-secondary">Volver a Cursos</a>
                        <?php if ($plazasDisponibles > 0): ?>
                            <a href="/cursos/inscribirse/<?= $curso->getId() ?>" class="btn btn-success">
                                Inscribirse en el Curso
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 