<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="app_utilisateur_index", methods={"GET"})
     */
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
        ]);
    }


    /**
     * @Route("/profile", name="app_utilisateur_profile", methods={"GET"})
     */
    public function profile(): Response
    {
        if(!is_null($this->getUser())){
            return $this->render('utilisateur/profile.html.twig');
        }else{
            return $this->redirectToRoute('app_login', [
            ]);
        }
    }

    /**
     * @Route("/registration", name="app_utilisateur_registration", methods={"GET", "POST"})
     */
    public function registration(Request $request,  UserPasswordEncoderInterface $userPasswordEncoder,EntityManagerInterface $entityManager): Response
    {
        if(!is_null($this->getUser())){
            return $this->redirectToRoute('app_utilisateur_profile', ['id'=>$this->getUser()->getId()], Response::HTTP_SEE_OTHER);
        }else{
            $utilisateur = new Utilisateur();
            $form = $this->createForm(RegistrationType::class, $utilisateur);
            $form->handleRequest($request);
            $utilisateur->setSolde(0);
            $utilisateur->setIsblocked(0);
            $utilisateur->setPassword($userPasswordEncoder->encodePassword( $utilisateur,$utilisateur->getPassword()));
            if ($form->isSubmitted() && $form->isValid()) {
                if (strcmp($utilisateur->getRoles()[0], "ROLE_INVESTISSEUR") == 0)
                    $utilisateur->setUsertype('Investisseur');
                else
                    $utilisateur->setUsertype('Porteur de projet');
                $entityManager->persist($utilisateur);
                $entityManager->flush();
                return $this->redirectToRoute('app_login');
            }
            return $this->render('utilisateur/registration.html.twig', [
                'utilisateur' => $utilisateur,
                'form' => $form->createView(),
            ]);
        }
    }


    /**
     * @Route("/new", name="app_utilisateur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UtilisateurRepository $utilisateurRepository,UserPasswordEncoderInterface $userPasswordEncoder): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        $utilisateur->setPassword($userPasswordEncoder->encodePassword( $utilisateur,$utilisateur->getPassword()));

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurRepository->add($utilisateur);
            return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_utilisateur_show", methods={"GET"})
     */
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }



    /**
     * @Route("/{id}/editback", name="app_utilisateur_editback", methods={"GET", "POST"})
     */
    public function editback(Request $request,UserPasswordEncoderInterface $userPasswordEncoder, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository): Response
    {


            $form = $this->createForm(UtilisateurType::class, $utilisateur);
            $form->handleRequest($request);
            $utilisateur->setPassword($userPasswordEncoder->encodePassword( $utilisateur,$utilisateur->getPassword()));
            if ($form->isSubmitted() && $form->isValid()) {
                if (strcmp($utilisateur->getRoles()[0], "ROLE_INVESTISSEUR") == 0)
                    $utilisateur->setUsertype('Investisseur');
                else if (strcmp($utilisateur->getRoles()[0], "ROLE_ADMIN") == 0)
                    $utilisateur->setUsertype('Admin');
                else
                    $utilisateur->setUsertype('Porteur de projet');
                $utilisateurRepository->add($utilisateur);
                return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('utilisateur/editback.html.twig', [
                'utilisateur' => $utilisateur,
                'form' => $form->createView(),
            ]);

    }

    /**
     * @Route("/{id}/edit", name="app_utilisateur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request,UserPasswordEncoderInterface $userPasswordEncoder, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository): Response
    {

        if(!is_null($this->getUser())){
            $form = $this->createForm(RegistrationType::class, $utilisateur);
            $form->handleRequest($request);
            $utilisateur->setPassword($userPasswordEncoder->encodePassword( $utilisateur,$utilisateur->getPassword()));
            if ($form->isSubmitted() && $form->isValid()) {
                if (strcmp($utilisateur->getRoles()[0], "ROLE_INVESTISSEUR") == 0)
                    $utilisateur->setUsertype('Investisseur');
                else
                    $utilisateur->setUsertype('Porteur de projet');
                $utilisateurRepository->add($utilisateur);
                return $this->redirectToRoute('app_utilisateur_profile', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('utilisateur/edit.html.twig', [
                'utilisateur' => $utilisateur,
                'form' => $form->createView(),
            ]);
        }else{
            return $this->redirectToRoute('app_login', [
            ]);
        }
    }

    /**
     * @Route("/{id}", name="app_utilisateur_delete", methods={"POST"})
     */
    public function delete(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository): Response
    {
       // if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            $utilisateurRepository->remove($utilisateur);
      //  }

        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
