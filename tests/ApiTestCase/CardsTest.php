<?php

namespace App\Tests\ApiTestCase;

use App\Service\Cards;
use PHPUnit\Framework\TestCase;

final class CardsTest extends TestCase
{
    /**
     * check that the number of cards in the deck is sufficient
     */
    public function testDisponibilityOfCards()
    {
        $card = new Cards();
        $card->distribute(32,
            10
        );

        self::assertTrue($card->results['status']);
    }

    /**
     * check that the number of cards in the deck is not sufficient
     */
    public function testNoDisponibilityOfCards()
    {
        $card = new Cards();
        $card->distribute(32,
            100
        );

        self::assertFalse($card->results['status']);
    }
}