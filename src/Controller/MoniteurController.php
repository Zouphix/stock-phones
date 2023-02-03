<?php

namespace App\Controller;

use App\Entity\Moniteur;
use App\Form\MoniteurType;
use App\Repository\MoniteurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoniteurController extends AbstractController
{
    #[Route('/moniteur', name: 'moniteur_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $moniteurRepo = new MoniteurRepository($doctrine);
        $moniteurs = $moniteurRepo->getMoniteurInfo();
        $em = $doctrine->getManager();
        $moniteur = new Moniteur();
        $form = $this->createForm(MoniteurType::class, $moniteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($moniteur);
            $em->flush();
            return $this->redirectToRoute('moniteur_home');
        }






        return $this->render('moniteur/index.html.twig', [
            'controller_name' => 'MoniteurController',
            'moniteurs' => $moniteurs,
            'form' => $form->createView(),


        ]);
    }

    #[Route('/moniteur/{id}', name: 'moniteur_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $moniteur = $doctrine->getRepository(Moniteur::class)->find($id);
        $em = $doctrine->getManager();
        $form = $this->createForm(MoniteurType::class, $moniteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($moniteur);
            $em->flush();

            return $this->redirectToRoute('moniteur_home');
        }

        return $this->render('moniteur/edit.html.twig', [
            'moniteur' => $moniteur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/moniteur/delete/{id}', name: 'moniteur_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $moniteur = $doctrine->getRepository(Moniteur::class)->find($id);
        $em = $doctrine->getManager();
        $moniteur->setIsDeleted(true);
        $em->persist($moniteur);
        $em->flush();

        return $this->redirectToRoute('moniteur_home');
    }
}
