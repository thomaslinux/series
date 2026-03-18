<?php

namespace App\Controller\Api;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/series', name: 'api_series_')]
final class SerieController extends AbstractController
{
    #[Route('', name: 'retrieve_all', methods: 'GET')]
    public function retrieveAll(
        SerieRepository     $serieRepository,
        SerializerInterface $serializer
    ): Response
    {
        // TODO renvoyer toutes les séries au format json
        $series = $serieRepository->findAll();
//        dd($serializer->serialize($series, 'json', ['groups' => 'serie-api']));

        return $this->json($series, Response::HTTP_OK, [], ['groups' => 'serie-api']);
    }

    #[Route('/{id}', name: 'retrieve_one', methods: 'GET')]
    public function retrieveOne(
        int             $id,
        SerieRepository $serieRepository
    ): Response
    {
        // TODO renvoyer une série au format json
        $serie = $serieRepository->find($id);
        return $this->json($serie, Response::HTTP_OK, [], ['groups' => 'serie-api']);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id): Response
    {
        // TODO supprimer une série
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(
        SerializerInterface    $serializer,
        EntityManagerInterface $entityManager,
        Request                $request,
        ValidatorInterface     $validator
    ): Response
    {
        $json = $request->getContent();
        $serie = $serializer->deserialize($json, Serie::class, 'json');

        //validation des données, comme un formulaire
        $errors = $validator->validate($serie);

        $entityManager->persist($serie);
        $entityManager->flush();

        return $this->json($serie, Response::HTTP_CREATED, [], ['groups' => 'serie-api']);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(
        int                    $id,
        SerieRepository        $serieRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        // TODO supprimer une série
        $serie = $serieRepository->find($id);
        $entityManager->remove($serie);
        $entityManager->flush();

        return $this->json(['success' => 'Serie deleted'], Response::HTTP_ACCEPTED);
    }

}

