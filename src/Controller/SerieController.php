<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\ORM\EntityManager;
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

    #[Route('/create', name: 'create', methods: ['POST', 'GET'])]
    public function create(EntityManager $entityManager): Response
    {
        // TODO Creer une serie !

        $serie = new Serie();
        $serie = new Serie();
        $serie
            ->setBackdrop('backdrop.png')
            ->setDateCreated(new \DateTime())
            ->setFirstAirDate(new \DateTime('-6 year'))
            ->setName('Stargate SG1')
            ->setGenres('SF')
            ->setLastAirDate(new \DateTime('-3 month'))
            ->setPopularity(5000)
            ->setPoster('poster.png')
            ->setStatus('canceled')
            ->setTmdbId(12345)
            ->setVote(8);

        dump($serie);

        $entityManager->persist($serie);

        return $this->render('serie/create.html.twig');
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        dump($id);

        // TODO Renvoyer une série !

        return $this->render('serie/show.html.twig');
    }

}
