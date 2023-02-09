<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    #[Route('/type', name: 'type_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();

        $types = $doctrine->getRepository(Type::class)->findAll();

        $type = new Type();
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('type_home');
        }


        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
            'types' => $types,
            'form' => $form->createView()

        ]);
    }

    #[Route('/type/{id}', name: 'type_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $type = $doctrine->getRepository(Type::class)->find($id);
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('type_home');
        }
    }

    #[Route('/type/delete/{id}', name: 'type_delete')]
    public function delete(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $em = $doctrine->getManager();

        $type = $doctrine->getRepository(Type::class)->find($id);
        $type->setIsDeleted(true);
        $em->persist($type);
        $em->flush();

        return $this->redirectToRoute('type_home');
    }
}
