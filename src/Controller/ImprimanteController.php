<?php

namespace App\Controller;

use App\Entity\Imprimante;
use App\Form\ImprimanteType;
use App\Repository\ImprimanteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImprimanteController extends AbstractController
{
    #[Route('/imprimante', name: 'imprimante_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $imprimanteRepo = new ImprimanteRepository($doctrine);
        $imprimantes = $imprimanteRepo->getImprimanteInfo();
        $em = $doctrine->getManager();
        $imprimante = new Imprimante();
        $form = $this->createForm(ImprimanteType::class, $imprimante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($imprimante);
            $em->flush();
            return $this->redirectToRoute('imprimante_home');
        }

        return $this->render('imprimante/index.html.twig', [
            'controller_name' => 'ImprimanteController',
            'imprimantes' => $imprimantes,
            'form' => $form->createView(),

        ]);
    }

    #[Route('/imprimante/{id}', name: 'imprimante_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $imprimante = $doctrine->getRepository(Imprimante::class)->find($id);
        $em = $doctrine->getManager();
        $form = $this->createForm(ImprimanteType::class, $imprimante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($imprimante);
            $em->flush();

            return $this->redirectToRoute('imprimante_home');
        }

        return $this->render('imprimante/edit.html.twig', [
            'controller_name' => 'ImprimanteController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/imprimante/delete/{id}', name: 'imprimante_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $imprimante = $doctrine->getRepository(Imprimante::class)->find($id);
        $em = $doctrine->getManager();
        $imprimante->setIsDeleted(true);
        $em->persist($imprimante);
        $em->flush();

        return $this->redirectToRoute('imprimante_home');
    }
}
