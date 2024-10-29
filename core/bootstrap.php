<?php
    use  dwes\core\App;
    use dwes\app\utils\MyLog;
    use  dwes\core\Router;

    require __DIR__ . '/../vendor/autoload.php';

    $config = require_once __DIR__ . '/../app/config.php';
    
    App::bind('config',$config); // Guardamos la configuración en el contenedor de servicios

    $router = Router::load('app/routes.php');
    App::bind('router',$router);

    $logger = MyLog::load('logs/curso.log'); // no está creado curso.log
    App::bind('logger',$logger);
    
