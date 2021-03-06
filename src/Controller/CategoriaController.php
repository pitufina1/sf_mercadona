<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Tienda;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * @Route("/categoria")
 */
class CategoriaController extends Controller
{
    /**
     * @Route("/", name="categoria_index", methods="GET")
     */
    public function index(CategoriaRepository $categoriaRepository): Response
    {
        return $this->render('categoria/index.html.twig', ['categorias' => $categoriaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="categoria_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $categorium = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorium);
            $em->flush();

            return $this->redirectToRoute('categoria_index');
        }

        return $this->render('categoria/new.html.twig', [
            'categorium' => $categorium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categoria_show", methods="GET")
     */
    public function show(Categoria $categorium): Response
    {
        return $this->render('categoria/show.html.twig', ['categorium' => $categorium]);
    }

    /**
     * @Route("/{id}/edit", name="categoria_edit", methods="GET|POST")
     */
    public function edit(Request $request, Categoria $categorium): Response
    {
        $form = $this->createForm(CategoriaType::class, $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categoria_edit', ['id' => $categorium->getId()]);
        }

        return $this->render('categoria/edit.html.twig', [
            'categorium' => $categorium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categoria_delete", methods="DELETE")
     */
    public function delete(Request $request, Categoria $categorium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorium->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorium);
            $em->flush();
        }

        return $this->redirectToRoute('categoria_index');
    }

     /**
     * @Route("/{id}/json", name="categoria_json", requirements={"id"="\d+"})
     */
    public function jsonCategoria($id, Request $request)
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $repo = $this->getDoctrine()->getRepository(Categoria::class);
        $categoria = $repo->find($id);
        $jsonCategoria = $serializer->serialize($categoria, 'json');        

        $respuesta = new Response($jsonCategoria);

        return $respuesta;
    }

}
