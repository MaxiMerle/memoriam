<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetClientQualiteRepository")
 */
class ProjetClientQualite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProjetClient", mappedBy="qualite")
     */
    private $projetClient;

    public function __construct()
    {
        $this->projetClient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|ProjetClient[]
     */
    public function getProjetClient(): Collection
    {
        return $this->projetClient;
    }

    public function addProjetClient(ProjetClient $projetClient): self
    {
        if (!$this->projetClient->contains($projetClient)) {
            $this->projetClient[] = $projetClient;
            $projetClient->setQualite($this);
        }

        return $this;
    }

    public function removeProjetClient(ProjetClient $projetClient): self
    {
        if ($this->projetClient->contains($projetClient)) {
            $this->projetClient->removeElement($projetClient);
            $projetClient->removeQualite($this);
        }

        return $this;
    }
}
