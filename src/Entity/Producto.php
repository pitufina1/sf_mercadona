<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PedidoProductoCantidad", mappedBy="producto")
     */
    private $pedidoproductocantidades;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
        $this->pedidoproductocantidades = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

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
            $pedidoproductocantidade->setProducto($this);
        }

        return $this;
    }

    public function removePedidoproductocantidade(PedidoProductoCantidad $pedidoproductocantidade): self
    {
        if ($this->pedidoproductocantidades->contains($pedidoproductocantidade)) {
            $this->pedidoproductocantidades->removeElement($pedidoproductocantidade);
            // set the owning side to null (unless already changed)
            if ($pedidoproductocantidade->getProducto() === $this) {
                $pedidoproductocantidade->setProducto(null);
            }
        }

        return $this;
    }
}
