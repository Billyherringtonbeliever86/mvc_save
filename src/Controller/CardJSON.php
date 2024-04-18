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

    #[Route("/api/deck/draw", name: "api_deck_draw_random", methods: ['POST'])]
    public function cardDeckApiDrawRandom(
        SessionInterface $session,
        Request $request,
    ): Response
    {
        
        $deck = $session->get("card_deck");
        
            $card = $deck->draw();
            $card = $card->getCard();
        
        $session->set("card_deck", $deck);
        $deck = $deck->getDeckCards();
        $data = [
            "card" => $card,
        ];
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
    
    #[Route("/api/deck/draw/{num<\d+>}", name: "api_deck_draw", methods: ['POST', 'GET'])]
    public function cardDeckApiDraw(
        SessionInterface $session,
        Request $request,
    ): Response
    {
        $num = $request->attributes->get('num');
        $deck = $session->get("card_deck");
        if ($num > count($deck->getDeck())) {
            throw new \Exception("För högt nummer!");
        }
            $card = $deck->draw($num);
            $card = $card->getCard();
        
        $session->set("card_deck", $deck);
        $deck = $deck->getDeckCards();
        $data = [
            "card" => $card,
        ];
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }



    #[Route("/post_bridge", name: "post_bridge", methods: ['POST'])]
    public function yourAction(Request $request)
    {

    $number = $request->request->get('num');

    $actionUrl = $this->generateUrl('api_deck_draw', ['num' => $number]);
    echo $actionUrl;
    return $this->redirect($actionUrl);
    }


}
