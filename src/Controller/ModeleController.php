<?php

namespace App\Controller;

use App\Entity\Modele;
use App\Form\ModeleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModeleController extends AbstractController
{
    #[Route('/modele', name: 'modele_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $modeles = $doctrine->getRepository(Modele::class)->findAll();

        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('modele_home');
        }


        return $this->render('modele/index.html.twig', [
            'controller_name' => 'ModeleController',
            'modeles' => $modeles,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modele/{id}', name: 'modele_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $em = $doctrine->getManager();
        $modele = $doctrine->getRepository(Modele::class)->find($id);

        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('modele_home');
        }

        return $this->render('modele/edit.html.twig', [
            'controller_name' => 'ModeleController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modele/delete/{id}', name: 'modele_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $em = $doctrine->getManager();
        $modele = $doctrine->getRepository(Modele::class)->find($id);

        $modele->setIsDeleted(true);
        $em->persist($modele);
        $em->flush();

        return $this->redirectToRoute('modele_home');
    }
}
