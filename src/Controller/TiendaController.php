<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Entity\Categoria;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
    public function detalleProducto($id)
    {
        $repo = $this->getDoctrine()->getRepository(Producto::class);
        
        $producto = $repo->find($id);
                   
            return $this->render ('tienda/detalle.html.twig', [
            'producto' =>  $producto,
        ]);
    }


    /**
     * @Route("/", name="tienda_categoria")
     */
    public function listadoCategorias()
    {
        $repo = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repo->findAll();
            return $this->render ('tienda/index.html.twig', [
            'categorias' =>  $categorias,
        ]);
    }

	/**
     * @Route("/jsonlist", name="tienda_jsonlist")
     */
    public function jsonClientes()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $repo->findAll();
        $jsonClientes = $serializer->serialize($clientes, 'json');        

        $respuesta = new Response($jsonClientes);

        return $respuesta;
    }
}
