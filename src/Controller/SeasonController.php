<?php

namespace App\Controller;

use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/season', name: 'season_')]
final class SeasonController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(): Response
    {
        // TODO formulaire de création de saison
    }

    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(int $id): Response
    {
        // TODO formulaire de update de saison
    }

    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(
        int                    $id,
        EntityManagerInterface $entityManager,
        SeasonRepository       $seasonRepository
    ): Response
    {
        // récupération de la saison pour pouvoir la supprimer
        $season = $seasonRepository->find($id);

        $entityManager->remove($season);
        $entityManager->flush();

        $this->addFlash('success', message: 'Season deleted !');
        return $this->redirectToRoute('series_show', ['id' => $season->getSerie()->getId()]);
    }
}
