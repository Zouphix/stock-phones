<?php

namespace App\Controller;

use App\Entity\Attribution;
use App\Entity\Employe;
use App\Entity\Ligne;
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
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(Request $request, ManagerRegistry $doctrine, FormFactoryInterface $formfactory ): Response
    {
        $employes = $doctrine->getRepository(Employe::class)->findAll();

        $attribution = new AttributionRepository($doctrine);

        $attributions = $attribution->getAttributionInfo();

        $entityManager = $doctrine->getManager();

        $totalTerminaux = $doctrine->getRepository(Stock::class)->findOneBy(['libelle' => 'Terminaux'])->getTotal();

        $terminauxRestants = $totalTerminaux - count($employes);

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
        $formTerminal->handleRequest($request);
        if ($formTerminal->isSubmitted() && $formTerminal->isValid()) {
            $entityManager->persist($terminal);
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

        ], );


    }
}
