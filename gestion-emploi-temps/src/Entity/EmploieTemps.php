<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmploiTempsRepository;

#[ORM\Entity(repositoryClass: EmploiTempsRepository::class)]
class EmploiTemps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    private string $jour;

    #[ORM\Column(type: 'time')]
    private \DateTimeInterface $heureDebut;

    #[ORM\Column(type: 'time')]
    private \DateTimeInterface $heureFin;

    #[ORM\Column(type: 'string', length: 255)]
    private string $matiere;

    #[ORM\Column(type: 'string', length: 255)]
    private string $professeur;

    #[ORM\Column(type: 'string', length: 50)]
    private string $salle;

    #[ORM\Column(type: 'string', length: 50)]
    private string $classe;

    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function getJour(): string { return $this->jour; }
    public function setJour(string $jour): self { $this->jour = $jour; return $this; }
    public function getHeureDebut(): \DateTimeInterface { return $this->heureDebut; }
    public function setHeureDebut(\DateTimeInterface $heureDebut): self { $this->heureDebut = $heureDebut; return $this; }
    public function getHeureFin(): \DateTimeInterface { return $this->heureFin; }
    public function setHeureFin(\DateTimeInterface $heureFin): self { $this->heureFin = $heureFin; return $this; }
    public function getMatiere(): string { return $this->matiere; }
    public function setMatiere(string $matiere): self { $this->matiere = $matiere; return $this; }
    public function getProfesseur(): string { return $this->professeur; }
    public function setProfesseur(string $professeur): self { $this->professeur = $professeur; return $this; }
    public function getSalle(): string { return $this->salle; }
    public function setSalle(string $salle): self { $this->salle = $salle; return $this; }
    public function getClasse(): string { return $this->classe; }
    public function setClasse(string $classe): self { $this->classe = $classe; return $this; }
}
