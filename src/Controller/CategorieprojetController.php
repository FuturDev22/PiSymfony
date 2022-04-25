<?php

namespace App\Controller;

use App\Entity\Categorieprojet;
use App\Form\CategorieprojetType;
use App\Repository\CategorieprojetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorieprojet")
 */
class CategorieprojetController extends AbstractController
{
    /**
     * @Route("/", name="app_categorieprojet_index", methods={"GET"})
     */
    public function index(CategorieprojetRepository $categorieprojetRepository): Response
    {
        return $this->render('categorieprojet/index.html.twig', [
            'categorieprojets' => $categorieprojetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_categorieprojet_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CategorieprojetRepository $categorieprojetRepository): Response
    {
        $categorieprojet = new Categorieprojet();
        $form = $this->createForm(CategorieprojetType::class, $categorieprojet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieprojetRepository->add($categorieprojet);
            return $this->redirectToRoute('app_categorieprojet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorieprojet/new.html.twig', [
            'categorieprojet' => $categorieprojet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_categorieprojet_show", methods={"GET"})
     */
    public function show(Categorieprojet $categorieprojet): Response
    {
        return $this->render('categorieprojet/show.html.twig', [
            'categorieprojet' => $categorieprojet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_categorieprojet_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categorieprojet $categorieprojet, CategorieprojetRepository $categorieprojetRepository): Response
    {
        $form = $this->createForm(CategorieprojetType::class, $categorieprojet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieprojetRepository->add($categorieprojet);
            return $this->redirectToRoute('app_categorieprojet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorieprojet/edit.html.twig', [
            'categorieprojet' => $categorieprojet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_categorieprojet_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorieprojet $categorieprojet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieprojet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorieprojet);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_categorieprojet_index');
    }
}
