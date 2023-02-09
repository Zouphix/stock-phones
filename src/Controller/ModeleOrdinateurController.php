<?php

namespace App\Controller;

use App\Entity\ModeleOrdinateur;
use App\Form\ModeleOrdinateurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModeleOrdinateurController extends AbstractController
{
    #[Route('/modeleordinateur', name: 'modele_ordinateur_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();

        $modeles_ordinateurs = $doctrine->getRepository(ModeleOrdinateur::class)->findAll();

        $modele_ordinateur = new ModeleOrdinateur();
        $form = $this->createForm(ModeleOrdinateurType::class, $modele_ordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($modele_ordinateur);
            $em->flush();

            return $this->redirectToRoute('modele_ordinateur_home');
        }


        return $this->render('modele_ordinateur/index.html.twig', [
            'controller_name' => 'ModeleOrdinateurController',
            'modeles_ordinateurs' => $modeles_ordinateurs,
            'form' => $form->createView()
        ]);
    }

    #[Route('/modeleordinateur/{id}', name: 'modele_ordinateur_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $modele_ordinateur = $doctrine->getRepository(ModeleOrdinateur::class)->find($id);
        $form = $this->createForm(ModeleOrdinateurType::class, $modele_ordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($modele_ordinateur);
            $em->flush();

            return $this->redirectToRoute('modele_ordinateur_home');
        }

        return $this->render('modele_ordinateur/edit.html.twig', [
            'controller_name' => 'ModeleOrdinateurController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/modeleordinateur/delete/{id}', name: 'modele_ordinateur_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $modele_ordinateur = $doctrine->getRepository(ModeleOrdinateur::class)->find($id);
        $modele_ordinateur->setIsDeleted(true);
        $em->persist($modele_ordinateur);
        $em->flush();

        return $this->redirectToRoute('modele_ordinateur_home');
    }
    
}
