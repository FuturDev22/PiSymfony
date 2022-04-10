<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Categorieevt;
use App\Form\CategorieevtType;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieevtRepository;


class CategorieevtController extends AbstractController
{
    /**
     * @Route("/categorieevt", name="app_categorieevt")
     */
    public function index(): Response
    {
        return $this->render('categorieevt/index.html.twig', [
            'controller_name' => 'CategorieevtController',
        ]);
    }
    /**
     * @Route("/listCategories", name="listCategories")
     */
    public function affiche()
    {
        $cat= $this->getDoctrine()->getRepository(Categorieevt::class)->findAll();
        return $this->render("categorieevt/list.html.twig",array("tabcat"=>$cat));
    }
    /**
     * @Route("/deleteCat/{idCategorie}", name="suppCat")
     */
    public function delete($idCategorie)
    {
        $cat= $this->getDoctrine()->getRepository(Categorieevt::class)->find($idCategorie);
        $em = $this->getDoctrine()->getManager();
        $em->remove($cat);
        $em->flush();
        return $this->redirectToRoute("listCategories");
    }
   /**
     * @Route("listCategories/addCat", name="addCat")
     */
    public function add(Request $request)
    {
        $cat= new Categorieevt();
        $form= $this->createForm(CategorieevtType::class,$cat);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute("listCategories");
        }
        return $this->render("categorieevt/add.html.twig",array("formCat"=>$form->createView()));
    }
   /**
     * @Route("/updateCat/{idCategorie}", name="updateCat")
     */
    public function update(Request $request,CategorieevtRepository $repository,$idCategorie)
    {
        //$classroom= $this->getDoctrine()->getRepository(Classroom::class)->find($id)
        $cat= $repository->find($idCategorie);
        $form= $this->createForm(CategorieevtType::class,$cat);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listCategories");
        }
        return $this->render("categorieevt/update.html.twig",array("categorieevt"=>$cat,"formcat"=>$form->createView()));
    }
}
