<?php

namespace App\Entity;

use App\Repository\PlaylistMediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistMediaRepository::class)]
class PlaylistMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $addedAt = null;

    // #[ORM\ManyToOne(inversedBy: 'playlistMedia')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?playlist $playlist = null;

    // #[ORM\ManyToOne(inversedBy: 'playlistMedia')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?media $media = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): static
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    // public function getPlaylist(): ?playlist
    // {
    //     return $this->playlist;
    // }

    // public function setPlaylist(?playlist $playlist): static
    // {
    //     $this->playlist = $playlist;

    //     return $this;
    // }

    // public function getMedia(): ?media
    // {
    //     return $this->media;
    // }

    // public function setMedia(?media $media): static
    // {
    //     $this->media = $media;

    //     return $this;
    // }
}
