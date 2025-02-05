<?php
namespace oinia\app\entity;

use oinia\app\entity\IEntity;

class Idioma implements IEntity {
    private $id;
    private $nombre;
    private $codigo;
    private $activo;

    public function __construct($nombre = "", $codigo = "", $activo = true) {
        $this->id = null;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->activo = $activo;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getCodigo(): string {
        return $this->codigo;
    }

    public function isActivo(): bool {
        return $this->activo;
    }

    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    public function setCodigo(string $codigo): self {
        $this->codigo = $codigo;
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
            'codigo' => $this->getCodigo(),
            'activo' => $this->isActivo()
        ];
    }
} 