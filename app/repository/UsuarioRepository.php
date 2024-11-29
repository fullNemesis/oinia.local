<?php
namespace oinia\app\repository;

use oinia\app\database\QueryBuilder;
use oinia\app\entity\Usuario;

class UsuarioRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'usuarios', string $classEntity = Usuario::class)
    {
        parent::__construct($table, $classEntity);
    }
}
