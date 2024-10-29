<?php

use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\AppException;
use dwes\app\repository\CategoriaRepository;
use dwes\app\repository\ImagenesRepository;
use  dwes\core\App;

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
