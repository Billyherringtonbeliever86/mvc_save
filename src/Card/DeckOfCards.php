<?php

namespace App\Card;
use App\Card\Card;
use App\Card\CardGraphic;

class DeckOfCards 
{   
    // NOTE cardDeck array is filled with card OBJECTS not string representations
    public $cardDeck = [];
    public $values = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
    public $types = ["Hearts", "Clubs", "Spades", "Diamonds"];

    // choice is if to use cardGraphic or not
    
    public function __construct($choice)
    {
        $this->initiateCards($choice);
    }

    //  initiates and creates all the cards objects and adds them to the this cardDeck array
    public function initiateCards($choice): void
    {   
        if ($choice == "standard") {
            $i = 0;
            foreach ($this->values as $value) {
                foreach ($this->types as $type) {
                    $this->cardDeck[] = new Card($value, $type, $i, $i);
                    $i++;
                }
            }
        } elseif ($choice = "graphic") {
            $i = 0;
            foreach ($this->values as $value) {
                foreach ($this->types as $type) {
                    $this->cardDeck[] = new CardGraphic($value, $type, $i, $i);
                    $i++;
                }
            }
        }
    }

    //  returns the cardDeck array
    public function getDeck(): array
    {
        return $this->cardDeck;
    }

    //  returns and deck array with all the card respresented as strings in an array;
    public function getDeckCards(): array
    {
        $deck = [];
        foreach ($this->cardDeck as $card) {
            $deck[] = $card->getCard();
        }
        return $deck;
    }

    // sorts the this cardDeck array based on the individuals card object sortIndex number
    public function sortDeck(): void 
    {
        $sortedDeck = [];
        foreach ($this->cardDeck as $card) {
            $position = $card->getSortIndex();
            $card->setPosition($position);
            $sortedDeck[$position] = $card;
            
        }
        ksort($sortedDeck);
        $this->cardDeck = $sortedDeck;
    }

    // fixes the cardDecks card ibject index position and every Card object internal index variable to the same and 
    // reasures no numbers are skipped in the deck for example when a card has been drawn.
    // also fixes so cards always are displayed in the cardDeck index order as is most logical.
    public function arrangeDeck(): void 
    {   
        // echo "arange";
        $arrangedDeck = [];
        $i = 0;
        foreach ($this->cardDeck as $card) {
            $card->setPosition($i);
            $arrangedDeck[$i] = $card;
            $i++;
        }
        $this->cardDeck = $arrangedDeck;
    }

    // draws and removes and returns a card.
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

    // shuffles the this cardDeck array and then arranges it so card->index mathes cardDeck array index position
    public function shuffle(): void 
    {
        shuffle($this->cardDeck);
        $this->arrangeDeck();
    }
}