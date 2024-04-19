<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_commentaire_evenement", columns={"idE"}), @ORM\Index(name="fk_commentaire_utilisateur", columns={"idU"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="idC", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idc;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datecreation = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="idE", type="integer", nullable=false)
     */
    private $ide;

    /**
     * @var int
     *
     * @ORM\Column(name="idU", type="integer", nullable=false)
     */
    private $idu;


}
