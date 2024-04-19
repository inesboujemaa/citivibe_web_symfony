<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Preferences
 *
 * @ORM\Table(name="preferences", indexes={@ORM\Index(name="fk_idu", columns={"idu"})})
 * @ORM\Entity
 */
class Preferences
{
    /**
     * @var int
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idp;

    /**
     * @var int
     *
     * @ORM\Column(name="idu", type="integer", nullable=false)
     */
    private $idu;

    /**
     * @var string
     *
     * @ORM\Column(name="types", type="string", length=50, nullable=false)
     */
    private $types;


}
