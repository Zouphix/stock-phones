<?php

namespace App\Controller;

use App\Entity\Attribution;
use App\Entity\Employe;
use App\Entity\Ligne;
use App\Entity\Modele;
use App\Entity\Stock;
use App\Entity\Terminal;
use App\Form\AttributionType;
use App\Form\EmployeType;
use App\Form\LigneType;
use App\Form\TerminalType;
use App\Repository\AttributionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/mobile', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(Request $request, ManagerRegistry $doctrine, FormFactoryInterface $formfactory ): Response
    {
        $employes = $doctrine->getRepository(Employe::class)->findAll();

        $modeles = $doctrine->getRepository(Modele::class)->findAll();

 

        $attribution = new AttributionRepository($doctrine);

        $attributions = $attribution->getAttributionInfo();

        $entityManager = $doctrine->getManager();

        $totalAttribution = $doctrine->getRepository(Attribution::class)->findAll();
        
        $countAttribution = count($totalAttribution);

        $totalTerminaux = $doctrine->getRepository(Stock::class)->findOneBy(['libelle' => 'Terminaux'])->getTotal();

        $lignes = $doctrine->getRepository(Ligne::class)->findAll();
     

        $terminauxRestants = $totalTerminaux - $countAttribution;

        $ligne = new Ligne();

        $form = $this->createForm(LigneType::class, $ligne);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($ligne);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');

        }

        $employe = new Employe();
        $formEmploye = $this->createForm(EmployeType::class, $employe);
        $formEmploye->handleRequest($request);
        if ($formEmploye->isSubmitted() && $formEmploye->isValid()) {
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }


        $terminal = new Terminal();
        $formTerminal = $this->createForm(TerminalType::class, $terminal);
        


        try {
            $idModeleA = $request->request->get('terminal')['achete'];
            $idModeleC = $request->request->get('terminal')['communiquant'];
            $imeiAchete = $request->request->get('terminal')['imeiAchete'];
            $imeiCommuniquant = $request->request->get('terminal')['imeiCommuniquant'];

            $modeleA = $doctrine->getRepository(Modele::class)->find($idModeleA);
            $modeleC = $doctrine->getRepository(Modele::class)->find($idModeleC);
            $request->request->set('terminal', ['achete' => $modeleA->getLibelle(), 'communiquant' => $modeleC->getLibelle(), 'imeiAchete' => $imeiAchete, 'imeiCommuniquant' => $imeiCommuniquant]);
            
        } catch (\Throwable $th) {
            //throw $th;
        }

        $formTerminal->handleRequest($request);

        if ($formTerminal->isSubmitted()) {
            $vraiTerminal = new Terminal();
            $vraiTerminal->setAchete($request->request->get('terminal')['achete']);
            $vraiTerminal->setCommuniquant($request->request->get('terminal')['communiquant']);
            $vraiTerminal->setImeiAchete($request->request->get('terminal')['imeiAchete']);
            $vraiTerminal->setImeiCommuniquant($request->request->get('terminal')['imeiCommuniquant']);
            $entityManager->persist($vraiTerminal);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }


        $attribution = new Attribution();
        $formAttribution = $this->createForm(AttributionType::class, $attribution);
        $formAttribution->handleRequest($request);
        if ($formAttribution->isSubmitted() && $formAttribution->isValid()) {
            $entityManager->persist($attribution);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }





        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 
            'employes' => $employes,
            'totalTerminaux' => $totalTerminaux, 
            'terminauxRestants' => $terminauxRestants,
            'attributions' => $attributions,
            'form' => $form->createView(),
            'formEmploye' => $formEmploye->createView(),
            'formTerminal' => $formTerminal->createView(),
            'formAttribution' => $formAttribution->createView(),
            'countAttribution' => $countAttribution,

        ], );


    }

    #[Route('/edit/{id}', name: 'app_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        
        $attribution = $doctrine->getRepository(Attribution::class)->find($id);
        $form = $this->createForm(AttributionType::class, $attribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/edit.html.twig', [
            'attribution' => $attribution,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $attribution = $doctrine->getRepository(Attribution::class)->find($id);
        $attribution->setIsDeleted(true);
        $em = $doctrine->getManager();
        $em->persist($attribution);
        $em->flush();

        return $this->redirectToRoute('app_home');
    }

    
}
