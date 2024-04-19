<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avistransport
 *
 * @ORM\Table(name="avistransport", indexes={@ORM\Index(name="idTransport", columns={"idTransport"})})
 * @ORM\Entity
 */
class Avistransport
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAvis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idavis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avis", type="text", length=65535, nullable=true)
     */
    private $avis;

    /**
     * @var float|null
     *
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true)
     */
    private $note;

/**
 * @var \App\Entity\Transport
 *
 * @ORM\ManyToOne(targetEntity="App\Entity\Transport")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="idTransport", referencedColumnName="idT")
 * })
 */
private $idt;


    public function getIdavis(): ?int
    {
        return $this->idavis;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIdt(): ?Transport
    {
        return $this->idt;
    }

    public function setIdt(?Transport $idt): self
    {
        $this->idt = $idt;

        return $this;
    }

    public function getIdavisAsString(): string
    {
        return (string) $this->getIdavis();
    }

    public function getIdtAsString(): string
    {
        return $this->getIdt()->getNom();
    }
}
