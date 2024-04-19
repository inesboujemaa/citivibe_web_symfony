<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Transport
 *
 * @ORM\Table(name="transport", indexes={@ORM\Index(name="idAvis", columns={"idAvis"})})
 * @ORM\Entity
 */
class Transport
{
    /**
     * @var int
     *
     * @ORM\Column(name="idT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idt;

        public function getIdt(): ?int
        {
            return $this->idt;
        }

        public function setIdt(int $idt): self
        {
            $this->idt = $idt;
            return $this;
        }
    /**
     * @var string
     *
     * @ORM\Column(name="typeT", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le type de transport ne peut pas être vide.")
     */
    private $typet;


        public function getTypet(): ?string
        {
            return $this->typet;
        }

        public function setTypet(string $typet): self
        {
            $this->typet = $typet;
            return $this;
        }

    /**
     * @var string
     *
     * @ORM\Column(name="station_depart", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="La station de départ ne peut pas être vide.")
     */
    private $stationDepart;


        public function getStationDepart(): ?string
        {
            return $this->stationDepart;
        }

        public function setStationDepart(string $stationDepart): self
        {
            $this->stationDepart = $stationDepart;
            return $this;
        }

    /**
     * @var string
     *
     * @ORM\Column(name="station_arrive", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="La station d'arrivée ne peut pas être vide.")
     */
    private $stationArrive;


        public function getStationArrive(): ?string
        {
            return $this->stationArrive;
        }
        public function setStationArrive(string $stationArrive): self
            {
                $this->stationArrive = $stationArrive;
                return $this;
            }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duree", type="time", nullable=false)
     * @Assert\NotBlank(message="La durée ne peut pas être vide.")
     */
    private $duree;


    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTime $duree): self
    {
        $this->duree = $duree;
        return $this;
    }


    /**
     * @var float
     *
     * @ORM\Column(name="tarif", type="decimal", precision=10, scale=2, nullable=false)
     * @Assert\NotBlank(message="Le tarif ne peut pas être vide.")
     * @Assert\Type(type="numeric", message="Le tarif doit être un nombre.")
     */
    private $tarif;

        public function getTarif(): ?float
        {
            return $this->tarif;
        }

        public function setTarif(float $tarif): self
        {
            $this->tarif = $tarif;
            return $this;
        }

    /**
     * @var \Avistransport
     *
     * @ORM\ManyToOne(targetEntity="Avistransport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAvis", referencedColumnName="idAvis")
     * })
     */

    // /**
    //  * @var \Avistransport
    //  *
    //  * @ORM\ManyToOne(targetEntity="Avistransport")
    //  * @ORM\JoinColumns({
    //  *   @ORM\JoinColumn(name="idAvis", referencedColumnName="idAvis")
    //  * })
    //  */
    // private $idavis;

    // public function getIdavis(): ?Avistransport
    // {
    //     return $this->idavis;
    // }

    // public function setIdavis(?Avistransport $idavis): self
    // {
    //     $this->idavis = $idavis;
    //     return $this;
    // }


}
