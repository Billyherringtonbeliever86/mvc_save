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

Class CardDeckController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function session(
        SessionInterface $session
    ): Response
    {
        $sessionData = $session->getBag('attributes');
        // print_r($sessionData);
        $sessionArray = [];
        $sessionArray["pig_total"] = ($sessionData->get('pig_total'));
        $sessionArray["pig_dices"] = ($sessionData->get('pig_dices'));
        $sessionArray["pig_round"] = ($sessionData->get('pig_round'));
        $sessionArray["card_deck"] = ($sessionData->get('card_deck'));

        return $this->render('session.html.twig', [
            'sessionArray' => $sessionArray,
        ]);
    }

    #[Route("/session/delete", name: "session_delete")]
    public function sessionDelete(
        SessionInterface $session
    ): Response
    {
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
    ): Response
        
    {

        $card = new Card();
        $card->deal();
        echo $card->getCard();
        echo "<br>";
        $card2 = new CardGraphic();
        $card2->deal();
        echo $card2->getType(), $card2->getCard();
        echo "<br>";

        $hand = new CardHand();
        $hand->add($card);
        $hand->add($card2);
        echo "cards hand ";
        var_dump($hand->getCards());
        echo"<br>";
        $card3 = new Card("4", "Hearts");
        echo $card3->getCard();
        echo "<br>";
        $data = [

        ];
        $deck = $session->get('card_deck');
        // var_dump($deck);
        return $this->render('card/card.html.twig', $data);
    }

    #[Route("/card/init", name: "card_init")]
    public function cardInit(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $cardDeck = new DeckOfCards("graphic");
        $session->set("card_deck", $cardDeck);


        return $this->redirectToRoute('card');
    }


    #[Route("/card/deck", name: "card_deck")]
    public function cardDeck(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $data = [
            "card_deck" => ($session->get('card_deck')),
        ];
        // var_dump($data["card_deck"]);
        return $this->render('card/card_deck.html.twig', $data);
    }
}