<?php

namespace App\Entity;

use App\Repository\SorteoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SorteoRepository::class)]
class Sorteo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column]
    private ?int $precio_papeleta = null;

    #[ORM\Column]
    private ?int $cantidad_papeletas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getPrecioPapeleta(): ?int
    {
        return $this->precio_papeleta;
    }

    public function setPrecioPapeleta(int $precio_papeleta): static
    {
        $this->precio_papeleta = $precio_papeleta;

        return $this;
    }

    public function getCantidadPapeletas(): ?int
    {
        return $this->cantidad_papeletas;
    }

    public function setCantidadPapeletas(int $cantidad_papeletas): static
    {
        $this->cantidad_papeletas = $cantidad_papeletas;

        return $this;
    }
}
