<?php
namespace App\Controller;

use App\Entity\Prof;
use App\Repository\ProfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profs')]
final class ProfsController extends AbstractController
{
    #[Route('/', name: 'profs_index', methods: ['GET'])]
    public function index(ProfRepository $profRepository): Response
    {
        $profs = $profRepository->findAll();
        return $this->json($profs);
    }

    #[Route('/create', name: 'profs_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $prof = new Prof();
        $prof->setNom($data['nom']);
        $prof->setPrenom($data['prenom']);
        $prof->setEmail($data['email']);
        $prof->setSpecialite($data['specialite']);

        $entityManager->persist($prof);
        $entityManager->flush();

        return $this->json(['message' => 'Professeur ajouté !'], Response::HTTP_CREATED);
    }

    #[Route('/edit/{id}', name: 'profs_edit', methods: ['PUT'])]
    public function edit(int $id, Request $request, ProfRepository $profRepository, EntityManagerInterface $entityManager): Response
    {
        $prof = $profRepository->find($id);
        if (!$prof) {
            return $this->json(['error' => 'Professeur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $prof->setNom($data['nom'] ?? $prof->getNom());
        $prof->setPrenom($data['prenom'] ?? $prof->getPrenom());
        $prof->setEmail($data['email'] ?? $prof->getEmail());
        $prof->setSpecialite($data['specialite'] ?? $prof->getSpecialite());

        $entityManager->flush();

        return $this->json(['message' => 'Professeur mis à jour !']);
    }

    #[Route('/delete/{id}', name: 'profs_delete', methods: ['DELETE'])]
    public function delete(int $id, ProfRepository $profRepository, EntityManagerInterface $entityManager): Response
    {
        $prof = $profRepository->find($id);
        if (!$prof) {
            return $this->json(['error' => 'Professeur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($prof);
        $entityManager->flush();

        return $this->json(['message' => 'Professeur supprimé !']);
    }
}

