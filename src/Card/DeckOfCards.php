<?php

namespace App\Card;
use App\Card\Card;

class DeckOfCards 
{
    private $cardDeck = [];
    public $values = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
    public $types = ["Hearts", "Clubs", "Spades", "Diamonds"];

    public function __construct()
    {
        $this->initiateCards();
    }

    public function initiateCards(): void
    {   
        foreach ($this->values as $value) {
            foreach ($this->types as $type) {
                $this->cardDeck[] = new Card($value, $type);
            }
        }
    }

    public function getDeck(): array
    {
        return $this->cardDeck;
    }
}