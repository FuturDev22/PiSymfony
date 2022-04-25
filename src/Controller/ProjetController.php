<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @Route("/projet")
 */
class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="app_projet_index", methods={"GET"})
     */
    public function index(ProjetRepository $projetRepository): Response
    {

        return $this->render('projet/index.html.twig', [
            'projets' => $projetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin", name="display_admin")
     */
    public function indexAdmin(): Response
    {
        return $this->render('Admin/index.html.twig');
    }

    /**
     * @Route("/new", name="app_projet_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProjetRepository $projetRepository): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projetRepository->add($projet);
            return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('projet/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_projet_show", methods={"GET"})
     */
    public function show(Projet $projet): Response
    {
        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_projet_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Projet $projet, ProjetRepository $projetRepository): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projetRepository->add($projet);
            return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_projet_delete", methods={"POST"})
     */
    public function delete(Request $request, Projet $projet): Response
    {
        if ($this->isCsrfTokenValid('delete' . $projet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_projet_index');
    }




    /**
     * @Route("/listProj", name="listProj")
     */
    public function afficheFront()
    {
        $projets= $this->getDoctrine()->getRepository(Projet::class)->findAll();
        return $this->render("projet/listprojets.html.twig",array("tabprojets"=>$projets));
    }


    /**
     * @Route("/listProjet/{id}", name="showP")
     */
    public function showw(int $id): Response
    {
        $projets = $this->getDoctrine()->getRepository(Projet::class)->find($id);

        return $this->render('projet/details.html.twig', ['tabprojets' => $projets]);
    }

    /**
     * @Route ("/listp/list", name="projets_list", methods={"GET"})
     */

    public function listprojets(ProjetRepository $projetRepository): Response

    {

        // Configure Dompdf according to your needs
        $pdf0ptions = new Options ();
        $pdf0ptions->set('defaultFont', 'Arial');
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf ($pdf0ptions);
        $projets = $projetRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('projet/listprojets.html.twig', [
            'projets' => $projets,
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (force download
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);


        return $this->render('projet/listprojets.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/let/details", name="/let/ProjetDetails")
     */
    public function afficheDetails()
    {
        $projets= $this->getDoctrine()->getRepository(Projet::class)->findAll();
        return $this->render("projet/details.html.twig",array("tabprojets"=>$projets));
    }

    /**
     * @Route("/view/afficheprojet", name="Projet")
     */
    public function Front()
    {
        $projets= $this->getDoctrine()->getRepository(Projet::class)->findAll();

        return $this->render("projet/FrontDetails.html.twig",array("tabprojet"=>$projets));
    }
    /**
     * @Route("/see/listingaction", name="CollectionProjet")
     */
    public function listprojetAction(Request $request)
    {
        $projets= $this->getDoctrine()->getRepository(Projet::class)->findAll();
        return $this->render("projet/seeprojets.html.twig", array(
            "projets"=>$projets
        ));
    }

    /**
     * @Route("/updateprojet/{id}", name="update_projet")
     */
    public function updateprojetAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $this->getDoctrine()->getRepository(Projet::class)->findAll();
        $form=$this->createForm(ProjetType::class,$p);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $file = $p->getImage();
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('photos_directory'),$filename);
            $p->setImage($filename);
            $p->setDateDebut(new \DateTime('now'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
            return $this->redirectToRoute('CollectionProjet');

        }
        return $this->render('projet/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/showprojet/{id}", name="show_projet")
     */
    public function showdetailAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $p= $this->getDoctrine()->getRepository(Projet::class)->find($id);
        return $this->render('projet/showdetailprojet.html.twig',array(
            'Nom'=>$p->getNomProjet(),
            'Date Debut'=>$p->getDateDebut(),
            'Date fin'=>$p->getDateFin(),
            'Montant Collectee'=>$p->getMontantCollecte(),
            'Montant Demandee'=>$p->getMontantDemandee(),
            'id'=>$p->getId()

        ));

    }
    /**
     * @Route("/search", name="Ajax_search")
     */

    public function searchAction(Request  $request)
    {
        $em=$this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $projets = $em->getRepository(Projet::class)->findEntitiesByString($requestString);
        if(!$projets){
            $result['projets']['error']="Projet not found:(";
        }else{
            $result['projets']=$this->getRealEntities($projets);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($projets)
    {
         foreach ($projets as $projets){
             $realEntities[$projets->getId()]=[$projets->getImage(),$projets->getNomProjet()];
         }
         return $realEntities;
    }
    /**
     * @Route("/tri/triprojet", name="/tri/triprojet")
     */
    public function Tri(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT p FROM App\Entity\Projet p
            ORDER BY p.nom_projet '
        );

        $projets = $query->getResult();



        return $this->render('projet/index.html.twig',
            array('projets' => $projets));

    }

}

