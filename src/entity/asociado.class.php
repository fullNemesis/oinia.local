<?php 
require_once __DIR__."/IEntity.php";

class Asociado implements IEntity {
    /**
    * @var string
    */
    private $id;
    private $nombre;
    private $logo;
    private $descripcion;

    const RUTA_LOGOS_ASOCIADOS = 'public/images/asociados/';

    public function __construct($nombre="", $logo="", $descripcion="") {
        $this->id = null;
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getLogo() {
        return $this->logo;
    }
    
    public function setNombre($nombre): Asociado {
        $this->nombre = $nombre;
        return $this;
    }

    public function setLogo($logo): Asociado {
        $this->logo = $logo;
        return $this;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion): Asociado {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function __toString() {
        return $this->descripcion;
    }

    public function getUrl() {
        return self::RUTA_LOGOS_ASOCIADOS . $this->getLogo();
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'logo' => $this->getLogo(),
        ];
    }
}
?>
