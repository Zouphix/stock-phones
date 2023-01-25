<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeController extends AbstractController
{
    #[Route('/employe', name: 'employe_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $employes = $doctrine->getRepository(Employe::class)->findAll();


        return $this->render('employe/index.html.twig', [
            'controller_name' => 'EmployeController',
            'employes' => $employes,
        ]);
    }

    #[Route('/editemploye/{id}', name: 'employe_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $employe = $doctrine->getRepository(Employe::class)->find($id);

        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('employe_home');
        }

        return $this->render('employe/edit.html.twig', [
            'controller_name' => 'EmployeController',
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteemploye/{id}', name: 'employe_delete')]
    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $employe = $doctrine->getRepository(Employe::class)->find($id);

        $em = $doctrine->getManager();

        $employe->setIsDeleted(true);
        $em->persist($employe);
        $em->flush();

        return $this->redirectToRoute('employe_home');
    }
}
