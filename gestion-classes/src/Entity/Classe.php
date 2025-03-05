<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClasseRepository;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nomClasse;

    #[ORM\Column(type: 'string', length: 50)]
    private string $niveau;

    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function getNomClasse(): string { return $this->nomClasse; }
    public function setNomClasse(string $nomClasse): self { $this->nomClasse = $nomClasse; return $this; }
    public function getNiveau(): string { return $this->niveau; }
    public function setNiveau(string $niveau): self { $this->niveau = $niveau; return $this; }
}
