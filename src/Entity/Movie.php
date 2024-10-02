<?php

namespace App\Entity;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie extends Media
{
}
