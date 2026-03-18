<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/series', name: 'api_series_')]
final class SerieController extends AbstractController
{
    #[Route('', name: 'retrieve_all', methods: 'GET')]
    public function retrieveAll(): Response
    {
        // TODO renvoyer toutes les séries au format json
    }

    #[Route('/{id}', name: 'retrieve_one', methods: 'GET')]
    public function retrieveOne(int $id): Response
    {
        // TODO renvoyer une série au format json
    }
    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id): Response
    {
        // TODO supprimer une série
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(): Response
    {
        // TODO ajouter une nouvelle série
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        // TODO supprimer une série
    }



