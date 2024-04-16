<?php

namespace App\Card;
use App\Card\Card;
use App\Card\CardGraphic;

class DeckOfCards 
{   
    // NOTE array is filled with card OBJECTS not string representations
    public $cardDeck = [];
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
            $i = 0;
            foreach ($this->values as $value) {
                foreach ($this->types as $type) {
                    $this->cardDeck[] = new Card($value, $type, $i);
                    $i++;
                }
            }
        } elseif ($choice = "graphic") {
            $i = 0;
            foreach ($this->values as $value) {
                foreach ($this->types as $type) {
                    $this->cardDeck[] = new CardGraphic($value, $type, $i);
                    $i++;
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

    public function sortDeck(): void 
    {
        $sortedDeck = [];
        foreach ($this->cardDeck as $card) {
            $position = $card->getPosition();
            $sortedDeck[$position] = $card;

        }
        ksort($sortedDeck);
        $this->cardDeck = $sortedDeck;
    }

    public function arrangeDeck(): void 
    {   
        echo "arange";
        $arrangedDeck = [];
        $i = 0;
        foreach ($this->cardDeck as $card) {
            $card->setPosition($i);
            $arrangedDeck[$i] = $card;
            $i++;
        }
        $this->cardDeck = $arrangedDeck;
    }

    public function draw($position=null): object 
    {
        if ($position == null) {
            $position = random_int(1, count($this->cardDeck));
        }
        $position = $position -1;
        $card =  $this->cardDeck[$position];
        unset($this->cardDeck[$position]);
        $this->arrangeDeck();
        return $card;
    }   
}