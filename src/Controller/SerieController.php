<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('series', name: 'series_')]
final class SerieController extends AbstractController
{
    #[Route('/{page}', name: 'list', requirements: ['page' => '\d+'])]
    public function list(SerieRepository $serieRepository, int $page = 1): Response
    {
//        $series = $serieRepository->findAll();
//        $series = $serieRepository->findBy([], ['popularity' => 'DESC'], 25, 25);
//        $series = $serieRepository->findOneBy();

        $nbSeries = $serieRepository->count();
        $maxPage = ceil($nbSeries / 50);

        if ($page > $maxPage) {
            throw $this->createNotFoundException("You scrolled too far and reached the end of Internet");
        }

        if ($page < 1) {
            return $this->redirectToRoute('series_list', ['page' => 1]);
        }

        $series = $serieRepository->findBestSeries($page);

        return $this->render('serie/list.html.twig', [
            'series' => $series,
            'currentPage' => $page,
            'maxPage' => $maxPage
        ]);
    }

    /**
     * @throws ORMException
     */
    #[Route('/create', name: 'create', methods: ['POST', 'GET'])]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $serie = new Serie();
        $serieForm = $this->createForm(SerieType::class, $serie);

        // extraction des données de la requête pour injection dans l'instance de l'entité
        $serieForm->handleRequest($request);

        if ($serieForm->isSubmitted()) {

            dd($serie);

            //traitement des données
            $entityManager->persist($serie);
            $entityManager->flush();

            return $this->redirectToRoute('series_show', ['id' => $serie->getId()]);
        }

        return $this->render('serie/create.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }

    #[Route('/details/{id}', name: 'show', requirements: ['id' => '\d+'])]
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
