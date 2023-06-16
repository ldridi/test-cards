<?php

namespace App\Service;

class Cards
{
    public array $results = [];

    public function distribute($numberOfCardsPerGame, $numberOfCardsPerHand): array
    {
        $cards= ['as', 2, 3, 4, 5, 6, 7, 8, 9, 10, 'dame', 'roi', 'valet', 'as'];
        $colors = ['carreau', 'coeur', 'pique', 'trefle'];
        $status = true;

        if($numberOfCardsPerHand * 1 > $numberOfCardsPerGame)
        {
            $status = false;
        }

        $game = range(0, $numberOfCardsPerHand - 1);
        array_splice($cards, 0, 5);

        for($i = 0; $i < count($colors); $i++)
        {
            for($j= 0; $j < count($cards); $j++)
            {
                $game[$i * count($cards) + $j] = $cards[$j].'_'.$colors[$i].'.png';
            }
        }

        shuffle($game);

        $this->results['status'] = $status;
        if($status){
            $this->results['sorted'] = array_splice($game, 0, $numberOfCardsPerHand);
            $this->results['notSorted'] = $game;
        }

        return $this->results;
    }
}