<?php
require_once __DIR__ . "/../../src/utils/file.class.php";
require_once __DIR__ . "/../../src/exceptions/fileException.class.php";
require_once __DIR__ . "/../../src/entity/imagen.class.php";
require_once __DIR__ . "/../../src/database/Connection.class.php";
require_once __DIR__ . "/../../src/database/QueryBuilder.class.php";
require_once __DIR__ . "/../../src/repository/CategoriaRepository.php";
require_once __DIR__ . "/../../src/repository/ImagenesRepository.php";

$errores = [];
$titulo = "";
$descripcion = "";
$mensaje = "";

try {
   
    $conexion = App::getConnection();

    $categoriaRepository = new CategoriaRepository();
    $imagenesRepository = new ImagenesRepository();

    $imagenes = $imagenesRepository->findAll();
    $categorias = $categoriaRepository->findAll();

}  catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
} 
require_once __DIR__ . '/../views/galeria.view.php';
