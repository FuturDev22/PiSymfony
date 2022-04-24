<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Entity\Participation;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\LikeEvt;
use App\Repository\LikeEvtRepository;
use App\Entity\Categorieevt;
use App\Repository\CategorieevtRepository;
use App\Services\QrcodeService;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\EvenementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\EvenementRepository;
use App\Repository\ParticipationRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
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
    public function afficheFrontD(Request $request , PaginatorInterface $paginator): Response
    {
        
        $evts= $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        $c= $this->getDoctrine()->getRepository(Categorieevt::class)-> findAll();
        //recuperer filters
        $filters=$request->get("tabc");
        
        $events = $paginator->paginate(
            $evts,
            $request->query->getInt('page', 1),
            2
        );
        //verifie si on a une requete ajax
        if($request->get('ajax')){
            return"ok";
        }
        return $this->render("evenement/FrontDetails.html.twig",array("tabevt"=>$events,"tabc"=>$c));
    } 
    /**
     * @Route("/Event/{categorie}", name="EventC")
     */
    public function afficheFrontDD(Request $request , PaginatorInterface $paginator,$categorie): Response
    {
        
        $evts= $this->getDoctrine()->getRepository(Evenement::class)->findByCategorie($categorie);
        $c= $this->getDoctrine()->getRepository(Categorieevt::class)-> findAll();
        //recuperer filters
        $filters=$request->get("tabc");
        
        $events = $paginator->paginate(
            $evts,
            $request->query->getInt('page', 1),
            2
        );
        //verifie si on a une requete ajax
        if($request->get('ajax')){
            return"ok";
        }
        return $this->render("evenement/FrontDetails.html.twig",array("tabevt"=>$events,"tabc"=>$c));
    } 




    /**
     * @Route("/statistiques", name="stat")
     */
    public function stat(){
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $evts = $repository->findAll();
        $em = $this->getDoctrine()->getManager();
        $rd=0; 
        $qu=0;
        $es=0;
        $co=0;
        $cours=0;
        foreach ($evts as $evts)
        {
            if (  $evts->getCategorie()->getNomCategorie()=="formation")  :
            
                $rd+=1; 
             elseif ($evts->getCategorie()->getNomCategorie()=="workshop"):

                $qu+=1; 
            elseif ($evts->getCategorie()->getNomCategorie()=="conference"):

               $co+=1;
             else :
                $cours+=1; 
            
             endif;

        }
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['catégories', 'nombres'],
             ['Formation',     $rd],
             ['workshop',      $qu],
             ['conférence',     $co],
             ['cours',   $cours]
            ]
        );
        $pieChart->getOptions()->setTitle('           Pourcentage des événements par catégorie');
        $pieChart->getOptions()->setHeight(650);
        $pieChart->getOptions()->setWidth(1700);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#3F6FF3');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
    
        return $this->render('evenement/stat.html.twig', array('piechart' => $pieChart));
        }

        /**
     * @Route("/statistiques1", name="stat1")
     */
    public function stat1(){
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $evts = $repository->findAll();
        $em = $this->getDoctrine()->getManager();
        $jan=0; 
        $fev=0;
        $mars=0;
        $av=0; 
        $mai=0;
        $juin=0;
        $juillet=0; 
        $aout=0;
        $sep=0;
        $oct=0;
        $nov=0; 
        $des=0;
        foreach ($evts as $evts)
        {
            if (  $evts->getDateEvt()->format('m')=="01")  :
            
                $jan+=1; 
             elseif ($evts->getDateEvt()->format('m')=="02"):

                $fev+=1; 
            elseif ($evts->getDateEvt()->format('m')=="03"):

                $mars+=1; 
            elseif ($evts->getDateEvt()->format('m')=="04"):

                $av+=1; 
            elseif ($evts->getDateEvt()->format('m')=="05"):

                    $mai+=1; 
             elseif ($evts->getDateEvt()->format('m')=="06"):

               $juin+=1; 
            elseif ($evts->getDateEvt()->format('m')=="07"):

                $juillet+=1; 
            elseif ($evts->getDateEvt()->format('m')=="08"):

                 $aout+=1; 
            elseif ($evts->getDateEvt()->format('m')=="09"):

                  $sep+=1; 
            elseif ($evts->getDateEvt()->format('m')=="10"):

                    $oct+=1; 
            elseif ($evts->getDateEvt()->format('m')=="11"):

                        $nov+=1; 
            
             else :
                $des +=1;  
            
             endif;

        }
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['événements par mois', 'nombres'],
            ['Janvier',     $jan],
             ['Février',      $fev],
             ['Mars',     $mars],
             ['Avril',      $av],
             ['Mai',     $mai],
             ['Juin',      $juin],
             ['Juillet',   $juillet],
             ['Aout',     $aout],
             ['Septembre',      $sep],
             ['Novembre',     $nov],
             ['Decembre',      $des],
            ]
        );
        $pieChart->getOptions()->setTitle('Pourcentage des événements par mois');
        $pieChart->getOptions()->setHeight(650);
        $pieChart->getOptions()->setWidth(1700);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#3F6FF3');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
    
        return $this->render('evenement/stat1.html.twig', array('piechart' => $pieChart));
        }

     /**
     * @Route("/pdf", name="pdf")
     */
    public function pdf(): Response
    {
       // Configure Dompdf according to your needs
       $pdfOptions = new Options();
       $pdfOptions->set('defaultFont', 'Arial');
       
       // Instantiate Dompdf with our options
       $dompdf = new Dompdf($pdfOptions);
       $evts= $this->getDoctrine()->getRepository(Evenement::class)-> findAll();
       
       
       // Retrieve the HTML generated in our twig file
       $html = $this->render("evenement/listpdf.html.twig",array("tabevt"=>$evts));
       
       // Load HTML to Dompdf
       $dompdf->loadHtml($html);
       
       // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
       $dompdf->setPaper('A4', 'portrait');

       // Render the HTML as PDF
       $dompdf->render();

       // Output the generated PDF to Browser (force download)
       $dompdf->stream("ListEvents.pdf", [
           "Attachment" => true

       ]);


       
    }
    /**
     * @Route("listEvenement/ajouter", name="ajouter")
     */
    public function ajouter(Request $request,FlashyNotifier $flashy)
    {
        $event= new Evenement();
        $form= $this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $flashy->success('Un nouveau événement est ajouté');
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
    public function delete($idEvt,FlashyNotifier $flashy)
    {
        $evt= $this->getDoctrine()->getRepository(Evenement::class)->find($idEvt);
        $em = $this->getDoctrine()->getManager();
        $em->remove($evt);
        $em->flush();
        $flashy->success('Un  événement est supprimé');
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
    public function update(Request $request,EvenementRepository $repository,$idEvt,FlashyNotifier $flashy)
    {
        //$classroom= $this->getDoctrine()->getRepository(Classroom::class)->find($id)
        $evt= $repository->find($idEvt);
        $form= $this->createForm(EvenementType::class,$evt);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            $flashy->success('Un  événement est modifié!');
            return $this->redirectToRoute("listEvenement");
        }
        return $this->render("evenement/update.html.twig",array("evenement"=>$evt,"formevt"=>$form->createView()));
    }
    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search", name="ajax_search")
     *
     */
    public function search(Request $request): Response
    {
        $em= $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $evts =  $em->getRepository(Evenement::class)->findEntitiesByString($requestString);
        if(!$evts) {
            $result['evts']['error'] = "Evenement Non disponible :( ";
        } else {
            $result['evts'] = $this->getRealEntities($evts);
        }
        return new Response(json_encode($result));
    }  
    public function getRealEntities($evts){
        foreach ($evts as $evts){
            $realEntities[$evts->getId()] = [$evts->getNomEvt()];

        }
        return $realEntities;
    }   
     /**
     * @Route("/details/{id}", name="details")
     */
    public function details (Request $request,$id)
    {
        $evt = $this->getDoctrine()->getRepository(Evenement::class)->find($id);
        return $this->render("evenement/detailsEvt.html.twig",
            array('l'=>$evt));
    }
       /**
     * @Route("/detailsParCategorie", name="detailsCat")
     */
    public function detailsCat (Request $request)
    {
        $c = $this->getDoctrine()->getRepository(CategorieEvt::class)->findAll();
        $evt = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        return $this->render("evenement/detailsCat.html.twig",
            array('det'=>$evt,'cat'=>$c));
    }
      /**
     * @Route("/detailsParC/{categorie}", name="detailsC")
     */
    public function detailsC (Request $request,$categorie)
    {
        $c = $this->getDoctrine()->getRepository(CategorieEvt::class)->findAll();

        $evt = $this->getDoctrine()->getRepository(Evenement::class)->findByCategorie($categorie);
        return $this->render("evenement/detailsCat.html.twig",
            array('det'=>$evt,'cat'=>$c));
    }

      /**
     * @Route("/Adetails/{id}", name="Adetails")
     */
    public function Admindetails (Request $request,$id)
    {
        $evt = $this->getDoctrine()->getRepository(Evenement::class)->find($id);
        return $this->render("evenement/details.html.twig",
            array('l'=>$evt));
    }
   
     /**
     * @Route("/Participer/{idEvt}", name="participation")
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     */
    public function participer( Request $request, QrcodeService $qrcodeService ,$idEvt,FlashyNotifier $flashy): Response
    {   
        $tab=[];
        $product = $this->getDoctrine()->getRepository(Evenement::class)->find($idEvt);
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find(1);
        $participation = $this->getDoctrine()->getRepository(Participation::class)->findAll();
        $tab=['NomEvent'=>$product->getNomEvt(),'Date'=>$product->getDateEvt()->format('y-m-d'),'Heure'=>$product->getHeureEvt()->format('H:m'),'Lieu'=>$product->getLieuEvt()];
        $places= $product->getPlaces();
        $us=$user->getId();
        $idEvt=$product->getId();
        $iduser= $user->getId();
        $p=$product->getId();
        $ParEvt = $this->getDoctrine()->getRepository(Participation::class)->findByidEvt($p);
        $ParUser = $this->getDoctrine()->getRepository(Participation::class)->findByidUser($us);
        // $qrCode = null;
        // $data=json_encode($product);
        // $productArray = $product->toArray();
        $partc = new Participation();
        
        //return $this->render('evenement/qr.html.twig', ['qrCode' => $qrCode,'d' => $product, 'user' => $user, 'participation' => $participation]);
  
    // PDF///////////////////////
        $json = json_encode($tab);
      //  dd($json);
        $qrCode = $qrcodeService->qrcode($json);
       // Configure Dompdf according to your needs
       $pdfOptions = new Options();
       $pdfOptions->set('defaultFont', 'Arial');
       
       // Instantiate Dompdf with our options
       $dompdf = new Dompdf($pdfOptions);
      // $evts= $this->getDoctrine()->getRepository(Evenement::class)-> findAll();
       
       // Retrieve the HTML generated in our twig file
       $html = $this->render("evenement/qr.html.twig",['qrCode' => $qrCode,'d' => $product, 'user' => $user, 'participation' => $participation]);
       
       // Load HTML to Dompdf
       $dompdf->loadHtml($html);
       
       // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
       $dompdf->setPaper('A4', 'portrait');

       // Render the HTML as PDF
       $dompdf->render();

       // Output the generated PDF to Browser (force download)
       $dompdf->stream("ListEvents.pdf", [
           "Attachment" => true

       ]);
/////////////////////////////
        $partc->setIdEvt($product); 
        $partc->setIdUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($partc);
        $em->flush();
        $product->setPlaces($places-1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute("Event");
        $flashy->success('Vous avez bien participé au événement!');
            foreach ($ParEvt as $le) {
                $e=$le->getIdEvt();
                foreach ($ParUser as $ls) {
                    $u=$ls->getIdUser();


                if($e=$p && $u=$us){
                $flashy->error('Vous avez déja participé cet événement!');  
                
                
                    }
                else{
                    $flashy->success('Vous avez bien participé cet événement!');

                    
                        }
                        
            
            }
            }     
                
            return $this->redirectToRoute("Event"); 
        
              

        
        

    }

     /**
     * @Route("/aimer/{idEvt}", name="aime")
     * @param Request $request
     * 
     * =
     */
    public function aimer( Request $request,$idEvt,SessionInterface $session,FlashyNotifier $flashy): Response
    {   
        $product = $this->getDoctrine()->getRepository(Evenement::class)->find($idEvt);
        $p=$product->getId();
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find(2);
        $us=$user->getId();
        $idEvt=$product->getId();
        $iduser= $user->getId();
        $likeEvt = $this->getDoctrine()->getRepository(LikeEvt::class)->findByidEvt($p);
        $likeUser = $this->getDoctrine()->getRepository(LikeEvt::class)->findByidUser($us);
        
        $like = new LikeEvt();
        $like->setIdEvt($product);
        $like->setIdUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->flush();
        
        $flashy->success('Vous avez bien aimé cet événement!'); 
        foreach ($likeEvt as $le) {
                $e=$le->getIdEvt();
                foreach ($likeUser as $ls) {
                     $u=$ls->getIdUser();
        
      
                   if($e=$p && $u=$us){
                   $flashy->error('Vous avez déja aimé cet événement!');  
                   
                 
                    }
                   else{
                    $flashy->success('Vous avez bien aimé cet événement!');

                    
                        }
                        
             
            }
        }     
                
              return $this->redirectToRoute("Event");       
       
             } 
         
    
    
    
     /**
     * @Route("/Particip/{idEvt}", name="participations")
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     */
    public function addParticipation( Request $request, QrcodeService $qrcodeService ,$idEvt,FlashyNotifier $flashy): Response
    {   
        $product = $this->getDoctrine()->getRepository(Evenement::class)->find($idEvt);
        $participation = $this->getDoctrine()->getRepository(Participation::class)->findAll();
        $tab=['NomEvent'=>$product->getNomEvt(),'Date'=>$product->getDateEvt()->format('y-m-d'),'Heure'=>$product->getHeureEvt()->format('H:m'),'Lieu'=>$product->getLieuEvt()];
        $places= $product->getPlaces();
        $p=$product->getId();
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find(2);
        $us=$user->getId();
        $idEvt=$product->getId();
        $iduser= $user->getId();
        $likeEvt = $this->getDoctrine()->getRepository(Participation::class)->findByidEvt($p);
        $likeUser = $this->getDoctrine()->getRepository(Participation::class)->findByidUser($us);
       // PDF///////////////////////
       $json = json_encode($tab);
       //  dd($json);
         $qrCode = $qrcodeService->qrcode($json);
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
       // $evts= $this->getDoctrine()->getRepository(Evenement::class)-> findAll();
        
        // Retrieve the HTML generated in our twig file
        $html = $this->render("evenement/qr.html.twig",['qrCode' => $qrCode,'d' => $product, 'user' => $user, 'participation' => $participation]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
 
        // Render the HTML as PDF
        $dompdf->render();
 
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ListEvents.pdf", [
            "Attachment" => true
 
        ]);
        //////////////////////
        $part = new LikeEvt();
        $part->setIdEvt($product);
        $part->setIdUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($part);
        $em->flush();
        $product->setPlaces($places-1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $flashy->success('Vous avez bien aimé cet événement!'); 
        foreach ($likeEvt as $le) {
                $e=$le->getIdEvt();
                foreach ($likeUser as $ls) {
                     $u=$ls->getIdUser();
        
      
                   if($e=$p && $u=$us){
                   $flashy->error('Vous avez déja participé cet événement!');  
                   
                 
                    }
                   else{
                    $flashy->success('Vous avez bien participé cet événement!');

                    
                        }
                        
             
            }
        }     
                
              return $this->redirectToRoute("Event");       
       
             } 

    }
   






