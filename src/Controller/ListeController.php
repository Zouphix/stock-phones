<?php

namespace App\Controller;

use App\Entity\Liste;
use App\Form\ListeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeController extends AbstractController
{
    #[Route('/liste', name: 'liste_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $listes = $doctrine->getRepository(Liste::class)->findAll();

        $liste = new Liste();
        $form = $this->createForm(ListeType::class, $liste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('liste_home');
        }


        return $this->render('liste/index.html.twig', [
            'controller_name' => 'ListeController',
            'listes' => $listes,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/editliste/{id}', name: 'liste_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $liste = $doctrine->getRepository(Liste::class)->find($id);

        $form = $this->createForm(ListeType::class, $liste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('liste_home');
        }

        return $this->render('liste/edit.html.twig', [
            'controller_name' => 'ListeController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteliste/{id}', name: 'liste_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $liste = $doctrine->getRepository(Liste::class)->find($id);

        $liste->setIsDeleted(true);
        $em = $doctrine->getManager();
        $em->persist($liste);
        $em->flush();

        return $this->redirectToRoute('liste_home');
    }
}
