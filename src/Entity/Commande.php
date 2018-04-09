<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity
 */
class Commande {

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
     * @ORM\Column(name="num_commande", type="string", length=255, nullable=false)
     */
    public $num_commande;

    /**
     * @var Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn (name="id_produit", referencedColumnName="id")
     * })
     */
    public $id_produit;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn (name="id_user", referencedColumnName="user_name")
     * })
     */
    public $id_user;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var bool
     *
     * @ORM\Column(name="est_valid", type="boolean", nullable=false)
     */
    public $est_valid;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", nullable=false)
     */
    private $prix;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getNum_commande() {
        return $this->num_commande;
    }

    function getId_produit() {
        return $this->id_produit;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getDate() {
        return $this->date;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getEst_valid() {
        return $this->est_valid;
    }

    function getPrix() {
        return $this->prix;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNum_commande($num_commande) {
        $this->num_commande = $num_commande;
    }

    function setId_produit(Produits $id_produit) {
        $this->id_produit = $id_produit;
    }

    function setId_user(User $id_user) {
        $this->id_user = $id_user;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setEst_valid($est_valid) {
        $this->est_valid = $est_valid;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

}
