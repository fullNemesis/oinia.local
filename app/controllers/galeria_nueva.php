<?php
use dwes\app\utils\File;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\CategoriaException;
use dwes\app\exceptions\AppException;
use dwes\app\entity\Imagen;
use dwes\app\src\database\Connection;
use dwes\app\database\QueryBuilder;
use dwes\app\repository\ImagenesRepository;
use  dwes\core\App;

try {

    $conexion = App::getConnection();

    $imagenesRepository = new ImagenesRepository();

    $titulo = trim(htmlspecialchars($_POST['titulo']));
    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    $categoria = trim(htmlspecialchars($_POST['categoria']));
    if (empty($categoria))
        throw new CategoriaException;

    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
    $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
    $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

    $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
    $imagenesRepository->guarda($imagenGaleria);
    App::get('logger')->add("Se ha guardado una imagen: ".$imagenGaleria->getNombre());
    
    $mensaje = "Se ha guardado la imagen correctamente";

} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
} catch (CategoriaException) {
    $errores[] = "No se ha seleccionado una categoría válida";
}

App::get('router')->redirect('galeria');
