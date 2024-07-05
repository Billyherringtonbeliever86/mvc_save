<?php
    class pseudocode { 
        // en  pseudo kod på en initiela rundan som skrev precis efter dealern har givit 2 kort till spelaren.
        public function initialTurn($card1, $card2): string
        {   
            //Kollar om spelaren har blackjack
            if (($card1->value == "ace" || $card2->value == "ace") && ($card1->value == "10" || $card2->value == "10")) {
                return "blackjack";
            }
            //KOlla om spelaren har ett ess i handen för att göra särskilda poäng räkningar.
            if ($card1->value || $card2->value == "ace") {
                $gameRound->initiateAceHand();
            }
            //Kollar om spelaren har råd att göra en doubble eller split ifall dem har det presenteras double valet
            // ifall spelarens kort är av samma värde så presenteras även split valet.
            if ($player->capital >= $bet->value) {
                initiateDoubleOption();
                //Visar spelaren double valet
                if ($card1->value == $card2->value) {
                    initiateSplitOption();
                    // visaer spelaren split valet
                }
            }
            initiateHitOption();
            intitiateStandOption();
        }
    }
?>
