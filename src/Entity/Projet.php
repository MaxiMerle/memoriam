<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 * * @Vich\Uploadable
 */
class Projet
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
    private $dossier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomDefunt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomDefunt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateNaissance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateMort;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="projet", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjetFiles", mappedBy="projet")
     */
    private $projetFile;

    public function __construct()
    {
        $this->projetFile = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomDefunt(): ?string
    {
        return $this->NomDefunt;
    }

    public function setNomDefunt(string $NomDefunt): self
    {
        $this->NomDefunt = $NomDefunt;

        return $this;
    }

    public function getPrenomDefunt(): ?string
    {
        return $this->PrenomDefunt;
    }

    public function setPrenomDefunt(string $PrenomDefunt): self
    {
        $this->PrenomDefunt = $PrenomDefunt;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): self
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getDateMort(): ?\DateTimeInterface
    {
        return $this->DateMort;
    }

    public function setDateMort(\DateTimeInterface $DateMort): self
    {
        $this->DateMort = $DateMort;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @return Collection|ProjetFiles[]
     */
    public function getProjetFile(): Collection
    {
        return $this->projetFile;
    }

    public function addProjetFile(ProjetFiles $projetFile): self
    {
        if (!$this->projetFile->contains($projetFile)) {
            $this->projetFile[] = $projetFile;
            $projetFile->setProjet($this);
        }

        return $this;
    }

    public function removeProjetFile(ProjetFiles $projetFile): self
    {
        if ($this->projetFile->contains($projetFile)) {
            $this->projetFile->removeElement($projetFile);
            // set the owning side to null (unless already changed)
            if ($projetFile->getProjet() === $this) {
                $projetFile->setProjet(null);
            }
        }

        return $this;
    }

}
