<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FiliereRepository::class)]
class Filiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?int $cycle = null;

    #[ORM\OneToMany(mappedBy: 'filiere', targetEntity: StudentBook::class)]
    private Collection $studentBooks;

    #[ORM\OneToMany(mappedBy: 'filiere', targetEntity: Orientation::class)]
    private Collection $orientations;

    public function __construct()
    {
        $this->studentBooks = new ArrayCollection();
        $this->orientations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        $this->setSlug((new Slugify())->slugify($title));

        return $this;
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function setCycle(): ?int
    {
        return $this->cycle;
    }

    public function getCycle(?int $cycle): static
    {
        $this->cycle = $cycle;

        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, StudentBook>
     */
    public function getStudentBooks(): Collection
    {
        return $this->studentBooks;
    }

    public function addStudentBook(StudentBook $studentBook): static
    {
        if (!$this->studentBooks->contains($studentBook)) {
            $this->studentBooks->add($studentBook);
            $studentBook->setFiliere($this);
        }

        return $this;
    }

    public function removeStudentBook(StudentBook $studentBook): static
    {
        if ($this->studentBooks->removeElement($studentBook)) {
            // set the owning side to null (unless already changed)
            if ($studentBook->getFiliere() === $this) {
                $studentBook->setFiliere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Orientation>
     */
    public function getOrientations(): Collection
    {
        return $this->orientations;
    }

    public function addOrientation(Orientation $orientation): static
    {
        if (!$this->orientations->contains($orientation)) {
            $this->orientations->add($orientation);
            $orientation->setFiliere($this);
        }

        return $this;
    }

    public function removeOrientation(Orientation $orientation): static
    {
        if ($this->orientations->removeElement($orientation)) {
            // set the owning side to null (unless already changed)
            if ($orientation->getFiliere() === $this) {
                $orientation->setFiliere(null);
            }
        }

        return $this;
    }
}
