<?php

namespace App\Controller;

use App\Entity\Producto;
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
