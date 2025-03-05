<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/classe')]
final class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $classeRepository): Response
    {
        return $this->render('classe/index.html.twig', [
            'classes' => $classeRepository->findAll(),
        ]);
    }


    #[Route('/create', name: 'classe_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $classe = new Classe();
        $classe->setNomClasse($data['nomClasse']);
        $classe->setNiveau($data['niveau']);

        $entityManager->persist($classe);
        $entityManager->flush();

        return $this->json(['message' => 'Classe créée !'], Response::HTTP_CREATED);
    }

    #[Route('/edit/{id}', name: 'classe_edit', methods: ['PUT'])]
    public function edit(int $id, Request $request, ClasseRepository $classeRepository, EntityManagerInterface $entityManager): Response
    {
        $classe = $classeRepository->find($id);
        if (!$classe) {
            return $this->json(['error' => 'Classe non trouvée'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $classe->setNomClasse($data['nomClasse'] ?? $classe->getNomClasse());
        $classe->setNiveau($data['niveau'] ?? $classe->getNiveau());

        $entityManager->flush();

        return $this->json(['message' => 'Classe modifiée !']);
    }

    #[Route('/delete/{id}', name: 'classe_delete', methods: ['DELETE'])]
    public function delete(int $id, ClasseRepository $classeRepository, EntityManagerInterface $entityManager): Response
    {
        $classe = $classeRepository->find($id);
        if (!$classe) {
            return $this->json(['error' => 'Classe non trouvée'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($classe);
        $entityManager->flush();

        return $this->json(['message' => 'Classe supprimée !']);
    }
}
