<?php

namespace App\Controller;

use App\Entity\Attribution;
use App\Entity\Employe;
use App\Entity\Stock;
use App\Repository\AttributionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $employes = $doctrine->getRepository(Employe::class)->findAll();

        $attribution = new AttributionRepository($doctrine);

        $attributions = $attribution->getAttributionInfo();


        $totalTerminaux = $doctrine->getRepository(Stock::class)->findOneBy(['libelle' => 'Terminaux'])->getTotal();

        $terminauxRestants = $totalTerminaux - count($employes);


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 
            'employes' => $employes,
            'totalTerminaux' => $totalTerminaux, 
            'terminauxRestants' => $terminauxRestants,
            'attributions' => $attributions
        ], );


    }
}
