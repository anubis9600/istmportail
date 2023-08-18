<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiliereRepository::class)]
class Filiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'filiere', targetEntity: StudentBook::class)]
    private Collection $studentBooks;

    public function __construct()
    {
        $this->studentBooks = new ArrayCollection();
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
}
