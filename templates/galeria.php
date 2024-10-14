<?php
    require_once __DIR__ ."/../src/utils/file.class.php";
    require_once __DIR__ ."/../src/exceptions/fileException.class.php";
    require_once __DIR__."/../src/entity/imagen.class.php";
    require_once __DIR__."/../src/database/Connection.php";
    require_once __DIR__."/../src/database/QueryBuilder.php";

            try {
                $conexion = Connection::make();
                If ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
                $titulo = trim(htmlspecialchars($_POST['titulo']));
                $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
                $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS );

                $sql = "INSERT INTO imagenes (nombre, descripcion, categoria) VALUES (:nombre,:descripcion,:categoria)";
                $pdoStatement = $conexion->prepare($sql);
                $parametros = [':nombre'=>$imagen->getFileName(),
                ':descripcion'=>$descripcion,
                ':categoria'=>'1'];
                if ( $pdoStatement->execute($parametros)===false)
                $errores[] = "No se ha podido guardar la imagen en la base de datos";
                else {
                    $descripcion = "";
                    $mensaje = "Se ha guardado la imagen correctamente";
                }
                $queryBuilder = new QueryBuilder($conexion);
                $imagenes = $queryBuilder->findAll('imagenes','Imagen');
            }else{
                $errores = [];
                $titulo ="";
                $descripcion="";
                $mensaje ="";
            }
            $queryBuilder = new QueryBuilder($conexion);
            $imagenes = $queryBuilder->findAll('imagenes','Imagen');
            } catch (FileException $fileException) {
                $errores[] = $fileException->getMessage();
            }catch ( QueryException $queryException ){
                $errores[] = $fileException->getMessage();
            }
        require_once(__DIR__ . '/views/galeria.view.php');
?>