<?php

namespace App\Card;

class Card
{   
    // sortIndex = the cards position when being sorted, is not changable.
    // index = the cards internal index value in the deck stored in the card, is changable.
    // both variablesabove are only relative when used in another class like DeckOfCards or CardHand.
    protected $card;
    protected $type;
    protected $value;
    protected $sortIndex;
    protected $index;
    public $values = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
    public $types = ["Hearts", "Clubs", "Spades", "Diamonds"];

    public function __construct($value = null, $type = null, $index = null, $sortIndex = null)
    {
        if (!($value && $type)) {
            $this->card = null;
        } else {
            $this->card = "$type " . "$value";
            $this->type = $type;
            $this->value = $value;
            $this->index = $index;
            $this->sortIndex = $sortIndex;
        }
    }

    // initiates values to an empty card object and returns itself.
    public function deal(): string
    {
        $type = $this->types[random_int(0, 3)];
        $value= $this->values[random_int(0, count($this->values) - 1)];
        $this->card = "$type " . "$value";
        $this->type = $type;
        return $this->card;
    }

    public function getCard(): string
    {
        return $this->card;
    }

    public function getValue(): string 
    {
        return $this->value;
    }

    public function getType(): string 
    {
        return $this->type;
    }

    public function getPosition(): int
    {
        return $this->index;
    }

    public function setPosition($position): void
    {
        $this->index=$position;
    } 

    public function getSortIndex(): int
    {
        return $this->sortIndex;
    }

}