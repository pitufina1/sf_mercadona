<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/tienda")
 */
class TiendaController extends Controller
{

    /**
     * @Route("/", name="tienda_home")
     */
    public function cargarTiendaHome()
    {
        return $this->render('tienda/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
