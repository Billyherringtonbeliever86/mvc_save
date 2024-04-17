<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;

class CardJSON extends AbstractController
{
    #[Route("/api/deck", name: "api_deck", methods: ['GET'])]
    public function cardDeckApi(
        SessionInterface $session,
    ): Response
    {
        $deck = $session->get("card_deck");
        $deck->sortDeck();
        $session->set("card_deck", $deck);
        $deck = $deck->getDeckCards();
        $data = [
            "card_deck" => $deck,
        ];
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_deck_shuffle", methods: ['POST'])]
    public function cardDeckApiShuffle(
        SessionInterface $session,
    ): Response
    {
        $deck = $session->get("card_deck");
        $deck->shuffle();
        $session->set("card_deck", $deck);
        $deck = $deck->getDeckCards();
        $data = [
            "card_deck" => $deck,
        ];
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
