<?php

namespace App\Card;
use App\Card\Card;
use App\Card\CardGraphic;

class DeckOfCards 
{   
    // NOTE array is filled with card OBJECTS not string representations
    private $cardDeck = [];
    public $values = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
    public $types = ["Hearts", "Clubs", "Spades", "Diamonds"];

    // choice is if to use cardGraphic or not
    public function __construct($choice)
    {
        $this->initiateCards($choice);
    }

    public function initiateCards($choice): void
    {   
        if ($choice == "standard") {
            foreach ($this->values as $value) {
                foreach ($this->types as $type) {
                    $this->cardDeck[] = new Card($value, $type);
                }
            }
        } elseif ($choice = "graphic") {
            foreach ($this->values as $value) {
                foreach ($this->types as $type) {
                    $this->cardDeck[] = new CardGraphic($value, $type);
                }
            }
        }
    }

    public function getDeck(): array
    {
        return $this->cardDeck;
    }

    public function getDeckCards(): array
    {
        $deck = [];
        foreach ($this->cardDeck as $card) {
            $deck[] = $card->getCard();
        }
        return $deck;
    }
}