<?php

namespace oinia\app\controllers;

use oinia\core\Response;
use  oinia\core\App;
use oinia\app\repository\ImagenesRepository;
use  oinia\app\entity\Imagen;
use oinia\app\exceptions\CategoriaException;
use oinia\app\utils\File;
use oinia\app\exceptions\FileException;
use oinia\app\exceptions\QueryException;
use oinia\app\exceptions\AppException;
use oinia\app\repository\CategoriaRepository;
use oinia\core\helpers\FlashMessage;

class GaleriaController
{
    /**
     * @throws QueryException
     */
    public function galeria()
    {
        $titulo  = FlashMessage::get('titulo');
        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $descripcion = FlashMessage::get('descripcion');
        $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');

        try {

            $conexion = App::getConnection();

            $categoriaRepository = App::getRepository(CategoriaRepository::class);
            $imagenesRepository = App::getRepository(ImagenesRepository::class);

            $imagenes = App::getRepository(ImagenesRepository::class)->findAll();
            $categorias = App::getRepository(CategoriaRepository::class)->findAll();
        } catch (QueryException $queryException) {
            FlashMessage::set('errores' , [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores' , [$appException->getMessage()]);
        }

        Response::renderView(
            'galeria',
            'layout',
            compact('errores', 'titulo', 'descripcion', 'mensaje', 'imagenes', 'categorias', 'imagenesRepository','categoriaRepository','categoriaSeleccionada')
        );
    }
    /**
     * @throws QueryException
     */
    public function galeriaNueva()
    {
        try {

            $imagenesRepository = App::getRepository(ImagenesRepository::class);

            $titulo = trim(htmlspecialchars($_POST['titulo']));
            FlashMessage::set('titulo' ,$titulo);
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('descripcion' , $descripcion);
            $categoria = trim(htmlspecialchars($_POST['categoria']));
            FlashMessage::set('categoriaSeleccionada' , $descripcion);

            if (empty($categoria))
                throw new CategoriaException;
                FlashMessage::set('categoriaSeleccionada' , $categoria); // utilizamos categoriaSeleccionaa
                // porque ya hay una variable llamada categoría en la vista.

            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
            $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

            $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
            $imagenesRepository->guarda($imagenGaleria);
            /* App::get('logger')->add("Se ha guardado una imagen: " . $imagenGaleria->getNombre()); */

            $mensaje = "Se ha guardado una imagen: " . $imagenGaleria->getNombre();

            App::get('logger')->add($mensaje);
            FlashMessage::set('mensaje' , $mensaje);
            

        } catch (FileException $fileException) {
            FlashMessage::set('errores' , [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores' , [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores' , [$appException->getMessage()]);
        } catch (CategoriaException) {
            FlashMessage::set('errores' , "No se ha seleccionado una categoría válida");
        }

        App::get('router')->redirect('galeria');
    }

    public function show($id)
    {
        $imagenesRepository = App::getRepository(ImagenesRepository::class);
        $imagen = $imagenesRepository->find($id);

        Response::renderView(
            'imagen-show',
            'layout',
            compact('imagen', 'imagenesRepository')
        );
    }
}
