<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuController extends AbstractController
{
    #[Route('/lieu', name: 'lieu_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        
        $em = $doctrine->getManager();
        $lieux = $doctrine->getRepository(Lieu::class)->findAll();

        $lieu = new Lieu();
        $form = $this->createForm(LieuType::class, $lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($lieu);
            $em->flush();

            return $this->redirectToRoute('lieu_home');
        }
        
        
        return $this->render('lieu/index.html.twig', [
            'controller_name' => 'LieuController',
            'lieux' => $lieux,
            'form' => $form->createView()
        ]);
    }

    #[Route('/lieu/{id}', name: 'lieu_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        
        $em = $doctrine->getManager();
        $lieu = $doctrine->getRepository(Lieu::class)->find($id);
        $form = $this->createForm(LieuType::class, $lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($lieu);
            $em->flush();

            return $this->redirectToRoute('lieu_home');
        }
        
        return $this->render('lieu/edit.html.twig', [
            'controller_name' => 'LieuController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/lieu/delete/{id}', name: 'lieu_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        
        $em = $doctrine->getManager();
        $lieu = $doctrine->getRepository(Lieu::class)->find($id);
        $lieu->setIsDeleted(true);
        $em->persist($lieu);
        $em->flush();

        return $this->redirectToRoute('lieu_home');
    }
}
