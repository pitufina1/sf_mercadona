<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PedidoProductoCantidad", mappedBy="pedido")
     */
    private $pedidoproductocantidades;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
        $this->pedidoproductocantidades = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|PedidoProductoCantidad[]
     */
    public function getPedidoproductocantidades(): Collection
    {
        return $this->pedidoproductocantidades;
    }

    public function addPedidoproductocantidade(PedidoProductoCantidad $pedidoproductocantidade): self
    {
        if (!$this->pedidoproductocantidades->contains($pedidoproductocantidade)) {
            $this->pedidoproductocantidades[] = $pedidoproductocantidade;
            $pedidoproductocantidade->setPedido($this);
        }

        return $this;
    }

    public function removePedidoproductocantidade(PedidoProductoCantidad $pedidoproductocantidade): self
    {
        if ($this->pedidoproductocantidades->contains($pedidoproductocantidade)) {
            $this->pedidoproductocantidades->removeElement($pedidoproductocantidade);
            // set the owning side to null (unless already changed)
            if ($pedidoproductocantidade->getPedido() === $this) {
                $pedidoproductocantidade->setPedido(null);
            }
        }

        return $this;
    }
}
