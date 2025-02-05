<?php

use oinia\core\App;

// Obtener la URI actual y asegurarnos de que tenga un valor por defecto
$currentUri = isset($app['uri']) ? $app['uri'] : '';
?>

<div class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/"><img src="../public/images/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= $currentUri === '' ? 'active' : '' ?>">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item <?= $currentUri === 'languages' ? 'active' : '' ?>">
                        <a class="nav-link" href="/languages">Languages</a>
                    </li>
                    <li class="nav-item <?= $currentUri === 'services' ? 'active' : '' ?>">
                        <a class="nav-link" href="/services">Services</a>
                    </li>
                    <li class="nav-item <?= $currentUri === 'events' ? 'active' : '' ?>">
                        <a class="nav-link" href="/events">Events</a>
                    </li>
                    <?php if (!is_null(App::get('appUser'))): ?>
                        <li class="nav-item <?= $currentUri === 'cursos' ? 'active' : '' ?>">
                            <a class="nav-link" href="/cursos">Cursos</a>
                        </li>
                        <li class="nav-item <?= $currentUri === 'mis-cursos' ? 'active' : '' ?>">
                            <a class="nav-link" href="/mis-cursos">Mis Cursos</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item <?= $currentUri === 'contact' ? 'active' : '' ?>">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                </ul>
                <div class="user-actions">
                    <?php if (is_null(App::get('appUser'))): ?>
                        <a href="/login" class="btn btn-outline-primary mr-2">Login</a>
                        <a href="/registro" class="btn btn-primary">Registro</a>
                    <?php else: ?>
                        <span class="mr-2">
                            Bienvenido, <?= htmlspecialchars(App::get('appUser')->getUsername()) ?>
                            <?php if (App::get('appUser')->getRole() === 'ROLE_ADMIN'): ?>
                                (Admin)
                            <?php endif; ?>
                        </span>
                        <a href="/logout" class="btn btn-outline-danger">Cerrar sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</div>