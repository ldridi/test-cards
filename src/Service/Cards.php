<?php

namespace App\Service;

use App\Constant\Contant;

class Cards
{
    public array $results = [];
    private array $game = [];
    private array $cards = Contant::CARDS;
    private array $colors = Contant::COLORS;
    private bool $status = true;

    public function __construct(private $numberOfCardsPerGame, private $numberOfCardsPerHand){}

    public function distribute(): array
    {
        if($this->numberOfCardsPerHand * 1 > $this->numberOfCardsPerGame)
        {
            $this->status = false;
        }

        $this->game = range(0, $this->numberOfCardsPerHand - 1);
        for($i = 0; $i < count($this->colors); $i++)
        {
            for($j= 0; $j < count($this->cards); $j++)
            {
                $this->game[$i * count($this->cards) + $j] = [
                    'card' => $this->cards[$j],
                    'family' => $this->colors[$i],
                    'img' => $this->cards[$j].'_'.$this->colors[$i].Contant::EXTENSIONS
                ];
            }
        }

        $this->display();
        usort($this->results['sorted'], array($this, "order"));
        return $this->status ? $this->results : [];
    }

    /**
     * @return array
     */
    public function display(): array
    {
        shuffle($this->game);

        $this->results['status'] = $this->status;
        if($this->status)
        {
            $this->results['sorted'] = array_splice($this->game, 0, $this->numberOfCardsPerHand);
            $this->results['notSorted'] = $this->game;
        }

        return $this->results;
    }

    /**
     * @param $elem1
     * @param $elem2
     * @return array|int
     */
    public function order($elem1, $elem2): array|int
    {
        $x1 = array_search($elem1["card"], $this->cards);
        $x2 = array_search($elem2["card"], $this->cards);

        $result = $x1 - $x2;
        if ($result == 0)
        {
            $y1 = array_search($elem1["family"], $this->colors);
            $y2 = array_search($elem2["family"], $this->colors);

            return $y1 - $y2;
        }

        return $result;
    }
}

