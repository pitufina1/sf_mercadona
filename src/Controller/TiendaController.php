<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Entity\Categoria;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\ProductoType;

/**
 * @Route("/tienda")
 */
class TiendaController extends Controller
{


 	/**
     * @Route("/", name="tienda_home")
     */
    public function listadoProductos()
    {
        $repo = $this->getDoctrine()->getRepository(Producto::class);
        $productos = $repo->findAll();
            return $this->render ('tienda/index.html.twig', [
            'productos' =>  $productos,
        ]);
    }

     /**
     * @Route("/detalle/{id}", name="tienda_show", requirements={"id"="\d+"})
     */
    /*public function detalleProducto($id)
    {
        $repo = $this->getDoctrine()->getRepository(Producto::class);
        
        $producto = $repo->find($id);
                   
            return $this->render ('tienda/detalle.html.twig', [
            'producto' =>  $producto,
        ]);
    }*/


    /**
     * @Route("/categoria", name="tienda_categoria")
     */
    public function listadoCategorias()
    {
        $repo = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repo->findAll();
            return $this->render ('tienda/categoria.html.twig', [
            'categorias' =>  $categorias,
            'productos' =>  $categorias[0]-> getProductos(),
        ]);
    }

    
    
}
