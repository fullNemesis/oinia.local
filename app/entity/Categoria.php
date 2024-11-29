<?php
namespace oinia\app\entity;

use oinia\app\entity\IEntity;

class Categoria implements IEntity{

    private $id, $nombre, $numImagenes;
    
    public function __construct($nombre="",$numImagenes=0) {
        $this->id = null;
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
        
    }

    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getNumImagenes() {
        return $this->numImagenes;
    }
    
    public function setNombre($nombre): Categoria {
        $this->nombre = $nombre;
        return $this;
    }
    public function setNumImagenes($numImagenes): Categoria {
        $this->numImagenes = $numImagenes;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'numImagenes' => $this->getNumImagenes(),
        ];
    }
}
