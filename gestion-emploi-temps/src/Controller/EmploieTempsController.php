<?php
namespace App\Controller;

use App\Entity\EmploiTemps;
use App\Repository\EmploiTempsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/emploie/temps')]
final class EmploieTempsController extends AbstractController
{
    #[Route('/emploie/temps', name: 'app_emploie_temps')]
    public function index(EmploieTempsRepository $emploieTempsRepository): Response
    {
        $emplois = $emploieTempsRepository->findAll(); // On récupère tous les emplois du temps

        return $this->render('emploie_temps/index.html.twig', [
            'emplois' => $emplois, // Liste des emplois du temps
        ]);
    }


    #[Route('/create', name: 'emploie_temps_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $emploi = new EmploiTemps();
        $emploi->setJour($data['jour']);
        $emploi->setHeureDebut(new \DateTime($data['heureDebut']));
        $emploi->setHeureFin(new \DateTime($data['heureFin']));
        $emploi->setMatiere($data['matiere']);
        $emploi->setProfesseur($data['professeur']);
        $emploi->setSalle($data['salle']);
        $emploi->setClasse($data['classe']);

        $entityManager->persist($emploi);
        $entityManager->flush();

        return $this->json(['message' => 'Emploi du temps créé !'], Response::HTTP_CREATED);
    }

    #[Route('/edit/{id}', name: 'emploie_temps_edit', methods: ['PUT'])]
    public function edit(int $id, Request $request, EmploiTempsRepository $emploiTempsRepository, EntityManagerInterface $entityManager): Response
    {
        $emploi = $emploiTempsRepository->find($id);
        if (!$emploi) {
            return $this->json(['error' => 'Emploi du temps non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $emploi->setJour($data['jour'] ?? $emploi->getJour());
        if (isset($data['heureDebut'])) {
            $emploi->setHeureDebut(new \DateTime($data['heureDebut']));
        }
        if (isset($data['heureFin'])) {
            $emploi->setHeureFin(new \DateTime($data['heureFin']));
        }
        $emploi->setMatiere($data['matiere'] ?? $emploi->getMatiere());
        $emploi->setProfesseur($data['professeur'] ?? $emploi->getProfesseur());
        $emploi->setSalle($data['salle'] ?? $emploi->getSalle());
        $emploi->setClasse($data['classe'] ?? $emploi->getClasse());

        $entityManager->flush();

        return $this->json(['message' => 'Emploi du temps modifié !']);
    }

    #[Route('/delete/{id}', name: 'emploie_temps_delete', methods: ['DELETE'])]
    public function delete(int $id, EmploiTempsRepository $emploiTempsRepository, EntityManagerInterface $entityManager): Response
    {
        $emploi = $emploiTempsRepository->find($id);
        if (!$emploi) {
            return $this->json(['error' => 'Emploi du temps non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($emploi);
        $entityManager->flush();

        return $this->json(['message' => 'Emploi du temps supprimé !']);
    }
}
