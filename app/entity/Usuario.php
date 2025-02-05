<?php 
namespace oinia\app\entity;

use oinia\app\entity\IEntity;

class Usuario implements IEntity {
    /**
    * @var string
    */
    private $id;
    private $username;
    private $password;
    private $role;


    public function __construct($username="", $password="",  $role="") {
        $this->id = null;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId():?int {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setUsername($username): Usuario {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password): Usuario {
        $this->password = $password;
        return $this;
    }

    public function getRole(): ?string {
        return $this->role ?? null;
    }

    public function setRole($role): Usuario {
        $this->role = $role;
        return $this;
    }

    public function __toString(): string {
        return $this->getUsername();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'role' => $this->getRole(),
        ];
    }

    public function hasRole(string $role): bool {
        if (!isset($this->role)) {
            return false;
        }
        return $this->role === $role;
    }
}
?>
