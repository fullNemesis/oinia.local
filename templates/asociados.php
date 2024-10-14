<?php
require_once __DIR__ . "/../src/utils/file.class.php";
require_once __DIR__ . "/../src/exceptions/fileException.class.php";
require_once __DIR__ . "/../src/entity/asociado.class.php";
require_once __DIR__."/../src/database/Connection.php";
require_once __DIR__."/../src/database/QueryBuilder.php";

try {
    $conexion = Connection::make();
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

                /* Arreglar la parte de la conexión */
                $sql = "INSERT INTO asociados (nombre, logo, descripcion) VALUES (:nombre,:logo,:descripcion)";
                $pdoStatement = $conexion->prepare($sql);
                $parametros = [
                    ':nombre' => $nombre,
                    ':logo' => $logo->getFileName(),
                    ':descripcion' => $descripcion
                ];
                if ($pdoStatement->execute($parametros) === false)
                    $errores[] = "No se ha podido guardar la imagen en la base de datos";
                else {
                    $descripcion = "";
                    $mensaje = "Se ha guardado la imagen correctamente";
                }

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
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
}
require_once(__DIR__ . '/views/asociados.view.php');
