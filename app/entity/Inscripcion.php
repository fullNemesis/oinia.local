<?php
namespace oinia\app\entity;

use oinia\app\entity\IEntity;
use DateTime;
use oinia\core\App;
use oinia\app\repository\CursoRepository;

class Inscripcion implements IEntity {
    private $id;
    private $usuario_id;
    private $curso_id;
    private $estado;
    private $fecha_inscripcion;
    private $curso;

    public function __construct() {
        $this->fecha_inscripcion = new \DateTime();
        $this->estado = 'activa';  // Valor por defecto
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setUsuarioId(int $usuario_id): self {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function getUsuarioId(): ?int {
        return $this->usuario_id;
    }

    public function setCursoId(int $curso_id): self {
        $this->curso_id = $curso_id;
        return $this;
    }

    public function getCursoId(): ?int {
        return $this->curso_id;
    }

    public function setEstado(string $estado): self {
        $this->estado = $estado;
        return $this;
    }

    public function getEstado(): ?string {
        return $this->estado;
    }

    public function setFechaInscripcion(\DateTime $fecha): self {
        $this->fecha_inscripcion = $fecha;
        return $this;
    }

    public function getFechaInscripcion(): ?\DateTime {
        return $this->fecha_inscripcion;
    }

    public function setCurso(?Curso $curso): self {
        $this->curso = $curso;
        if ($curso) {
            $this->curso_id = $curso->getId();
        }
        return $this;
    }

    public function getCurso(): ?Curso {
        return $this->curso;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'usuario_id' => $this->getUsuarioId(),
            'curso_id' => $this->getCursoId(),
            'estado' => $this->getEstado(),
            'fecha_inscripcion' => $this->getFechaInscripcion()->format('Y-m-d H:i:s')
        ];
    }
} 