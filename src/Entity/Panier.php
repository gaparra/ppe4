<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity
 */
class Panier {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn (name="nom_produit", referencedColumnName="id")
     * })
     */
    private $nom_produit;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", nullable=false)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn (name="id_user", referencedColumnName="user_name")
     * })
     */
    private $id_user;

    function __construct() {
        
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

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getNom_produit() {
        return $this->nom_produit;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getId_user() {
        return $this->id_user;
    }

    function setNom_produit($nom_produit) {
        $this->nom_produit = $nom_produit;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

}
