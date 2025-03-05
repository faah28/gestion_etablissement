<?php
namespace App\Controller;

use App\Entity\Cours;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cours')]
final class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours')]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cours/index.html.twig', [
            'cours_list' => $coursRepository->findAll(),
        ]);
    }


    #[Route('/create', name: 'cours_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $cours = new Cours();
        $cours->setNomCours($data['nomCours']);
        $cours->setDescription($data['description']);
        $cours->setProfesseur($data['professeur']);
        $cours->setDateDebut(new \DateTime($data['dateDebut']));
        $cours->setDateFin(new \DateTime($data['dateFin']));

        $entityManager->persist($cours);
        $entityManager->flush();

        return $this->json(['message' => 'Cours créé !'], Response::HTTP_CREATED);
    }

    #[Route('/edit/{id}', name: 'cours_edit', methods: ['PUT'])]
    public function edit(int $id, Request $request, CoursRepository $coursRepository, EntityManagerInterface $entityManager): Response
    {
        $cours = $coursRepository->find($id);
        if (!$cours) {
            return $this->json(['error' => 'Cours non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $cours->setNomCours($data['nomCours'] ?? $cours->getNomCours());
        $cours->setDescription($data['description'] ?? $cours->getDescription());
        $cours->setProfesseur($data['professeur'] ?? $cours->getProfesseur());
        if (isset($data['dateDebut'])) {
            $cours->setDateDebut(new \DateTime($data['dateDebut']));
        }
        if (isset($data['dateFin'])) {
            $cours->setDateFin(new \DateTime($data['dateFin']));
        }

        $entityManager->flush();

        return $this->json(['message' => 'Cours modifié !']);
    }

    #[Route('/delete/{id}', name: 'cours_delete', methods: ['DELETE'])]
    public function delete(int $id, CoursRepository $coursRepository, EntityManagerInterface $entityManager): Response
    {
        $cours = $coursRepository->find($id);
        if (!$cours) {
            return $this->json(['error' => 'Cours non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($cours);
        $entityManager->flush();

        return $this->json(['message' => 'Cours supprimé !']);
    }
}
