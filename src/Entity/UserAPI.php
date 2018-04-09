<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserApi
 *
 * @ORM\Table(name="user_api")
 * @ORM\Entity
 */
class UserAPI implements \Symfony\Component\Security\Core\User\UserInterface, \Serializable {

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=false, unique=true)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;
    
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false) 
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    
    function __construct() {
        
    }

    function getUserName() {
        return $this->userName;
    }

    function getPassword() {
        return $this->password;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function getRole() {
        return $this->role;
    }

    function getEmail() {
        return $this->email;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function __toString() {
        return $this->userName;
    }

    public function setPassword(string $password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 13));
    }

    public function getSalt() {
        return null;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return array($this->role);
    }

    public function serialize() {
        return serialize(array(
            $this->userName,
            $this->password
        ));
    }

    public function unserialize($serialized) {
        list (
                $this->userName,
                $this->password
                ) = unserialize($serialized);
    }

}
