<?php
    function reponse_voiture($ce_soir, $permis, $bu, $essence, $soeur, $prudente){
        
        //Execute la fonction seulement si le formulaire est envoyé
        if(isset($_GET['envoi'])) {
            
            //Vérifie que l'utilisateur répond à toutes les questions
            if(isset($ce_soir) && isset($permis) && isset($bu) && isset($essence) && isset($soeur) && isset($prudente)) {
                
                //enregistre le nombre de réponses dans une variable
                $num_reponses = func_num_args();
                //enregistre les réponses dans un tableau
                $reponses = func_get_args();
                
                //transforme les réponses en variables booléennes
                for ($i = 0; $i < $num_reponses; $i++) {
                    if ($reponses[$i] == "oui"){
                        $reponses[$i] = true;
                    }
                    else if ($reponses[$i] == "non"){
                        $reponses[$i] = false;
                    }
                }
                
                //Vérifie les réponses données et affiche la réponse du papa
                if ($reponses[0] == true && $reponses[1] == true && $reponses[2] == false && $reponses[3] == true && $reponses[4] == true && $reponses[5] == true) {
                    //Bonne combinaison
                    return '<div class="feedback"><p class="reponse">C\'est bon je te la passe</p></div>';
                }
                else if($reponses[0] == false && $reponses[1] == true && $reponses[2] == false && $reponses[3] == true && $reponses[4] == true && $reponses[5] == true) {
                    //Combinaison se négocie
                    return '<div class="feedback"><p class="reponse">Ok, mais tu me la ramènes demain matin avant 10h alors ?</p></div>';
                }
                else {
                    return '<div class="feedback"><p class="reponse">Alors c\'est non !</p></div>';
                }
            }

            else {
                return '<div class="feedback"><p class="reponse">Tu n\'as pas répondu à toutes les questions !</p></div>';
                //Retourne un message d'erreur
            }
        };
    };
?>
   

<html lang="fr">
    <head>
        <meta charset="utf-8"></meta-charset>
        <link rel="stylesheet" type="text/css" href="styles2.css"/>
    </head>
    <body <?php 
        if(reponse_voiture($_GET['ce_soir'], $_GET['permis'], $_GET['bu'], $_GET['essence'], $_GET['soeur'], $_GET['prudente']) == '<div class="feedback"><p class="reponse">C\'est bon je te la passe</p></div>') { 
            echo 'class="voiture"';
        }
        else if (reponse_voiture($_GET['ce_soir'], $_GET['permis'], $_GET['bu'], $_GET['essence'], $_GET['soeur'], $_GET['prudente']) == '<div class="feedback"><p class="reponse">Ok, mais tu me la ramènes demain matin avant 10h alors ?</p></div>') {
            echo 'class="horloge"';
        }
        else if (reponse_voiture($_GET['ce_soir'], $_GET['permis'], $_GET['bu'], $_GET['essence'], $_GET['soeur'], $_GET['prudente']) == '<div class="feedback"><p class="reponse">Alors c\'est non !</p></div>') {
            echo 'class="velo"';
        }
    ?>>
        <form method="GET" name="voiture_papa" class="voiture_papa">
            <label for="ce_soir">
                Tu la ramènes ce soir ?
                <br>
                <input type="radio" name="ce_soir" value="oui" <?php if($_GET['ce_soir']=='oui'){ echo 'checked="checked"';} ?>/> Oui
                <input type="radio" name="ce_soir" value="non" <?php if($_GET['ce_soir']=='non'){ echo 'checked="checked"';} ?>/> Non
            </label>
            
            <label for="permis">
                T'as ton permis ?
                <br>
                <input type="radio" name="permis" value="oui" <?php if($_GET['permis']=='oui'){ echo 'checked="checked"';} ?>/> Oui
                <input type="radio" name="permis" value="non" <?php if($_GET['permis']=='non'){ echo 'checked="checked"';} ?>/> Non
            </label>
            
            <label for="bu">
                T'as bu ?
                <br>
                <input type="radio" name="bu" value="oui" <?php if($_GET['bu']=='oui'){ echo 'checked="checked"';} ?>/> Oui
                <input type="radio" name="bu" value="non" <?php if($_GET['bu']=='non'){ echo 'checked="checked"';} ?>/> Non
            </label>
            
            <label for="essence">
                Tu paie le carburant ?
                <br>
                <input type="radio" name="essence" value="oui" <?php if($_GET['essence']=='oui'){ echo 'checked="checked"';} ?>/> Oui
                <input type="radio" name="essence" value="non" <?php if($_GET['essence']=='non'){ echo 'checked="checked"';} ?>/> Non
            </label>
            
            <label for="soeur">
                Tu vas chercher ta soeur alors ?
                <br>
                <input type="radio" name="soeur" value="oui" <?php if($_GET['soeur']=='oui'){ echo 'checked="checked"';} ?>/> Oui
                <input type="radio" name="soeur" value="non" <?php if($_GET['soeur']=='non'){ echo 'checked="checked"';} ?>/> Non
            </label>
            
            <label for="prudente">
                Tu seras prudente hein ?
                <br>
                <input type="radio" name="prudente" value="oui" <?php if($_GET['prudente']=='oui'){ echo 'checked="checked"';} ?>/> Oui
                <input type="radio" name="prudente" value="non" <?php if($_GET['prudente']=='non'){ echo 'checked="checked"';} ?>/> Non
            </label>
            
            <input id="envoi" name="envoi" type="submit" value="Soumettre"/>
        </form>
        
        
        <?php
            if(isset($_GET['envoi'])) {
                echo reponse_voiture($_GET['ce_soir'], $_GET['permis'], $_GET['bu'], $_GET['essence'], $_GET['soeur'], $_GET['prudente']);
            }
        ?>
        
        <a class="github" href="https://github.com/OliviaPaquay/php/tree/master/voiture-papa">Github</a>
            
    </body>
</html>

