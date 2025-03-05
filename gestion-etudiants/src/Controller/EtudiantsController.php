<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Etudiant;
use App\Form\EtudiantType;

class EtudiantsController extends AbstractController
{
    #[Route('/etudiants', name: 'app_etudiants')]
    public function index(): Response
    {
        $etudiants = $this->getDoctrine()
            ->getRepository(Etudiant::class)
            ->findAll();

        return $this->render('etudiants/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

    #[Route('/etudiant/new', name: 'app_etudiant_new')]
    public function new(Request $request): Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();

            return $this->redirectToRoute('app_etudiants');
        }

        return $this->render('etudiants/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/etudiant/{id}/edit', name: 'app_etudiant_edit')]
    public function edit(Request $request, Etudiant $etudiant): Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_etudiants');
        }

        return $this->render('etudiants/edit.html.twig', [
            'form' => $form->createView(),
            'etudiant' => $etudiant,
        ]);
    }

    #[Route('/etudiant/{id}/delete', name: 'app_etudiant_delete')]
    public function delete(Etudiant $etudiant): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($etudiant);
        $entityManager->flush();

        return $this->redirectToRoute('app_etudiants');
    }
}
