<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity
 */
class Test {

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=1024, nullable=false)
     */
    private $style;

    function __construct() {
        
    }

    function getCode() {
        return $this->code;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function getStyle() {
        return $this->style;
    }

    function setStyle($style) {
        $this->style = $style;
    }

}
