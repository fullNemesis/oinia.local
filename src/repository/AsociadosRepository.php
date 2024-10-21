<?php
require_once __DIR__ ."/../database/QueryBuilder.class.php";

class AsociadosRepository extends QueryBuilder 
{
/**
* @param string $table
* @param string $classEntity
*/
    public function __construct(string $table='asociados', string $classEntity='Asociado')
    {
    parent::__construct($table, $classEntity);
    }
}
