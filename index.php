<?php
use oinia\core\App;
use  oinia\core\Router;
use oinia\core\Request;
use oinia\app\exceptions\AppException;
use  oinia\app\exceptions\NotFoundException;

try {
    require_once 'core/bootstrap.php';

    App::get('router')->direct(Request::uri(), Request::method());
    

} catch ( AppException $appException ) {
    $appException->handleError();
    }

