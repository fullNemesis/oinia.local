<?php 
use oinia\core\helpers\FlashMessage;
?>

<div class="container mt-4">
    <h1>Mis Cursos</h1>

    <?php 
    $mensaje = FlashMessage::get('mensaje');
    $error = FlashMessage::get('error');
    ?>

    <?php if ($mensaje): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $mensaje ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (empty($inscripciones)): ?>
        <div class="alert alert-info">
            No estás inscrito en ningún curso actualmente.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($inscripciones as $inscripcion): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php 
                                    $curso = $inscripcion->getCurso();
                                    echo $curso ? htmlspecialchars($curso->getNombre()) : 'Curso no disponible';
                                ?>
                            </h5>
                            <p class="card-text">
                                <strong>Estado:</strong> 
                                <span class="badge <?= $inscripcion->getEstado() === 'pendiente' ? 'badge-warning' : 'badge-success' ?>">
                                    <?= ucfirst($inscripcion->getEstado()) ?>
                                </span>
                            </p>
                            <?php if ($curso): ?>
                                <a href="/cursos/ver/<?= $inscripcion->getCursoId() ?>" class="btn btn-info">Ver detalles</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="/cursos" class="btn btn-primary">Ver todos los cursos</a>
    </div>
</div> 