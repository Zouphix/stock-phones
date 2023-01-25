<?php

namespace App\Controller;

use App\Entity\Modele;
use App\Entity\Terminal;
use App\Form\TerminalType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerminalController extends AbstractController
{
    #[Route('/terminal', name: 'terminal_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {


        $terminaux = $doctrine->getRepository(Terminal::class)->findAll();

        $em = $doctrine->getManager();

        $terminal = new Terminal();
        $formTerminal = $this->createForm(TerminalType::class, $terminal);
        try {
            $idModeleA = $request->request->get('terminal')['achete'];
            $idModeleC = $request->request->get('terminal')['communiquant'];
            $imeiAchete = $request->request->get('terminal')['imeiAchete'];
            $imeiCommuniquant = $request->request->get('terminal')['imeiCommuniquant'];

            $modeleA = $doctrine->getRepository(Modele::class)->find($idModeleA);
            $modeleC = $doctrine->getRepository(Modele::class)->find($idModeleC);
            $request->request->set('terminal', ['achete' => $modeleA->getLibelle(), 'communiquant' => $modeleC->getLibelle(), 'imeiAchete' => $imeiAchete, 'imeiCommuniquant' => $imeiCommuniquant]);
            
        } catch (\Throwable $th) {
            //throw $th;
        }

        $formTerminal->handleRequest($request);

        if ($formTerminal->isSubmitted()) {
            $vraiTerminal = new Terminal();
            $vraiTerminal->setAchete($request->request->get('terminal')['achete']);
            $vraiTerminal->setCommuniquant($request->request->get('terminal')['communiquant']);
            $vraiTerminal->setImeiAchete($request->request->get('terminal')['imeiAchete']);
            $vraiTerminal->setImeiCommuniquant($request->request->get('terminal')['imeiCommuniquant']);
            $em->persist($vraiTerminal);
            $em->flush();

            return $this->redirectToRoute('terminal_home');
        }

        return $this->render('terminal/index.html.twig', [
            'controller_name' => 'TerminalController',
            'terminaux' => $terminaux,
            'form' => $formTerminal->createView(),
        ]);
    }

    #[Route('/editterminal/{id}', name: 'terminal_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $terminal = $doctrine->getRepository(Terminal::class)->find($id);
        $editTerminal = new Terminal();
        $em = $doctrine->getManager();

        $form = $this->createForm(TerminalType::class, $editTerminal);
        try {
            $idModeleA = $request->request->get('terminal')['achete'];
            $idModeleC = $request->request->get('terminal')['communiquant'];
            $imeiAchete = $request->request->get('terminal')['imeiAchete'];
            $imeiCommuniquant = $request->request->get('terminal')['imeiCommuniquant'];

            $modeleA = $doctrine->getRepository(Modele::class)->find($idModeleA);
            $modeleC = $doctrine->getRepository(Modele::class)->find($idModeleC);
            $request->request->set('terminal', ['achete' => $modeleA->getLibelle(), 'communiquant' => $modeleC->getLibelle(), 'imeiAchete' => $imeiAchete, 'imeiCommuniquant' => $imeiCommuniquant]);
            
        } catch (\Throwable $th) {
            //throw $th;
        }

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $terminal->setAchete($request->request->get('terminal')['achete']);
            $terminal->setCommuniquant($request->request->get('terminal')['communiquant']);
            $terminal->setImeiAchete($request->request->get('terminal')['imeiAchete']);
            $terminal->setImeiCommuniquant($request->request->get('terminal')['imeiCommuniquant']);
            $em->persist($terminal);
            $em->flush();

            return $this->redirectToRoute('terminal_home');
        }

    
        return $this->render('terminal/edit.html.twig', [
            'controller_name' => 'TerminalController',
            'terminal' => $terminal,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteterminal/{id}', name: 'terminal_delete')]
    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $terminal = $doctrine->getRepository(Terminal::class)->find($id);

        $em = $doctrine->getManager();

        $terminal->setIsDeleted(true);
        $em->persist($terminal);
        $em->flush();

        return $this->redirectToRoute('terminal_home');
    }

}
