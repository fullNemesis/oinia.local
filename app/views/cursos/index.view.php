<?php 
use oinia\core\helpers\FlashMessage;

$rutaBase = dirname(dirname(__FILE__));
require_once $rutaBase . '/partials/header.view.php'; 

$mensaje = FlashMessage::get('mensaje');
$error = FlashMessage::get('error');
?>

<div class="container mt-4">
    <h1>Cursos Disponibles</h1>
    
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

    <?php if (isset($appUser) && $appUser->getRole() === 'ROLE_ADMIN'): ?>
        <div class="mb-3">
            <a href="/cursos/crear" class="btn btn-primary">Crear Nuevo Curso</a>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($cursos as $curso): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($curso->getNombre()) ?></h5>
                        <p class="card-text">
                            <?= htmlspecialchars(substr($curso->getDescripcion(), 0, 100)) ?>...
                        </p>
                        <p class="card-text">
                            <small class="text-muted">
                                Nivel: <?= htmlspecialchars($curso->getNivel()) ?>
                            </small>
                        </p>
                        <p class="card-text">
                            <strong>Precio: <?= number_format($curso->getPrecio(), 2) ?> €</strong>
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="/cursos/ver/<?= $curso->getId() ?>" class="btn btn-info">Ver detalles</a>
                            <?php if (isset($appUser) && $appUser->getRole() === 'ROLE_USER'): ?>
                                <a href="/cursos/inscribirse/<?= $curso->getId() ?>" class="btn btn-success">Inscribirse</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once $rutaBase . '/partials/footer.view.php'; ?> 