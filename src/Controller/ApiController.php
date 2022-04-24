<?php

namespace App\Controller;
use App\Entity\Evenement;
use DateTime;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="app_api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Evenement $event, Request $request)
    {
        // On récupère les données
        $donnees = json_decode($request->getContent());
       
        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$event){
                // On instancie un rendez-vous
                $event = new Evenement;

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $event->setNomEvt($donnees->title);
            $event->setDescriptionEvt($donnees->description);
            $event->setDateEvt(new Date($donnees->start));
            $event->setHeureEvt($event->getHeureEvt());
            $event->setPlaces($event->getPlaces());
            $event->setResponsable($event->getResponsable());
            $event->setCategorie($event->getCategorie()->getNomCategorie());
            $event->setLieuEvt($event->getLieuEvt());

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }


        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
