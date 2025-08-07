<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    public const STATUT_EN_ATTENTE = 'en_attente';
    public const STATUT_VALIDE = 'validé';
    public const STATUT_REFUSE = 'refusé';

    public const STATUTS_VALIDES = [
        self::STATUT_EN_ATTENTE,
        self::STATUT_VALIDE,
        self::STATUT_REFUSE,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    #[Assert\NotBlank(message: 'Le message ne peut pas être vide.')]
    #[Assert\Length(
        max: 1000,
        maxMessage: 'Le message doit contenir au maximum {{ limit }} caractères.'
    )]
    private ?string $contenu = null;

    #[ORM\Column]
    #[Assert\NotNull(message: 'La date d’envoi est obligatoire.')]
    private ?\DateTimeImmutable $dateEnvoi = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(choices: self::STATUTS_VALIDES, message: 'Le statut du message est invalide.')]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $auteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeImmutable
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeImmutable $dateEnvoi): static
    {
        $this->dateEnvoi = $dateEnvoi;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function getAuteur(): ?Utilisateur
    {
        return $this->auteur;
    }

    public function setAuteur(?Utilisateur $auteur): static
    {
        $this->auteur = $auteur;
        return $this;
    }

    #[Assert\Callback]
    public function validateDateEnvoi(ExecutionContextInterface $context, $payload): void
    {
        if ($this->dateEnvoi && $this->dateEnvoi > new \DateTimeImmutable()) {
            $context->buildViolation('La date d’envoi ne peut pas être dans le futur.')
                ->atPath('dateEnvoi')
                ->addViolation();
        }
    }

    #[Assert\Callback]
    public function validateStatut(ExecutionContextInterface $context, $payload): void
    {
        if (!in_array($this->statut, self::STATUTS_VALIDES, true)) {
            $context->buildViolation('Statut invalide.')
                ->atPath('statut')
                ->addViolation();
        }
    }
}
