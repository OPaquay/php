<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Devenir un bleu</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link href='https://fonts.googleapis.com/css?family=Quicksand:400,700,300' rel='stylesheet' type='text/css'>
        <?php
            include('opengraph.inc.php');
        ?>
    </head>
    <body>
       
        <div class="feedback">
        <?php

            if(count($_POST) > 0) {
    
                //1. Honeypot
        
                if($_POST['surnom'] != ''){
                die("Tu sors !");
                }
        
                //2. Nettoyage
        
                $nom = trim(strip_tags($_POST['nom']));
                $email = trim(strip_tags($_POST['email']));
                $naissance = ($_POST['naissance']);
                $adresse = trim(strip_tags($_POST['adresse']));
                $commune = trim(strip_tags($_POST['commune']));
                $pourquoi = ($_POST['pourquoi']);
        
                //3. Validation
        
                $errors = 0;
                
                function is_valid_email($email){
                    return filter_var($email, FILTER_VALIDATE_EMAIL);
                }
                
                function is_date_valid($naissance) {
                    return (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $naissance));
                }
        
                if($nom == ''){
                    echo '<p>Désolé mais il semblerait que vous ayez oublié d\'entrer votre nom.</p>';
                    $errors += 1;
                }
        
                if(is_valid_email($email) == false){
                    echo '<p>Désolé mais il semblerait que vous ayez oublié d\'entrer votre adresse email ou que celle-ci soit incorrecte.</p>';
                    $errors += 1;
                }
                
                if(is_date_valid($naissance) == false){
                    echo '<p>Désolé mais il semblerait que le format de la date ne soit pas correct, ou que vous ne l\'ayez pas rempli</p>';
                    $errors += 1;
                }
                
                if($pourquoi == ''){
                    echo '<p>Désolé mais il semblerait que vous ayez oublié de répondre à la question</p>';
                    $errors += 1;
                }
                
                if($errors == 0) {
                    $contenu_mail = 'Destinateur : ' . $nom . ' Email du destinateur : ' . $email . ' Date de naissance ' . $naissance . ' Adresse : ' . $adresse . ' Commune : ' . $commune . ' Pourquoi veut-il devenir un bleu ? : ' . $pourquoi;
                    mail('olivia.paquay@gmail.com', 'Inscription cercle ESIAJ', $contenu_mail);
                    die ('Merci, votre message a été correctement envoyé.');
            }
        
        
            }

        ?>
        </div>
        
        <h1>Formulaire d'inscription au Cercle de l'ESIAJ</h1>
        <form method="POST" name="contact">
          
            <label class="surnom" for="surnom">Surnom :</label>
            <input class="surnom" type="text" id="surnom" name="surnom" value="" placeholder="Surnom"/>
           
            <label class="obligatoire" for="nom">Prénom et nom :</label>
            <input type="text" id="nom" name="nom" <?php if($nom != ''){ echo 'value="'. $nom .'"'; } ?> placeholder="Prénom Nom"/>
            
            <label class="obligatoire" for="email">Email :</label>
            <input type="text" id="email" name="email" <?php if($email != ''){ echo 'value="'. $email .'"'; } ?> placeholder="exemple@mail.com"/>
            
            <label class="obligatoire" for="naissance">Date de naissance :</label>
            <input type="date" id="naissance" name="naissance" <?php if($naissance != ''){ echo 'value="'. $naissance .'"'; } ?>/>
            
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" <?php if($adresse != ''){ echo 'value="'. $adresse .'"'; } ?>/>
            
            <label for="commune">Commune :</label>
            <input type="text" id="commune" name="commune" <?php if($commune != ''){ echo 'value="'. $commune .'"'; } ?>/>
            
            <label class="obligatoire" for="pourquoi">
                Pourquoi souhaites-tu devenir un "bleu", qu'espères-tu ?
                <br>
                <input type="radio" name="pourquoi" id="roi" value="roi" <?php if($pourquoi == 'roi'){ echo 'checked="checked"'; } ?>/>Devenir le roi des bleus
                <br>
                <input type="radio" name="pourquoi" id="amis" value="amis" <?php if($pourquoi == 'amis'){ echo 'checked="checked"'; } ?>/>Me faire plein d'amis
                <br>
                <input type="radio" name="pourquoi" id="fete" value="fete" <?php if($pourquoi == 'fete'){ echo 'checked="checked"'; } ?>/>Faire la fête
                <br>
                <input type="radio" name="pourquoi" id="reussir" value="reussir" <?php if($pourquoi == 'reussir'){ echo 'checked="checked"'; } ?>/>Réussir mon année
            </label>
            
            <input id="envoi" type="submit" value="Envoyer"/>
        </form>
        <a class="github" href="http://github.com/OliviaPaquay/PHP/cercle">Github</a>
    </body>
</html>