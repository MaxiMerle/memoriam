<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageFilesRepository")
 * @ORM\Table(name="image_files")
 */
class ImageFiles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomFichier;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjetClient", inversedBy="projetFiles")
     */
    private $projet;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNomFichier(): ?string
    {
        return $this->nomFichier;
    }
    public function setNomFichier(?string $nomFichier): self
    {
        $this->nomFichier = $nomFichier;
        return $this;
    }
    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }
    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;
        return $this;
    }
    public function getProjet(): ?ProjetClient
    {
        return $this->projet;
    }
    public function setProjet(?ProjetClient $projet): self
    {
        $this->projet = $projet;
        return $this;
    }
}