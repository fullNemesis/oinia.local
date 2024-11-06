<?php
use dwes\app\utils\File;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\AppException;
use dwes\app\entity\Asociado;
use dwes\app\database\Connection;
use dwes\app\database\QueryBuilder;
use dwes\app\repository\AsociadosRepository;
use  dwes\core\App;

try {

    $conexion = App::getConnection();
    
    $asociadosRepository = App::getRepository(AsociadosRepository::class);

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
    $asociados = App::getRepository(AsociadosRepository::class)->findAll();

} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
}catch ( AppException $appException ){
    $errores[] = $appException->getMessage();
}

require_once(__DIR__ . '/../views/asociados.view.php');
