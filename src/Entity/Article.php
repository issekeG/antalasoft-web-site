<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Cocur\Slugify\Slugify;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 350)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $firstDescription = null;

    #[ORM\Column(length: 400)]
    private ?string $subTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 350)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'articleImage', fileNameProperty: 'image')]
    private ?File $imageFile;

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): static
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    #[ORM\Column(length: 500)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $postedAt = null;

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

    public function getFirstDescription(): ?string
    {
        return $this->firstDescription;
    }

    public function setFirstDescription(string $firstDescription): static
    {
        $this->firstDescription = $firstDescription;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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
    public function articleDate() :void
    {
     $this->postedAt = new \DateTimeImmutable();
    }

    public function getPostedAt(): ?\DateTimeImmutable
    {
        return $this->postedAt;
    }

    public function setPostedAt(\DateTimeImmutable $postedAt): static
    {
        $this->postedAt = $postedAt;

        return $this;
    }
}
