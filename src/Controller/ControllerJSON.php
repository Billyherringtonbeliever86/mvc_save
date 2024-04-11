<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ControllerJSON extends AbstractController
{
    #[Route("/api")]
    public function apis(): Response
    {
        return $this->render('apis.html.twig');
    }

    #[Route("/api/qoute")]
    public function jsonQoute(): Response
    {
        $number = random_int(0, 2);
        $qoutes = [
            "I have the high ground Anakin",
            "Whats in the car? Seats and Steering Wheel",
            "Ariel listen to me the human world is a mess, life under the sea is better than anything they got up there"
        ];
        $datum = date('Y-m-d H:i:s');

        $qoute = $qoutes[$number];
        $data = [
            "Dagens citat" => $qoute,
            "Dagens datum och tid av genererat svar" => $datum,

        ];


        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;    }
}

