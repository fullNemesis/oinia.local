<?php
    require_once __DIR__ ."/../src/utils/file.class.php";
    require_once __DIR__ ."/../src/exeptions/fileException.class.php";
    require_once __DIR__."/../src/entity/asociado.class.php";

    If ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            try {
                if ( isset($_POST['captcha']) && ($_POST['captcha']!="")){
                    session_start();
                    if( $_SESSION['captchaGenerado'] != $_POST['captcha'] ){
                        $mensaje = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
                        $errores=[]; $nombre=""; $descripcion="";
                    } else { 
                        $nombre = trim(htmlspecialchars($_POST['nombre']));
                        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                        $nombreLogo = trim(htmlspecialchars($_POST['nombre Logo'])); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
                        $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);
                        $mensaje = "Datos enviados"; // Todo correcto y se guardan los datos
                    } 
                }else {
                    $mensaje = "Introduzca el código de seguridad.";
                    $errores=[]; $nombre=""; $descripcion="";
                }
                
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