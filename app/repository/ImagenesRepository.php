<?php
namespace oinia\app\repository;

use oinia\app\repository\CategoriaRepository;
use  oinia\app\entity\Imagen;
use oinia\app\QueryException;
use oinia\app\NotFoundException;
use oinia\app\entity\Categoria;
use oinia\app\database\QueryBuilder;
use  oinia\core\App;

class ImagenesRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'imagenes', string $classEntity = Imagen::class)
    {
        parent::__construct($table, $classEntity);
    }
    /**
     * @param ImagenGaleria $imagenGaleria
     * @return Categoria
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getCategoria(Imagen $imagenGaleria): Categoria
    {
        $categoriaRepository = App::getRepository(CategoriaRepository::class);
        return $categoriaRepository->find($imagenGaleria->getCategoria());
    }
    public function guarda(Imagen $imagenGaleria)
    {
        $fnGuardaImagen = function () use ($imagenGaleria) { // Creamos una función anónima que se llama como callable
            $categoria = $this->getCategoria($imagenGaleria);
            $categoriaRepository = App::getRepository(CategoriaRepository::class);
            $categoriaRepository->nuevaImagen($categoria);
            $this->save($imagenGaleria);
        };
        $this->executeTransaction($fnGuardaImagen); // Se pasa un callable
    }
}
