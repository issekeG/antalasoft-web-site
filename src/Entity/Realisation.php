<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Cocur\Slugify\Slugify;

#[ORM\Entity(repositoryClass: RealisationRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class Realisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $title = null;

    #[ORM\Column(length: 400)]
    private ?string $subTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 500)]
    private ?string $poster = null;
    #[Vich\UploadableField(mapping: 'realisationPoster', fileNameProperty: 'poster')]
    private ?File $posterFile = null;

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    public function setPosterFile(?File $posterFile): static
    {
        $this->posterFile = $posterFile;

        return $this;
    }

    /**
     * @var Collection<int, RealisationImage>
     */
    #[ORM\OneToMany(targetEntity: RealisationImage::class, mappedBy: 'realisation', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $realisationImages;

    #[ORM\Column(length: 500)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $realisationAt = null;

    #[ORM\ManyToOne(inversedBy: 'realisations')]
    private ?RealisationCategory $service = null;

    public function __construct()
    {
        $this->realisationImages = new ArrayCollection();
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

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function setSubTitle(string $subTitle): static
    {
        $this->subTitle = $subTitle;

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

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return Collection<int, RealisationImage>
     */
    public function getRealisationImages(): Collection
    {
        return $this->realisationImages;
    }

    public function addRealisationImage(RealisationImage $realisationImage): static
    {
        if (!$this->realisationImages->contains($realisationImage)) {
            $this->realisationImages->add($realisationImage);
            $realisationImage->setRealisation($this);
        }

        return $this;
    }

    public function removeRealisationImage(RealisationImage $realisationImage): static
    {
        if ($this->realisationImages->removeElement($realisationImage)) {
            // set the owning side to null (unless already changed)
            if ($realisationImage->getRealisation() === $this) {
                $realisationImage->setRealisation(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function generateSlug(): void
    {

        $slugify = new Slugify();
        $slug = $slugify->slugify($this->title);

        $dateTime = new \DateTimeImmutable();
        $formattedDate = $dateTime->format('Y-m-d_H-i-s');

        $this->slug = $slug . '-' . $formattedDate;

    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function realisationDate() :void
    {
        $this->realisationAt = new \DateTimeImmutable();
    }
    public function getRealisationAt(): ?\DateTimeImmutable
    {
        return $this->realisationAt;
    }

    public function setRealisationAt(\DateTimeImmutable $realisationAt): static
    {
        $this->realisationAt = $realisationAt;

        return $this;
    }

    public function getService(): ?RealisationCategory
    {
        return $this->service;
    }

    public function setService(?RealisationCategory $service): static
    {
        $this->service = $service;

        return $this;
    }
}
