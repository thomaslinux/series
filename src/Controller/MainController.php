<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        dd("coucou");

    }

    #[Route('/test', name: 'main_test')]
    public function test(): Response
    {
        dd("Hello World!");

    }
}
