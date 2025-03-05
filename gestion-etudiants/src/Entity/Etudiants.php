<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $nom;

    #[ORM\Column(type: 'string', length: 100)]
    private string $prenom;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $dateNaissance;

    #[ORM\Column(type: 'string', length: 50)]
    private string $classe;

    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }
    public function getPrenom(): string { return $this->prenom; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function getDateNaissance(): \DateTimeInterface { return $this->dateNaissance; }
    public function setDateNaissance(\DateTimeInterface $dateNaissance): self { $this->dateNaissance = $dateNaissance; return $this; }
    public function getClasse(): string { return $this->classe; }
    public function setClasse(string $classe): self { $this->classe = $classe; return $this; }
}
