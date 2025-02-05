<?php
namespace oinia\app\entity;

use oinia\app\entity\IEntity;
use DateTime;

class Curso implements IEntity {
    private $id;
    private $nombre;
    private $idioma_id;
    private $descripcion;
    private $nivel;
    private $fecha_inicio;
    private $fecha_fin;
    private $plazas;
    private $precio;
    private $activo;
    private $created_at;

    public function __construct() {
        $this->id = null;
        $this->activo = true;
        $this->created_at = new DateTime();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getIdiomaId(): int {
        return $this->idioma_id;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getNivel(): string {
        return $this->nivel;
    }

    public function getFechaInicio(): string {
        return $this->fecha_inicio;
    }

    public function getFechaFin(): string {
        return $this->fecha_fin;
    }

    public function getPlazas(): int {
        return $this->plazas;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function isActivo(): bool {
        return $this->activo;
    }

    public function getCreatedAt(): DateTime {
        return $this->created_at;
    }

    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    public function setIdiomaId(int $idioma_id): self {
        $this->idioma_id = $idioma_id;
        return $this;
    }

    public function setDescripcion(string $descripcion): self {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setNivel(string $nivel): self {
        $this->nivel = $nivel;
        return $this;
    }

    public function setFechaInicio(DateTime $fecha_inicio): self {
        $this->fecha_inicio = $fecha_inicio;
        return $this;
    }

    public function setFechaFin(DateTime $fecha_fin): self {
        $this->fecha_fin = $fecha_fin;
        return $this;
    }

    public function setPlazas(int $plazas): self {
        $this->plazas = $plazas;
        return $this;
    }

    public function setPrecio(float $precio): self {
        $this->precio = $precio;
        return $this;
    }

    public function setActivo(bool $activo): self {
        $this->activo = $activo;
        return $this;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'idioma_id' => $this->getIdiomaId(),
            'descripcion' => $this->getDescripcion(),
            'nivel' => $this->getNivel(),
            'fecha_inicio' => $this->getFechaInicio()->format('Y-m-d'),
            'fecha_fin' => $this->getFechaFin()->format('Y-m-d'),
            'plazas' => $this->getPlazas(),
            'precio' => $this->getPrecio(),
            'activo' => $this->isActivo(),
            'created_at' => $this->getCreatedAt()->format('Y-m-d H:i:s')
        ];
    }
} 