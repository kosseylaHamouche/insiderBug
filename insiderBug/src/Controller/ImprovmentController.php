<?php

namespace App\Controller;

use App\Entity\Improvment;
use App\Form\ImprovmentType;
use App\Repository\ImprovmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/improvment")
 */
class ImprovmentController extends AbstractController
{
    /**
     * @Route("/", name="improvment_index", methods="GET")
     */
    public function index(ImprovmentRepository $improvmentRepository): Response
    {
        return $this->render('improvment/index.html.twig', ['improvments' => $improvmentRepository->findAll()]);
    }

    /**
     * @Route("/new", name="improvment_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $improvment = new Improvment();
        $form = $this->createForm(ImprovmentType::class, $improvment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($improvment);
            $em->flush();

            return $this->redirectToRoute('improvment_index');
        }

        return $this->render('improvment/new.html.twig', [
            'improvment' => $improvment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="improvment_show", methods="GET")
     */
    public function show(Improvment $improvment): Response
    {
        return $this->render('improvment/show.html.twig', ['improvment' => $improvment]);
    }

    /**
     * @Route("/{id}/edit", name="improvment_edit", methods="GET|POST")
     */
    public function edit(Request $request, Improvment $improvment): Response
    {
        $form = $this->createForm(ImprovmentType::class, $improvment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('improvment_index', ['id' => $improvment->getId()]);
        }

        return $this->render('improvment/edit.html.twig', [
            'improvment' => $improvment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="improvment_delete", methods="DELETE")
     */
    public function delete(Request $request, Improvment $improvment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$improvment->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($improvment);
            $em->flush();
        }

        return $this->redirectToRoute('improvment_index');
    }
}
