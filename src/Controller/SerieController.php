<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('series', name: 'series_')]
final class SerieController extends AbstractController
{
    #[Route('/{page}', name: 'list')]
    public function list(int $page = 1, SerieRepository $serieRepository): Response
    {
//        $series = $serieRepository->findAll();
//        $series = $serieRepository->findBy([], ['popularity' => 'DESC'], 25, 25);

        $series = $serieRepository->findBestSeries();

        return $this->render('serie/list.html.twig', [
            'series' => $series
        ]);
    }

    /**
     * @throws ORMException
     */
    #[Route('/create', name: 'create', methods: ['POST', 'GET'])]
    public function create(EntityManagerInterface $entityManager): Response
    {
        // TODO Creer une serie !

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
        $entityManager->flush();

        dump($serie);

        $serie->setName('Code Quantum');
        $entityManager->persist($serie);
        $entityManager->flush();

        $entityManager->remove($serie);
        $entityManager->flush();

        return $this->render('serie/create.html.twig');
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function show(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);

        if (!$serie) {
            throw $this->createNotFoundException("Oops ! Serie not found");
        }

        return $this->render('serie/show.html.twig', [
            'serie' => $serie
        ]);
    }

}
