<?php

namespace App\Controller;

use App\Entity\Ligne;
use App\Form\LigneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LigneController extends AbstractController
{
    #[Route('/lignes', name: 'ligne_home')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $lignes = $doctrine->getRepository(Ligne::class)->findAll();


        return $this->render('ligne/index.html.twig', [
            'controller_name' => 'LigneController',
            'lignes' => $lignes,
        ]);
    }

    #[Route('/editligne/{id}', name: 'ligne_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $ligne = $doctrine->getRepository(Ligne::class)->find($id);

        $form = $this->createForm(LigneType::class, $ligne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('ligne_home');
        }

        return $this->render('ligne/edit.html.twig', [
            'controller_name' => 'LigneController',
            'ligne' => $ligne,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteligne/{id}', name: 'ligne_delete')]
    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $ligne = $doctrine->getRepository(Ligne::class)->find($id);

        $em = $doctrine->getManager();

        $ligne->setIsDeleted(true);
        $em->persist($ligne);
        $em->flush();

        return $this->redirectToRoute('ligne_home');
    }
}
