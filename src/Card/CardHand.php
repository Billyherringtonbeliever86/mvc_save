<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    private $hand = [];

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function deal(): void
    {
        foreach ($this->hand as $card) {
            $card->deal();
        }
    }

    public function getNumberCards(): int
    {
        return count($this->hand);
    }

    public function getCards(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getCard();
        }
        return $values;
    }
}
