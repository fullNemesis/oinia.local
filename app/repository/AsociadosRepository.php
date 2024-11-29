<?php
namespace oinia\app\repository;

use oinia\app\database\QueryBuilder;
use oinia\app\entity\Asociado;

class AsociadosRepository extends QueryBuilder 
{
/**
* @param string $table
* @param string $classEntity
*/
    public function __construct(string $table='asociados',string $classEntity = Asociado::class)
    {
    parent::__construct($table, $classEntity);
    }
}
