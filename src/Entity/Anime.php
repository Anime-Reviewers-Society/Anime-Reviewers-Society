<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimeRepository")
 */
class Anime
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $translatedTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $originalTitle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $matureAudience;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $resume;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="animes")
     */
    private $tag;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Target", inversedBy="animes")
     */
    private $target;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="anime")
     */
    private $review;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opening;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->review = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTranslatedTitle(): ?string
    {
        return $this->translatedTitle;
    }

    public function setTranslatedTitle(?string $translatedTitle): self
    {
        $this->translatedTitle = $translatedTitle;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getMatureAudience(): ?bool
    {
        return $this->matureAudience;
    }

    public function setMatureAudience(bool $matureAudience): self
    {
        $this->matureAudience = $matureAudience;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tag->contains($tag)) {
            $this->tag->removeElement($tag);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->originalTitle;
        return $this->image;
    }

    public function getTarget(): ?Target
    {
        return $this->target;
    }

    public function setTarget(?Target $target): self
    {
        $this->target = $target;

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReview(): Collection
    {
        return $this->review;
    }

    public function addReview(Review $review): self
    {
        if (!$this->review->contains($review)) {
            $this->review[] = $review;
            $review->setAnime($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->review->contains($review)) {
            $this->review->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getAnime() === $this) {
                $review->setAnime(null);
            }
        }

        return $this;
    }

    public function getOpening(): ?string
    {
        return $this->opening;
    }

    public function setOpening(?string $opening): self
    {
        $this->opening = $opening;

        return $this;
    }
}
