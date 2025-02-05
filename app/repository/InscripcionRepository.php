<?php
namespace oinia\app\repository;

use oinia\app\database\QueryBuilder;
use oinia\app\entity\Inscripcion;
use oinia\app\entity\Curso;
use oinia\app\entity\IEntity;
use PDO;

/**
 * @method array findBy(array $criteria)
 * @method array executeQuery(string $sql, array $parameters = [])
 * @method object|null find(int $id)
 * @method void save(IEntity $entity)
 * @method array findByUsuario(int $usuario_id)
 * @method array findByCurso(int $curso_id)
 * @method bool tieneInscripcionActiva(int $usuario_id)
 * @method array getInscripcionesActivasCurso(int $curso_id)
 */
class InscripcionRepository extends QueryBuilder {
    public function __construct()
    {
        parent::__construct('inscripciones', Inscripcion::class);
    }

    /**
     * Encuentra todas las inscripciones de un usuario
     * @param int $usuario_id
     * @return Inscripcion[]
     */
    public function findByUsuario(int $usuario_id): array
    {
        return $this->findBy(['usuario_id' => $usuario_id]);
    }

    /**
     * Encuentra todas las inscripciones de un curso
     * @param int $curso_id
     * @return Inscripcion[]
     */
    public function findByCurso(int $curso_id): array {
        return $this->findBy(['curso_id' => $curso_id]);
    }

    /**
     * Verifica si un usuario tiene una inscripción activa
     * @param int $usuario_id
     * @return bool
     */
    public function tieneInscripcionActiva(int $usuario_id): bool
    {
        $inscripciones = $this->findBy([
            'usuario_id' => $usuario_id,
            'estado' => 'activa'
        ]);
        return count($inscripciones) > 0;
    }

    /**
     * Obtiene las inscripciones activas de un curso
     * @param int $curso_id
     * @return array
     */
    public function getInscripcionesActivasCurso(int $curso_id): array
    {
        return $this->findBy([
            'curso_id' => $curso_id,
            'estado' => 'activa'
        ]);
    }

    /**
     * Cuenta el número de resultados para una consulta SQL
     * @param string $sql
     * @param array $parameters
     * @return int
     */
    private function count(string $sql, array $parameters = []): int {
        $stmt = $this->executeQuery($sql, $parameters);
        if (isset($stmt[0]->total)) {
            return (int)$stmt[0]->total;
        }
        return 0;
    }
} 