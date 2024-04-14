<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Card\Card;
use App\Card\CardGraphic;

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
    public function card(): Response
    {
        $card = new Card();
        $card->deal();
        echo $card->getCard();
        $card2 = new CardGraphic();
        $card2->deal();
        echo $card2->getType(), $card2->getCard();
        return $this->render('card/card.html.twig');
    }

}