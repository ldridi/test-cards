<?php

namespace App\Controller;

use App\Constant\Contant;
use App\Service\Cards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CardsController extends AbstractController
{
    public function __construct(Protected Cards $cards){}

    #[Route('/', name: 'app_home')]
    public function home(){
        $cards = $this->cards->distribute(
            Contant::NUMBER_OF_CARDS_PER_GAME,
            Contant::NUMBER_OF_CARDS_PER_HAND
        );
;
        return $this->render('home.html.twig', [
            'results' =>$cards
        ]);
    }
}
