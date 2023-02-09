<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockController extends AbstractController
{
    #[Route('/stock', name: 'stock_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $stocks = $doctrine->getRepository(Stock::class)->findAll();

        $stock = new Stock();
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($stock);
            $em->flush();

            return $this->redirectToRoute('stock_home');
        }


        return $this->render('stock/index.html.twig', [
            'controller_name' => 'StockController',
            'stocks' => $stocks,
            'form' => $form->createView()
        ]);
    }

    #[Route('/stock/{id}', name: 'stock_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $stock = $doctrine->getRepository(Stock::class)->find($id);
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($stock);
            $em->flush();

            return $this->redirectToRoute('stock_home');
        }

        return $this->render('stock/edit.html.twig', [
            'controller_name' => 'StockController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/stock/delete/{id}', name: 'stock_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $stock = $doctrine->getRepository(Stock::class)->find($id);
        $stock->setIsDeleted(true);
        $em->persist($stock);
        $em->flush();

        return $this->redirectToRoute('stock_home');
    }
}
