<?php

namespace App\Controller;

use App\Constant\Contant;
use App\Service\Cards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardsController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function __invoke(): Response
    {
        $cards = new Cards(
            Contant::NUMBER_OF_CARDS_PER_GAME,
            Contant::NUMBER_OF_CARDS_PER_HAND
        );
        $cards = $cards->distribute();

        return $this->render('home.html.twig', [
            'results' => $cards
        ]);
    }
}
