<?php

namespace oinia\app\middleware;

use oinia\core\App;
use oinia\app\entity\Usuario;
use oinia\app\repository\UsuarioRepository;

class AuthMiddleware
{
    public function handle()
    {
        if (isset($_SESSION['loguedUser'])) {
            $usuario = App::getRepository(UsuarioRepository::class)->find($_SESSION['loguedUser']);
            if ($usuario) {
                $usuario->setRole($_SESSION['userRole'] ?? 'ROLE_USER');
                App::bind('appUser', $usuario);
            }
        }
    }
} 