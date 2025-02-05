<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="public/assets/images/logo.png" alt="Oinia">
            Oinia
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/languages">Languages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/events">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cursos">Cursos</a>
                </li>
                <?php if (isset($appUser) && $appUser->getRole() !== 'ROLE_ADMIN'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/mis-cursos">Mis Cursos</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact Us</a>
                </li>
            </ul>
            <div class="auth-buttons">
                <?php if (isset($appUser)): ?>
                    <div class="user-info">
                        Bienvenido, <?= htmlspecialchars($appUser->getUsername()) ?> 
                        (<?= $appUser->getRole() === 'ROLE_ADMIN' ? 'Admin' : 'Usuario' ?>)
                    </div>
                    <a class="nav-link" href="/logout">Cerrar sesión</a>
                <?php else: ?>
                    <a class="nav-link" href="/login">Iniciar Sesión</a>
                    <a class="nav-link" href="/registro">Registro</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav> 