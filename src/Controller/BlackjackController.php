<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Card\Card;
use App\Card\CardHand;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;

class BlackjackController extends AbstractController
{
    #[Route("/game", name: "blackjack")]
    public function blackjack(): Response
    {
        $cardDeck = new DeckOfCards("graphic");
        
        return $this->render('/blackjack/game.html.twig');
    }

    #[Route("/game/doc", name: "blackjackdoc")]
    public function blackjackDocumentation(): Response
    {
        return $this->render('/blackjack/doc.html.twig');
    }

}
