<?php

namespace App\Controller;

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
    public function delete(int $id): Response
    {
        // TODO delete de saison et renvoyer sur la page de série
    }
}
