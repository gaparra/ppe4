<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="produits")
 * @ORM\Entity
 */
class Produits {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", nullable=false)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="text2", type="string", length=255, nullable=false)
     */
    private $text2;

    /**
     * @var Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn (name="nom_categorie", referencedColumnName="nom")
     * })
     */
    private $nom_categorie;

    function __construct() {
        
    }

    function getNomCategorie() {
        return $this->nom_categorie;
    }

    function setNomCategorie(Categorie $nom_categorie) {
        $this->nom_categorie = $nom_categorie;
    }

    function getStock() {
        return $this->stock;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function getId() {
        return $this->id;
    }

    function getPhoto() {
        return $this->photo;
    }

    function getPrix() {
        return $this->prix;
    }

    function getNom() {
        return $this->nom;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function getText2() {
        return $this->text2;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPhoto($photo) {
        $this->photo = $photo;
    }

    function setText2($text2) {
        $this->text2 = $text2;
    }

}
