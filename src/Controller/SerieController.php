<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('series', name: 'series_')]
final class SerieController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(): Response
    {
        // TODO Renvoyer la liste des séries !

        return $this->render('serie/list.html.twig');
    }

    #[Route('/create', name: 'create', methods: ['POST'])]
    public function create(): Response
    {
        // TODO Creer une serie !

        return $this->render('serie/create.html.twig');
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        // TODO Renvoyer une série !

        return $this->render('serie/show.html.twig');
    }

}
