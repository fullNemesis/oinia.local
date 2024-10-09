<?php
    require_once __DIR__ ."/../src/utils/file.class.php";
    require_once __DIR__ ."/../src/exeptions/fileException.class.php";
    /* require_once __DIR__."/../src/entity/imagen.class.php"; */
    require_once __DIR__."/../src/entity/asociado.class.php";

    If ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            try {
                $nombre = trim(htmlspecialchars($_POST['nombre']));
                $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                $nombreLogo = trim(htmlspecialchars($_POST['nombre Logo'])); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
                $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);
                $mensaje = "Datos enviados";
            } catch (FileException $fileException) {
                $errores[] = $fileException->getMessage();
            }
        }else{
            $errores = [];
            $nombre ="";
            $nombreLogo ="";
            $descripcion="";
            $mensaje ="";
        }
        require_once(__DIR__ . '/views/asociados.view.php');
?>