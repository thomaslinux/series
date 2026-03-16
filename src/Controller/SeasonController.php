<?php

namespace App\Controller;

use App\Entity\Season;
use App\Form\SeasonType;
use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/season', name: 'season_')]
final class SeasonController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $season = new Season();
        $seasonForm = $this->createForm(SeasonType::class, $season);
        $seasonForm->handleRequest($request);

        if ($seasonForm->isSubmitted() && $seasonForm->isValid()) {
            $season->setDateCreated(new \DateTime());
            $entityManager->persist($season);
            $entityManager->flush();

            $this->addFlash('success', 'Season added !');
            return $this->redirectToRoute('series_show', ['id' => $season->getSerie()->getId()]);
        }

        return $this->render('season/add.html.twig', [
            'seasonForm' => $seasonForm
        ]);
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
