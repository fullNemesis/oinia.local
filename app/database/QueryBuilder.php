<?php

namespace oinia\app\database;

use oinia\app\exceptions\QueryException;
use oinia\app\exceptions\NotFoundException;
use oinia\app\entity\IEntity;
use oinia\app\entity\Asociado;
use PDO;
use PDOException;
use  oinia\core\App;
use Exception;

/**
 * @method array findBy(array $criteria)
 * @method array executeQuery(string $sql, array $parameters = [])
 * @method object|null find(int $id)
 * @method void save(IEntity $entity)
 */
class QueryBuilder
{
    /**
     * @var PDO
     */
    protected $connection;
    private $table;
    private $classEntity;

    public function __construct(string $table, string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    public function findAll(): array 
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->executeQuery($sql);
    }

    public function find(int $id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id = :id', $this->table);
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $id]);
        
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
        $result = $statement->fetch();
        
        if (!$result) {
            throw new NotFoundException(
                sprintf('No se ha encontrado ningún registro en %s con id %d', $this->table, $id)
            );
        }
        
        return $result;
    }

    public function findBy(array $criteria): array
    {
        $sql = sprintf('SELECT * FROM %s WHERE ', $this->table);
        $where = [];
        $parameters = [];

        foreach ($criteria as $field => $value) {
            if (is_array($value)) {
                $placeholders = [];
                foreach ($value as $i => $val) {
                    $key = $field . $i;
                    $placeholders[] = ':' . $key;
                    $parameters[$key] = $val;
                }
                $where[] = $field . ' IN (' . implode(', ', $placeholders) . ')';
            } else {
                $where[] = $field . ' = :' . $field;
                $parameters[$field] = $value;
            }
        }

        $sql .= implode(' AND ', $where);
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);

        return $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    public function findOneBy(array $criteria)
    {
        $results = $this->findBy($criteria);
        return !empty($results) ? $results[0] : null;
    }

    public function executeQuery(string $sql, array $parameters = []): array
    {
        try {
            error_log("Ejecutando consulta: " . $sql);
            error_log("Parámetros: " . print_r($parameters, true));
            
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
            
            // Si la consulta es un SELECT (comienza con SELECT)
            if (stripos(trim($sql), 'SELECT') === 0) {
                return $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
            }
            
            // Para INSERT, UPDATE, DELETE retornamos un array vacío
            return [];
        } catch (Exception $exception) {
            error_log("Error en executeQuery: " . $exception->getMessage());
            throw new QueryException("Error al ejecutar la consulta: " . $exception->getMessage());
        }
    }

    public function save($entity): void 
    {
        try {
            error_log("Iniciando guardado de entidad: " . get_class($entity));
            $data = $entity->toArray();
            error_log("Datos a guardar: " . print_r($data, true));
            
            $id = $data['id'] ?? null;
            unset($data['id']);

            if ($id === null) {
                error_log("Realizando INSERT");
                $this->insert($data);
            } else {
                error_log("Realizando UPDATE para ID: " . $id);
                $this->update($id, $data);
            }
        } catch (Exception $e) {
            error_log("Error en save: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            throw $e;
        }
    }

    private function insert(array $data): void 
    {
        try {
            $fields = array_keys($data);
            $placeholders = array_map(fn($field) => ":$field", $fields);
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', $fields),
                implode(', ', $placeholders)
            );
            
            $statement = $this->connection->prepare($sql);
            $parameters = array_combine($placeholders, array_values($data));
            $statement->execute($parameters);
        } catch (Exception $exception) {
            error_log("Error en insert: " . $exception->getMessage());
            throw new QueryException("Error al insertar en la base de datos: " . $exception->getMessage());
        }
    }

    private function update(int $id, array $data): void 
    {
        try {
            $fields = array_keys($data);
            $set = implode(', ', array_map(fn($field) => "$field = :$field", $fields));
            $sql = sprintf(
                'UPDATE %s SET %s WHERE id = :id',
                $this->table,
                $set
            );
            
            $statement = $this->connection->prepare($sql);
            $parameters = array_combine(
                array_map(fn($field) => ":$field", $fields),
                array_values($data)
            );
            $parameters[':id'] = $id;
            $statement->execute($parameters);
        } catch (Exception $exception) {
            error_log("Error en update: " . $exception->getMessage());
            throw new QueryException("Error al actualizar en la base de datos: " . $exception->getMessage());
        }
    }

    protected function hydrate($data) 
    {
        $entity = new $this->classEntity();
        foreach ((array)$data as $property => $value) {
            $method = 'set' . str_replace('_', '', ucwords($property, '_'));
            if (method_exists($entity, $method)) {
                $entity->$method($value);
            }
        }
        return $entity;
    }

    /**
     * Encuentra registros activos
     * @return array
     */
    public function findActivos(): array
    {
        return $this->findBy(['activo' => 1]);
    }

    /**
     * Encuentra registros por usuario
     * @param int $usuario_id
     * @return array
     */
    public function findByUsuario(int $usuario_id): array
    {
        return $this->findBy(['usuario_id' => $usuario_id]);
    }

    /**
     * Verifica si hay una inscripción activa
     * @param int $usuario_id
     * @return bool
     */
    public function tieneInscripcionActiva(int $usuario_id): bool
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE usuario_id = :usuario_id AND estado = 'activa'";
        $result = $this->executeQuery($sql, ['usuario_id' => $usuario_id]);
        return isset($result[0]->total) && $result[0]->total > 0;
    }

    /**
     * Obtiene inscripciones activas de un curso
     * @param int $curso_id
     * @return array
     */
    public function getInscripcionesActivasCurso(int $curso_id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE curso_id = :curso_id AND estado = 'activa'";
        return $this->executeQuery($sql, ['curso_id' => $curso_id]);
    }
}