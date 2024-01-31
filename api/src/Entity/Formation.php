<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\FormationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups'=>['Formation:collection:read']]
        ),
        new Get(
            normalizationContext: ['groups'=>['Formation:detail:read']]
        ),
        new Post(
            normalizationContext: ['groups'=>['Formation:detail:read']],
            denormalizationContext: ['groups'=>['Formation:post']]
        ),
        new Patch(
            normalizationContext: ['groups'=>['Formation:detail:read']],
            denormalizationContext: ['groups'=>['Formation:patch']]
        ),
        new Delete()
    ]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'campus' => 'partial',
    'niveau'=>'exact'
])]
#[UniqueEntity('id')]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column]
    #[Groups(['Formation:detail:read', 'Formation:collection:read','Formation:post'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Formation:detail:read', 'Formation:collection:read','Formation:post','Formation:patch'])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['Formation:detail:read','Formation:post','Formation:patch'])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Formation:detail:read','Formation:post','Formation:patch'])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    #[Assert\Choice(choices: ['1 an', '2 ans', '3 ans'])]
    private ?string $duree = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Formation:detail:read', 'Formation:collection:read','Formation:post','Formation:patch'])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    #[Assert\Choice(choices: ['BAC', 'BAC+2', 'BAC+3', 'BAC+5'])]
    private ?string $niveau = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Formation:detail:read','Formation:post','Formation:patch'])]
    #[Assert\NotNull()]
    private ?string $stage = null;

    #[ORM\Column]
    #[Groups(['Formation:detail:read','Formation:post','Formation:patch'])]
    #[Assert\Choice(choices:[" en alternance","sous statut scolaire"],multiple: true)]
    private array $formation = [];

    #[ORM\Column]
    #[Groups(['Formation:detail:read','Formation:collection:read','Formation:post','Formation:patch'])]
    #[Assert\Choice(choices:["LYON","MARSEILLE","TOULOUSE","MONTREUIL"],multiple: true)]
    private array $campus = [];

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(string $stage): static
    {
        $this->stage = $stage;

        return $this;
    }

    public function getFormation(): array
    {
        return $this->formation;
    }

    public function setFormation(array $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getCampus(): array
    {
        return $this->campus;
    }

    public function setCampus(array $campus): static
    {
        $this->campus = $campus;

        return $this;
    }
}
