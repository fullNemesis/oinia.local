<?php
namespace oinia\app\repository;

use oinia\app\database\QueryBuilder;
use oinia\app\entity\Curso;
use oinia\app\entity\IEntity;

/**
 * @method array findBy(array $criteria)
 * @method array executeQuery(string $sql, array $parameters = [])
 * @method object|null find(int $id)
 * @method void save(IEntity $entity)
 * @method array findActivos()
 * @method array findByIdioma(int $idioma_id)
 * @method array findDisponibles()
 */
class CursoRepository extends QueryBuilder {
    public function __construct()
    {
        parent::__construct('cursos', Curso::class);
    }

    /**
     * Encuentra todos los cursos activos
     * @return Curso[]
     */
    public function findActivos(): array
    {
        return $this->findBy(['activo' => 1]);
    }

    /**
     * Encuentra todos los cursos activos de un idioma específico
     * @param int $idioma_id
     * @return Curso[]
     */
    public function findByIdioma(int $idioma_id): array
    {
        return $this->findBy([
            'idioma_id' => $idioma_id,
            'activo' => 1
        ]);
    }

    /**
     * Encuentra todos los cursos que tienen plazas disponibles
     * @return Curso[]
     */
    public function findDisponibles(): array {
        $sql = "SELECT c.* FROM cursos c 
                WHERE c.activo = true 
                AND c.plazas > (
                    SELECT COUNT(*) 
                    FROM inscripciones i 
                    WHERE i.curso_id = c.id 
                    AND i.estado != 'cancelado'
                )";
        return $this->executeQuery($sql);
    }
} 