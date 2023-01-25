<?php

namespace App\Controller;

use App\Entity\Forfait;
use App\Form\ForfaitType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForfaitController extends AbstractController
{
    #[Route('/forfait', name: 'forfait_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $forfaits = $doctrine->getRepository(Forfait::class)->findAll();

        $forfait = new Forfait();
        $form = $this->createForm(ForfaitType::class, $forfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('forfait_home');
        }

        return $this->render('forfait/index.html.twig', [
            'controller_name' => 'ForfaitController',
            'forfaits' => $forfaits,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/editforfait/{id}', name: 'forfait_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $forfait = $doctrine->getRepository(Forfait::class)->find($id);

        $form = $this->createForm(ForfaitType::class, $forfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('forfait_home');
        }

        return $this->render('forfait/edit.html.twig', [
            'controller_name' => 'ForfaitController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteforfait/{id}', name: 'forfait_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $forfait = $doctrine->getRepository(Forfait::class)->find($id);

        $forfait->setIsDeleted(true);
        $em = $doctrine->getManager();
        $em->persist($forfait);
        $em->flush();

        return $this->redirectToRoute('forfait_home');
    }
}
