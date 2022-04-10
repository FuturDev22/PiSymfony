<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="app_evenement")
     */
    public function index(): Response
    {
        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }
    /**
     * @Route("/listEvenement", name="listEvenement")
     */
    public function affiche()
    {
        $evts= $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render("evenement/list.html.twig",array("tabevt"=>$evts));
    }
    /**
     * @Route("/listEv", name="listEv")
     */
    public function afficheFront()
    {
        $evts= $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render("evenement/frontList.html.twig",array("tabevt"=>$evts));
    }
    /**
     * @Route("/Event", name="Event")
     */
    public function afficheFrontD()
    {
        $evts= $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        
        return $this->render("evenement/FrontDetails.html.twig",array("tabevt"=>$evts));
    }
    
    /**
     * @Route("listEvenement/ajouter", name="ajouter")
     */
    public function ajouter(Request $request)
    {
        $event= new Evenement();
        $form= $this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute("listEvenement");
        }
        return $this->render("evenement/ajouter.html.twig",array("formEvt"=>$form->createView()));
    }
     /**
     * @Route("/listEvenement/{idEvt}", name="EventDetails")
     */
    public function afficheDetails()
    {
        $evts= $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render("evenement/details.html.twig",array("tabevt"=>$evts));
    }

     /**
     * @Route("/listEvenement/{idEvt}", name="showE")
     */
    public function show(int $idEvt): Response
    {
        $product = $this->getDoctrine()->getRepository(Evenement::class)->find($idEvt);

         return $this->render('evenement/details.html.twig', ['tabevt' => $product]);
    }    


    /**
     * @Route("/deleteEvt/{idEvt}", name="suppEvt")
     */
    public function delete($idEvt)
    {
        $evt= $this->getDoctrine()->getRepository(Evenement::class)->find($idEvt);
        $em = $this->getDoctrine()->getManager();
        $em->remove($evt);
        $em->flush();
        return $this->redirectToRoute("listEvenement");
    }
    /**
     * @Route("listEvenement/addEvt", name="addEvt")
     */
    public function add(Request $request)
    {
        $evt= new Evenement();
        $form= $this->createForm(EvenementType::class,$evt);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($evt);
            $em->flush();
            return $this->redirectToRoute("listEvenement");
        }
        return $this->render("evenement/add.html.twig",array("formEvt"=>$form->createView()));
    }
   /**
     * @Route("/updateEvt/{idEvt}", name="updateEvt")
     */
    public function update(Request $request,EvenementRepository $repository,$idEvt)
    {
        //$classroom= $this->getDoctrine()->getRepository(Classroom::class)->find($id)
        $evt= $repository->find($idEvt);
        $form= $this->createForm(EvenementType::class,$evt);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listEvenement");
        }
        return $this->render("evenement/update.html.twig",array("evenement"=>$evt,"formevt"=>$form->createView()));
    }
}
