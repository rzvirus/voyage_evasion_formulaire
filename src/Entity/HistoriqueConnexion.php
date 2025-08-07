<?php

namespace App\Entity;

use App\Repository\HistoriqueConnexionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: HistoriqueConnexionRepository::class)]
class HistoriqueConnexion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // La date de connexion (ne peut être nulle si en cours)
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateConnexion = null;

    // Date de déconnexion (peut être nulle si en cours de session)
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateDeconnexion = null;

    // Rôle du moment (optionnel) - Par ex. admin ou autre rôle
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le rôle ne peut pas dépasser {{ limit }} caractères.'
    )]
    private ?string $roleAuMoment = null;

    // Utilisateur concerné - obligatoire pour un historique valide
    #[ORM\ManyToOne(inversedBy: 'historiqueConnexions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateConnexion(): ?\DateTimeImmutable
    {
        return $this->dateConnexion;
    }

    public function setDateConnexion(?\DateTimeImmutable $dateConnexion): static
    {
        $this->dateConnexion = $dateConnexion;
        return $this;
    }

    public function getDateDeconnexion(): ?\DateTimeImmutable
    {
        return $this->dateDeconnexion;
    }

    public function setDateDeconnexion(?\DateTimeImmutable $dateDeconnexion): static
    {
        $this->dateDeconnexion = $dateDeconnexion;
        return $this;
    }

    public function getRoleAuMoment(): ?string
    {
        return $this->roleAuMoment;
    }

    public function setRoleAuMoment(?string $roleAuMoment): static
    {
        $this->roleAuMoment = $roleAuMoment;
        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    // Validation personnalisée : si une des dates est fournie, la deuxième ne peut pas précéder la connexion.
    #[Assert\Callback]
    public function validateDates(ExecutionContextInterface $context, $payload): void
    {
        if ($this->dateConnexion && $this->dateDeconnexion) {
            if ($this->dateDeconnexion < $this->dateConnexion) {
                $context->buildViolation('La date de déconnexion ne peut pas être antérieure à la date de connexion.')
                    ->atPath('dateDeconnexion')
                    ->addViolation();
            }
        }
    }
}
