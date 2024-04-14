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

    public function __construct()
    {
        parent::__construct();
    }

    public function getType(): string
    {
        return $this->representation[$this->type];
    }
}