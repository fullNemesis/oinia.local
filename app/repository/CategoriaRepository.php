<?php
namespace dwes\app\repository;

use dwes\app\database\QueryBuilder;
use dwes\app\entity\Categoria;


class CategoriaRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'categorias', string $classEntity = Categoria::class)
    {
        parent::__construct($table, $classEntity);
    }
    public function nuevaImagen(Categoria $categoria)
    {
        $categoria->setNumImagenes($categoria->getNumImagenes() + 1);
        $this->update($categoria);
    }
}
