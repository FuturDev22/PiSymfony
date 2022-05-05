<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Entity\Evenement;

use App\Form\EvenementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\EvenementRepository;

class CalendrierController extends AbstractController
{
   

      /**
     * @Route("/calendrier", name="calendrier")
     */ 
    public function index(): Response
    {   
        $evts= $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        

        $rdvs = [];

        foreach($evts as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getDateEvt()->format('Y-m-d'),
            
                'title' => $event->getNomEvt(),
                'description' => $event->getDescriptionEvt(),
                'backgroundColor' => '#FF5555',
                'borderColor' => '#FF5555',
                'textColor' => 'black',
                
            ];
        }
    
    $d = json_encode($rdvs);

    return $this->render('evenement/Calendrier.html.twig',compact('d'));
    }

}
