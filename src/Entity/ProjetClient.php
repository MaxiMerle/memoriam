<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomClient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     */
    private $emailClient;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $dossier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjetClientCategorie", inversedBy="projet")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomDefunt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surnomDefunt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motFin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deviseDefunt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $momentDefunt1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $momentDefunt2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $momentDefunt3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passionDefunt1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passionDefunt2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passionDefunt3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $musiques;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProjetClientQualite", inversedBy="projetClient")
     * @ORM\JoinColumn(nullable=true)
     */
    private $qualite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuDefunt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualite1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualite2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualite3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailVendeurBerthelot;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validation;

    public function __construct()
    {
        $this->qualite = new ArrayCollection();
        $this->validation = false;
    }







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

    public function getSurnomDefunt(): ?string
    {
        return $this->surnomDefunt;
    }

    public function setSurnomDefunt(?string $surnomDefunt): self
    {
        $this->surnomDefunt = $surnomDefunt;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getMotFin(): ?string
    {
        return $this->motFin;
    }

    public function setMotFin(string $motFin): self
    {
        $this->motFin = $motFin;

        return $this;
    }

    public function getDeviseDefunt(): ?string
    {
        return $this->deviseDefunt;
    }

    public function setDeviseDefunt(?string $deviseDefunt): self
    {
        $this->deviseDefunt = $deviseDefunt;

        return $this;
    }

    public function getMomentDefunt1(): ?string
    {
        return $this->momentDefunt1;
    }

    public function setMomentDefunt1(string $momentDefunt1): self
    {
        $this->momentDefunt1 = $momentDefunt1;

        return $this;
    }

    public function getMomentDefunt2(): ?string
    {
        return $this->momentDefunt2;
    }

    public function setMomentDefunt2(string $momentDefunt2): self
    {
        $this->momentDefunt2 = $momentDefunt2;

        return $this;
    }

    public function getMomentDefunt3(): ?string
    {
        return $this->momentDefunt3;
    }

    public function setMomentDefunt3(string $momentDefunt3): self
    {
        $this->momentDefunt3 = $momentDefunt3;

        return $this;
    }

    public function getPassionDefunt1(): ?string
    {
        return $this->passionDefunt1;
    }

    public function setPassionDefunt1(string $passionDefunt1): self
    {
        $this->passionDefunt1 = $passionDefunt1;

        return $this;
    }

    public function getPassionDefunt2(): ?string
    {
        return $this->passionDefunt2;
    }

    public function setPassionDefunt2(string $passionDefunt2): self
    {
        $this->passionDefunt2 = $passionDefunt2;

        return $this;
    }

    public function getPassionDefunt3(): ?string
    {
        return $this->passionDefunt3;
    }

    public function setPassionDefunt3(string $passionDefunt3): self
    {
        $this->passionDefunt3 = $passionDefunt3;

        return $this;
    }

    public function getMusiques(): ?string
    {
        return $this->musiques;
    }

    public function setMusiques(string $musiques): self
    {
        $this->musiques = $musiques;

        return $this;
    }




    /**
     * @return Collection|ProjetClientQualite[]
     */
    public function getQualite(): Collection
    {
        return $this->qualite;
    }

    public function setQualite (ProjetClientQualite $qualite): self
    {
        if (!$this->qualite->contains($qualite)) {
            $this->qualite[] = $qualite;
        }

        return $this;
    }

    public function removeQualite(ProjetClientQualite $qualite): self
    {
        if ($this->qualite->contains($qualite)) {
            $this->qualite->removeElement($qualite);
        }

        return $this;
    }

    public function getLieuDefunt(): ?string
    {
        return $this->lieuDefunt;
    }

    public function setLieuDefunt(?string $lieuDefunt): self
    {
        $this->lieuDefunt = $lieuDefunt;

        return $this;
    }

    public function getQualite1(): ?string
    {
        return $this->qualite1;
    }

    public function setQualite1(?string $qualite1): self
    {
        $this->qualite1 = $qualite1;

        return $this;
    }

    public function getQualite2(): ?string
    {
        return $this->qualite2;
    }

    public function setQualite2(string $qualite2): self
    {
        $this->qualite2 = $qualite2;

        return $this;
    }

    public function getQualite3(): ?string
    {
        return $this->qualite3;
    }

    public function setQualite3(string $qualite3): self
    {
        $this->qualite3 = $qualite3;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getEmailVendeurBerthelot(): ?string
    {
        return $this->emailVendeurBerthelot;
    }

    public function setEmailVendeurBerthelot(?string $emailVendeurBerthelot): self
    {
        $this->emailVendeurBerthelot = $emailVendeurBerthelot;

        return $this;
    }

    public function getValidation(): ?int
    {
        return $this->validation;
    }

    public function setValidation(?int $validation): self
    {
        $this->validation = $validation;

        return $this;
    }
}
