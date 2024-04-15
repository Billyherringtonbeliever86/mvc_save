<?php

namespace App\Card;

class Card
{
    protected $card;
    protected $type;
    public $values = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
    public $types = ["Hearts", "Clubs", "Spades", "Diamonds"];

    public function __construct($value = null, $type = null)
    {
        if (!($value && $type)) {
            $this->card = null;
        } else {
            $this->card = "$type " . "$value";
            $this->type = $type;
        }
    }

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

    public function getType(): string 
    {
        return $this->type;
    }

}