<?php

namespace dwes\app\controllers;

use dwes\app\utils\File;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\AppException;
use dwes\app\entity\Asociado;
use dwes\app\database\Connection;
use dwes\app\database\QueryBuilder;
use dwes\app\repository\AsociadosRepository;
use  dwes\core\App;
use dwes\core\Response;
use dwes\core\helpers\FlashMessage;

class AsociadosController
{
    public function asociados()
    {
        $errores  = FlashMessage::get('errores', []);
        $mensaje  = FlashMessage::get('mensaje');
        $nombre  = FlashMessage::get('nombre');
        $descripcion  = FlashMessage::get('descripcion');

        Response::renderView(
            'asociados',
            'layout',
            compact ( 'errores','nombre','descripcion','mensaje')
        );
        
    }
    public function asociadosNuevo()
    {

        try {

            $conexion = App::getConnection();

            $asociadosRepository = App::getRepository(AsociadosRepository::class);

               /*  if (isset($_POST['captcha']) && ($_POST['captcha'] != "")) { */

                    $nombre = trim(htmlspecialchars($_POST['nombre']));
                    FlashMessage::set('nombre' , $nombre);
                    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                    FlashMessage::set('descripcion' , $descripcion);
                    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                    $logo = new File('logo', $tiposAceptados);
                    $nombreLogo = trim(htmlspecialchars($_POST['nombre']));
                    FlashMessage::set('nombre' , $nombreLogo); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
                    $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);
    
                    $imagenAsociado = new Asociado($nombre, $logo->getFileName(), $descripcion);
                    $asociadosRepository->save($imagenAsociado);
    
                    $mensaje = "Datos enviados";  // Todo correcto y se guardan los datos
                    FlashMessage::set('mensaje' , $mensaje);

                /* }else{
                    FlashMessage::set('mensaje', "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.");
                    FlashMessage::set('errores', []);
                    FlashMessage::set('nombre', "");
                    FlashMessage::set('descripcion', "");
                } */

            $asociados = App::getRepository(AsociadosRepository::class)->findAll();
            
        } catch (FileException $fileException) {
            FlashMessage::set('errores' , [$fileException->getMessage()]);
        } catch (AppException $appException) {

            FlashMessage::set('errores' , [$appException->getMessage()]);
        }

        App::get('router')->redirect('asociados');

    }
}
