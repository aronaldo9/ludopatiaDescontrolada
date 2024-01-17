<?php

namespace App\Entity;

use App\Repository\SorteoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?\DateTimeInterface $fechaIni = null;

    #[ORM\Column]
    private ?int $precio_papeleta = null;

    #[ORM\Column]
    private ?int $cantidad_papeletas = null;

    #[ORM\ManyToMany(targetEntity: Ticket::class, mappedBy: 'sorteo')]
    private Collection $tickets;

    #[ORM\OneToMany(mappedBy: 'sorteo', targetEntity: Apuesta::class)]
    private Collection $apuestas;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaFin = null;

    #[ORM\Column(nullable: true)]
    private ?int $numPremiado = null;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->apuestas = new ArrayCollection();
    }

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

    public function getFechaIni(): ?\DateTimeInterface
    {
        return $this->fechaIni;
    }

    public function setFechaIni(\DateTimeInterface $fechaIni): static
    {
        $this->fechaIni = $fechaIni;

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

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->addSorteo($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            $ticket->removeSorteo($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Apuesta>
     */
    public function getApuestas(): Collection
    {
        return $this->apuestas;
    }

    public function addApuesta(Apuesta $apuesta): static
    {
        if (!$this->apuestas->contains($apuesta)) {
            $this->apuestas->add($apuesta);
            $apuesta->setSorteo($this);
        }

        return $this;
    }

    public function removeApuesta(Apuesta $apuesta): static
    {
        if ($this->apuestas->removeElement($apuesta)) {
            // set the owning side to null (unless already changed)
            if ($apuesta->getSorteo() === $this) {
                $apuesta->setSorteo(null);
            }
        }

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): static
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getNumPremiado(): ?int
    {
        return $this->numPremiado;
    }

    public function setNumPremiado(?int $numPremiado): static
    {
        $this->numPremiado = $numPremiado;

        return $this;
    }
}
