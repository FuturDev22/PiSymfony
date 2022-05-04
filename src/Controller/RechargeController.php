<?php

namespace App\Controller;

use App\Entity\Recharge;
use App\Form\AutoGenRechargeType;
use App\Form\RechargeType;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Secure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SecureFin;
use App\Controller\pdfHandler;

class RechargeController extends AbstractController
{
    /**
     * @Route("/recharge", name="readRecharge")
     */
    public function index(): Response
    {
        $recharges = $this->getDoctrine()->getManager()->getRepository(Recharge::class)->findAll();
        return $this->render('recharge/index.html.twig', [
            'controller_name' => 'RechargeController',
        'r'=>$recharges]);
    }

    /**
     * @Route("/Back/", name="readRechargeAdmin")
     */
    public function indexAdmin(): Response
    {
        $recharges = $this->getDoctrine()->getManager()->getRepository(Recharge::class)->findAll();
        return $this->render('Back/index.html.twig');
    }


    /**
     * @Route("/createRecharge", name="createRecharge")
     */
    public function createRecharge(Request $r): Response
    {
        $recharge = new Recharge();

        $form= $this->createForm(RechargeType::class,$recharge);
        $form->handleRequest($r);

        if($form->isSubmitted()&&$form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($recharge);
            $em->flush();

            return $this->redirect('readRecharge');
        }
        return $this->render('recharge/createRecharge.html.twig',['f'=>$form->createView()]);
    }



    public function filla(Recharge $rec){
        $sf= new SecureFin();
        $rec->setCode($sf->tokenGen());
        $rec->setNumSerie($sf->serialGen());
    }


    /**
     * @Route("/autoGenRecharge", name="autoGenRecharge")
     */

    public function autoGenRecharge(Request $r): Response
    {
        $form= $this->createForm(AutoGenRechargeType::class);
        $form->handleRequest($r);

        if($form->isSubmitted()&&$form->isValid()){
            $data=$form->getData();
            $n=$data["Nombre:"];
            $v=$data["Valeur:"];
            for ($i=0;$i<$n;$i++){
                $recharge = new Recharge();
                $this->filla($recharge);
                $recharge->setValeur($v);
                $recharge->setValidite(false);
                $smtx= new pdfHandler();
                $smtx->setCode($recharge->getCode());
                $smtx->setValeur($recharge->getValeur());
                $smtx->setNumser($recharge->getNumSerie());
                $smtx->fillMe();
                $em= $this->getDoctrine()->getManager();
                $em->persist($recharge);
                $em->flush();
        }
            return $this->redirect('recharge');

        }
        return $this->render('recharge/autoGenRecharge.html.twig',['f'=>$form->createView()]);
    }

    public function semtex(){
        $smtx= new pdfHandler();
        $smtx->setCode();
        $smtx->setValeur();
        $smtx->setNumser();
        $smtx->fillMe();
    }

}
