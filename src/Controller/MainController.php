<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Date;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/test', name: 'main_test')]
    public function test(SerializerInterface $serializer): Response
    {
        $serie = ['name' => 'Dragon Ball Z', 'author' => 'Toriyamaha', 'nbEpisode' => 291];

        $username = '<h1>Sylvain</h1>';

        $joke = file_get_contents("https://api.chucknorris.io/jokes/random");
//        $joke = (json_decode($joke, true));
//        dump($joke['value']);

        $serializer->deserialize($joke, \stdClass::class, 'json');

        return $this->render('main/test.html.twig', [
            'mySerie' => $serie,
            'date' => new \DateTime(),
            'username' => $username
        ]);
    }

    public function create(Request $request, EntityManagerInterface $em)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $this->addFlash('success', 'Article inséré avec succès');
            return $this->redirectToRoute('blog_front_homepage');
        }

        return $this->render("front/homepage.html.twig", ['form' => $form]);
    }

}
