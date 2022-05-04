<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\TransactionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    /**
     * @Route("/transaction", name="readTransaction")
     */
    public function index(): Response
    {

        $transactions = $this->getDoctrine()->getManager()->getRepository(Transaction::class)->findAll();

        return $this->render('transaction/index.html.twig', [
            'controller_name' => 'TransactionController','t' => $transactions
        ]);
    }

    /**
     * @Route("/createTransaction", name="createTransaction")
     */
    public function createTransaction(Request $r): Response
    {
        $transaction = new Transaction();

        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($r);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();

            return $this->redirect('readTransaction');
        }
        return $this->render('transaction/createTransaction.html.twig', ['f' => $form->createView()]);
    }


    /**
     * @Route("/deleteTransaction/{id}", name="deleteTransaction")
     */
    public function deleteTransaction(Transaction $transaction): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($transaction);
        $em->flush();

        return $this->redirectToRoute("readTransaction");

    }


    /**
     * @Route("/updateTransaction/{id}", name="updateTransaction")
     */
    public function modifierTransaction(Request $r,$id): Response
    {
        $transaction = $this->getDoctrine()->getManager()->getRepository(Transaction::class)->find($id);

        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($r);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect('readTransaction');
        }
        return $this->render('transaction/updateTransaction.html.twig', ['f' => $form->createView()]);
    }


}
