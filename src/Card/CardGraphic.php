<?php

namespace App\Card;

class CardGraphic extends Card
{
    private $representation = [
        "Diamonds" => '♦',
        "Hearts" => '♥',
        "Spades" => '♠',
        "Clubs" => '♣'
    ];

    public function __construct($value = null, $type = null, $index = null, $sortIndex = null)
    {
        parent::__construct($value, $type, $index, $sortIndex);
    }

    public function getType(): string
    {
        return $this->representation[$this->type];
    }
}
