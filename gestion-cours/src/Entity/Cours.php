<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CoursRepository;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nomCours;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string', length: 255)]
    private string $professeur;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateDebut;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateFin;

    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function getNomCours(): string { return $this->nomCours; }
    public function setNomCours(string $nomCours): self { $this->nomCours = $nomCours; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getProfesseur(): string { return $this->professeur; }
    public function setProfesseur(string $professeur): self { $this->professeur = $professeur; return $this; }
    public function getDateDebut(): \DateTimeInterface { return $this->dateDebut; }
    public function setDateDebut(\DateTimeInterface $dateDebut): self { $this->dateDebut = $dateDebut; return $this; }
    public function getDateFin(): \DateTimeInterface { return $this->dateFin; }
    public function setDateFin(\DateTimeInterface $dateFin): self { $this->dateFin = $dateFin; return $this; }
}
