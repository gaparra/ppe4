<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie {

    /**
     * @ORM\Id
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;
    
      public function __toString(){
        return $this->nom;
}

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

}
