<?php

namespace App\Controller;

use App\Entity\Ordinateur;
use App\Form\OrdinateurType;
use App\Repository\OrdinateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdinateurController extends AbstractController
{
    #[Route('/ordinateur', name: 'ordinateur_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $ordinateurRepository = new OrdinateurRepository($doctrine);
        $ordinateurs = $ordinateurRepository->getOrdinateurInfo();
        $ordinateur = new Ordinateur();
        $form = $this->createForm(OrdinateurType::class, $ordinateur);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($ordinateur);
            $em->flush();

            return $this->redirectToRoute('ordinateur_home');
        }


        return $this->render('ordinateur/index.html.twig', [
            'controller_name' => 'OrdinateurController',
            'ordinateurs' => $ordinateurs,
            'form' => $form->createView()
        ]);
    }

    #[Route('/ordinateur/{id}', name: 'ordinateur_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $ordinateur = $doctrine->getRepository(Ordinateur::class)->find($id);
        $form = $this->createForm(OrdinateurType::class, $ordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($ordinateur);
            $em->flush();

            return $this->redirectToRoute('ordinateur_home');
        }

        return $this->render('ordinateur/edit.html.twig', [
            'controller_name' => 'OrdinateurController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/ordinateur/{id}', name: 'ordinateur_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $ordinateur = $doctrine->getRepository(Ordinateur::class)->find($id);
        $ordinateur->setIsDeleted(true);
        $em->persist($ordinateur);
        $em->flush();

        return $this->redirectToRoute('ordinateur_home');
    }
}
