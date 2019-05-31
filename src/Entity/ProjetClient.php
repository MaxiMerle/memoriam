<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetClientRepository")
 */
class ProjetClient
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nomClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dossier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjetClientCategorie", inversedBy="projet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomDefunt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomDefunt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DateNaissanceDefunt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DateMortDefunt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DescriptionDefunt;







    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->emailClient;
    }

    public function setEmailClient(string $emailClient): self
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    public function getDossier(): ?string
    {
        return $this->dossier;
    }

    public function setDossier(string $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getCategorie(): ?ProjetClientCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?ProjetClientCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNomDefunt(): ?string
    {
        return $this->nomDefunt;
    }

    public function setNomDefunt(string $nomDefunt): self
    {
        $this->nomDefunt = $nomDefunt;

        return $this;
    }

    public function getPrenomDefunt(): ?string
    {
        return $this->prenomDefunt;
    }

    public function setPrenomDefunt(string $prenomDefunt): self
    {
        $this->prenomDefunt = $prenomDefunt;

        return $this;
    }

    public function getDateNaissanceDefunt(): ?string
    {
        return $this->DateNaissanceDefunt;
    }

    public function setDateNaissanceDefunt(string $DateNaissanceDefunt): self
    {
        $this->DateNaissanceDefunt = $DateNaissanceDefunt;

        return $this;
    }

    public function getDateMortDefunt(): ?string
    {
        return $this->DateMortDefunt;
    }

    public function setDateMortDefunt(string $DateMortDefunt): self
    {
        $this->DateMortDefunt = $DateMortDefunt;

        return $this;
    }

    public function getDescriptionDefunt(): ?string
    {
        return $this->DescriptionDefunt;
    }

    public function setDescriptionDefunt(?string $DescriptionDefunt): self
    {
        $this->DescriptionDefunt = $DescriptionDefunt;

        return $this;
    }
}
