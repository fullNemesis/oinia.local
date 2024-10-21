<?php
require_once __DIR__ . "/../src/utils/file.class.php";
require_once __DIR__ . "/../src/exceptions/fileException.class.php";
require_once __DIR__ . "/../src/entity/asociado.class.php";
require_once __DIR__."/../src/database/Connection.class.php";
require_once __DIR__."/../src/database/QueryBuilder.class.php";
require_once(__DIR__ . '/../src/repository/AsociadosRepository.php');


try {

    $config = require_once __DIR__ . '/../app/config.php';
    App::bind('config',$config); // Guardamos la configuración en el contenedor de servicios
    $conexion = App::getConnection();
    
    $asociadosRepository = new AsociadosRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['captcha']) && ($_POST['captcha'] != "")) {
            session_start();

            if ($_SESSION['captchaGenerado'] != $_POST['captcha']) {
                $mensaje = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
                $errores = [];
                $nombre = "";
                $descripcion = "";
            } else {
                $nombre = trim(htmlspecialchars($_POST['nombre']));
                $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                $logo = new File('logo', $tiposAceptados);
                $nombreLogo = trim(htmlspecialchars($_POST['nombre'])); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
                $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);

                $imagenAsociado = new Asociado($nombre, $logo->getFileName(), $descripcion);
                $asociadosRepository->save($imagenAsociado);

                // if ($queryBuilder->save($asociado)) {
                //     $descripcion = "";
                //     $mensaje = "Se ha guardado la asociación correctamente";
                // } else {
                //     $errores[] = "No se ha podido guardar la asociación en la base de datos";
                // }

                $mensaje = "Datos enviados"; // Todo correcto y se guardan los datos
            }
        } else {
            $mensaje = "Introduzca el código de seguridad.";
            $errores = [];
            $nombre = "";
            $descripcion = "";
        }
    } else {
        $errores = [];
        $nombre = "";
        $nombreLogo = "";
        $descripcion = "";
        $mensaje = "";
    }
    $queryBuilder = new QueryBuilder('asociados','Asociado');
    $asociados = $queryBuilder->findAll();

} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
}catch ( AppException $appException ){
    $errores[] = $appException->getMessage();
}

require_once(__DIR__ . '/views/asociados.view.php');
