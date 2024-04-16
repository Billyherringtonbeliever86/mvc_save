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

    public function __construct($value = null, $type = null)
    {
        parent::__construct($value, $type);
    }

    public function getType(): string
    {
        return $this->representation[$this->type];
    }
}