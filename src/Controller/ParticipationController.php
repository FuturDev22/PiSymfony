<?php

namespace App\Controller;
use App\Entity\Participation;
use App\Repository\ParticipationRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipationController extends AbstractController
{
    
     /**
     * @Route("/listParticipants", name="listParticipants")
     */
    public function affiche()
    {
        $p= $this->getDoctrine()->getRepository(Participation::class)->findAll();
        return $this->render("evenement/participants.html.twig",array("part"=>$p));
    }
}
