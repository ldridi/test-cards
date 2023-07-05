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
        $card = new Cards(32, 10);
        $card->distribute();
        self::assertTrue($card->results['status']);
    }

    /**
     * check that the number of cards in the deck is not sufficient
     */
    public function testNoDisponibilityOfCards()
    {
        $card = new Cards(32, 100);
        $card->distribute();
        self::assertFalse($card->results['status']);
    }
}