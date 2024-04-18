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

class CardDeckController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function session(
        SessionInterface $session
    ): Response {
        $sessionData = $session->getBag('attributes');
        // print_r($sessionData);
        $sessionArray = [];
        $sessionArray["pig_total"] = ($sessionData->get('pig_total'));
        $sessionArray["pig_dices"] = ($sessionData->get('pig_dices'));
        $sessionArray["pig_round"] = ($sessionData->get('pig_round'));
        $sessionArray["card_deck"] = ($sessionData->get('card_deck'));
        $sessionArray["drawn_cards"] = ($sessionData->get('drawn_cards'));


        return $this->render('session.html.twig', [
            'sessionArray' => $sessionArray,
        ]);
    }

    #[Route("/session/delete", name: "session_delete")]
    public function sessionDelete(
        SessionInterface $session
    ): Response {
        $session->clear();
        $this->addFlash(
            'notice',
            'Session is cleared'
        );
        return $this->redirectToRoute('session');
    }

    #[Route("/card", name: "card")]
    public function card(
        SessionInterface $session
    ): Response {
        return $this->render('card/card.html.twig');
    }

    #[Route("/card/init", name: "card_init")]
    public function cardInit(
        Request $request,
        SessionInterface $session
    ): Response {
        $cardDeck = new DeckOfCards("graphic");
        $session->set("card_deck", $cardDeck);
        $session->set("drawn_cards", []);


        return $this->redirectToRoute('card');
    }


    #[Route("/card/deck", name: "card_deck")]
    public function cardDeck(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = $session->get('card_deck');
        $deck->sortDeck();
        $deck->arrangeDeck();
        $session->set("card_deck", $deck);

        $data = [
            "card_deck" => ($session->get('card_deck')),
        ];

        return $this->render('card/card_deck.html.twig', $data);
    }

    #[Route("/card/display", name: "card_display")]
    public function cardDisplay(
        Request $request,
        SessionInterface $session
    ): Response {
        $data = [
            "card_deck" => ($session->get('card_deck')),
        ];

        return $this->render('card/card_deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "card_deck_shuffle")]
    public function cardDeckShuffle(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = $session->get('card_deck');
        // shuffle($deck->cardDeck);
        // $deck->arrangeDeck();
        $deck->shuffle();
        $session->set("card_deck", $deck);
        $data = [
            "card_deck" => ($session->get('card_deck')),
        ];

        return $this->render('card/card_deck.html.twig', $data);
    }

    #[Route("/card/deck/draw/", name: "card_deck_draw")]
    public function cardDeckDraw(
        Request $request,
        SessionInterface $session
    ): Response {

        $deck = $session->get('card_deck');
        $card = $deck->draw();
        $drawnCards = $session->get('drawn_cards');
        $drawnCards[] = $card;
        $session->set("drawn_cards", $drawnCards);
        $session->set("card_deck", $deck);
        $data = [
            "card_draw" => $card,
            "card_deck" => ($session->get('card_deck')),
        ];

        return $this->render('card/card_deck_draw.html.twig', $data);
    }


    #[Route("/card/deck/draw/{num<\d+>}", name: "card_deck_draw_number")]
    public function cardDeckDrawNumber(
        int $num,
        Request $request,
        SessionInterface $session
    ): Response {

        $deck = $session->get('card_deck');
        if ($num > count($deck->getDeck())) {
            throw new \Exception("För högt nummer!");
        }

        $i = 0;
        $drawnCards = [];
        while ($i < $num) {
            $card = $deck->draw();
            $drawnCards[] = $card;
            $i++;
        }

        $drawnCardsOld = $session->get('drawn_cards');
        $allDrawnCards = array_merge($drawnCards, $drawnCardsOld);
        $session->set("drawn_cards", $allDrawnCards);
        $session->set("card_deck", $deck);
        $data = [
            "card_draw" => $drawnCards,
            "card_deck" => ($session->get('card_deck')),
        ];

        return $this->render('card/card_deck_draw_num.html.twig', $data);
    }

    #[Route("/card/display_drawn", name: "drawn_display")]
    public function drawnDisplay(
        Request $request,
        SessionInterface $session
    ): Response {
        $data = [
            "card_deck" => ($session->get('drawn_cards')),
        ];

        return $this->render('card/drawn_display.html.twig', $data);
    }


}
