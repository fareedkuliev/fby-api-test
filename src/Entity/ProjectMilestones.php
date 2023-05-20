<?php

namespace App\Entity;

use App\Repository\ProjectMilestonesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectMilestonesRepository::class)]
class ProjectMilestones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'projectMilestones')]
    private ?Project $project = null;

    #[ORM\Column(length: 55)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $milestone_deadline = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMilestoneDeadline(): ?\DateTimeInterface
    {
        return $this->milestone_deadline;
    }

    public function setMilestoneDeadline(\DateTimeInterface $milestone_deadline): self
    {
        $this->milestone_deadline = $milestone_deadline;

        return $this;
    }
}
