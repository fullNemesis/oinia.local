<?php
namespace oinia\app\repository;

use oinia\app\database\QueryBuilder;
use oinia\app\entity\Idioma;

/**
 * @method array findBy(array $criteria)
 * @method array executeQuery(string $sql, array $parameters = [])
 * @method object|null find(int $id)
 * @method void save(IEntity $entity)
 * @method array findActivos()
 */
class IdiomaRepository extends QueryBuilder {
    public function __construct()
    {
        parent::__construct('idiomas', Idioma::class);
    }

    /**
     * Encuentra todos los idiomas activos
     * @return Idioma[]
     */
    public function findActivos(): array
    {
        $sql = "SELECT * FROM idiomas WHERE activo = 1";
        return $this->executeQuery($sql);
    }
} 