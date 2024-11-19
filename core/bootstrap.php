<?php
use dwes\app\repository\UsuarioRepository;
use  dwes\core\App;
use dwes\app\utils\MyLog;
use  dwes\core\Router;

require __DIR__ . '/../vendor/autoload.php';
Session_start();
$config = require_once __DIR__ . '/../app/config.php';

App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios
$router = Router::load(__DIR__ . '/../app/' . $config['routes']['filename']);

App::bind('router', $router);

$logger = MyLog::load(__DIR__ . '/../logs/' . $config['logs']['filename'], $config['logs']['level']);
App::bind('logger', $logger);

if (isset($_SESSION['loguedUser'])) // Obtenemos el repositorio del usuario logueado y lo guardamos en el contenedor de servicios
    $appUser = App::getRepository(UsuarioRepository::class)->find($_SESSION['loguedUser']);
else
    $appUser = null;
App::bind('appUser', $appUser);
