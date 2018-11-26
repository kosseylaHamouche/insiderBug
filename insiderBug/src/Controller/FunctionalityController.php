<?php

namespace App\Controller;

use App\Entity\Functionality;
use App\Form\FunctionalityType;
use App\Repository\FunctionalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/functionality")
 */
class FunctionalityController extends AbstractController
{
    /**
     * @Route("/", name="functionality_index", methods="GET")
     */
    public function index(FunctionalityRepository $functionalityRepository): Response
    {
        return $this->render('functionality/index.html.twig', ['functionalities' => $functionalityRepository->findAll()]);
    }

    /**
     * @Route("/new", name="functionality_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $functionality = new Functionality();
        $form = $this->createForm(FunctionalityType::class, $functionality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($functionality);
            $em->flush();

            return $this->redirectToRoute('functionality_index');
        }

        return $this->render('functionality/new.html.twig', [
            'functionality' => $functionality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="functionality_show", methods="GET")
     */
    public function show(Functionality $functionality): Response
    {
        return $this->render('functionality/show.html.twig', ['functionality' => $functionality]);
    }

    /**
     * @Route("/{id}/edit", name="functionality_edit", methods="GET|POST")
     */
    public function edit(Request $request, Functionality $functionality): Response
    {
        $form = $this->createForm(FunctionalityType::class, $functionality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('functionality_index', ['id' => $functionality->getId()]);
        }

        return $this->render('functionality/edit.html.twig', [
            'functionality' => $functionality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="functionality_delete", methods="DELETE")
     */
    public function delete(Request $request, Functionality $functionality): Response
    {
        if ($this->isCsrfTokenValid('delete'.$functionality->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($functionality);
            $em->flush();
        }

        return $this->redirectToRoute('functionality_index');
    }
}
