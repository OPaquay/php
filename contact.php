<?php
/*
	MON PREMIER FORMULAIRE DE CONTACT EN PHP.
	
	auteur: alexandre AT pixeline.be (le script fonctionne. Aucun support n'est fourni, cherche sur internet)
	pour: étudiants DWM
	version: 03.02.2013
	
*/


// POUR VERIFIER CE QU'ENVOIE TON FORMULAIRE, DECOMMENTE LES LIGNES SUIVANTES: (décommenter = enlever les double-slash // et/ou les /* et */ )


/*echo '<pre>';
print_r($_SERVER);
echo '</pre>';
exit;*/


// touche pas à ceci
$config = array();

/*
:::::::::::   INSTRUCTIONS    :::::::::::

1.// Dans ton formulaire html, utiliser les champs aux attributs name= "message", "nom", "courriel"
Ces 3 champs seront vérifiés pour validation.

Tout autre champs sera ajouté, sans vérification.


2.// changer les valeurs des variables ci-dessous.
*/

$config['email']= 'olivia.paquay@gmail.com';
$config['sujet']= "Formulaire TFA";
$config['page_merci']= 'contact.php';
// Messages d'erreur
$config['no_name']="Veuillez indiquer votre nom";
$config['no_email']="Veuillez indiquer votre adresse email";
$config['wrong_email']="Votre adresse email semble être incorrecte. Veuillez corriger svp.";
$config['no_message']= "Veuillez indiquer votre message";


// NE RIEN TOUCHER CI-DESSOUS
$errors= array();

if(isset($_POST) && count($_POST)>0){

	if(!strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])){
		// si la requête ne vient pas de ce serveur, l'interrompre, quelqu'un tente de l'utiliser pour envoyer du spam.
		die("you should'nt be here.");
	}
	
	
	$nom = trim($_POST['nom']);
	$email = trim($_POST['courriel']);
	$message = trim($_POST['message']);


	if(empty($nom)){
		// Le nom a-t-il bien été introduit?
		$errors[]=  $config['no_name'];
	}

	if(empty($message)){
		// Le message a-t-il bien été introduit?
		$errors[]= $config['no_message'];
	}

	if(empty($email)){
		// L'adresse email a-t-elle bien été encodée?
		$errors[]= $config['no_email'];
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// l'adresse email est-elle valide?
		$errors[]= $config['wrong_email'];
	}



	if(count($errors)<1){

		$message= "$nom ($email) a écrit: \n\r$message";
		
		foreach ($_POST as $k=>$v){
			if (!in_array($k, array('nom','courriel','message'))){
			if(is_array($v)){
				$message.="\n\r$k = ".implode(',', $v);
			}else{
				$message.="\n\r$k = $v";
			}
			}
		}

		$message = wordwrap($message, 70, "\r\n");
		// send the email
		if(empty($config['email'])){
			die("tu as oublié d'encoder l'adresse email, banane. (regarde pour config['email']) dans le code php");
		}
		mail($config['email'], $config['sujet'], $message);
		// redirect to thank you page
		header("Location: ".$config['page_merci']);
		exit;
	}
}
// OK, A PARTIR D'ICI TU PEUX TOUCHER...

// TOUT TON CODE HTML VA CI-DESSOUS
?>


<!DOCTYPE html> <!--version html-->
<html lang="fr"> <!--langue et balise html-->

	<head>

			<title>Contact - Olivia Paquay</title>
			<meta charset="UTF-8"/> <!--caractère d'encodage-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="css/style.css">
			<link href='http://fonts.googleapis.com/css?family=Overlock:400,700' rel='stylesheet' type='text/css'>
			<link href="js/hugrid.css" type="text/css" rel="stylesheet"/>
			<script src="js/main.js"></script>
			<script src="js/jquery-1.6.2.min.js"></script>
			<script src="js/hugrid.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {
					pageUnits = 'px';
        			colUnits = 'px';
        			pagewidth = 1107;
        			columns = 8;
        			columnwidth = 113;
        			gutterwidth = 29;
        			pagetopmargin = 29;
        			rowheight = 29;
        			gridonload = 'off';
        			makehugrid();
        			setgridonload();
				});
			</script>
		
	</head>

	<body>
		
		<?php
		// if form has been submitted, show the errors
		if($_POST && count($errors)>0){
		?>
			<div id="feedback">
			<p>Oups, je n'ai pas bien compris votre message. Pourriez-vous modifier les points suivants? </p>
			<ul>
			<?php
			foreach($errors as $e){
				echo "<li>$e</li>";
			}
		?>
			</ul>
			</div>
			<?php
		}
		?>

		<div id="container">

			<header>
				<a href="index.html"><h1><img src="img/name.png" alt="Olivia Paquay"/></h1></a>

				<nav id="menu">
					<ul>
						<li><a href="index.html">À propos</a></li>
						<li><a href="travaux.html">Travaux</a></li>
						<li><a class="active" href="contact.php">Contact</a></li>
					</ul>
				</nav>
			</header>

			<main>

				<h2>Contact</h2>
				<div class="underline" id="contact"></div>

				<form action="" method="post" name="contact">
		            <fieldset>
		                <p>
			                <label for="nom">Dites moi d'abord qui vous êtes :</label>
							<input type="text" id="nom" name="nom" value="<?php echo ($nom!='') ? $nom: '' ?>" placeholder="Prénom Nom"/>
			            </p>
			            <p>
			                <label for="courriel">A quelle adresse puis-je vous recontacter ?</label>
						    <input type="text" id="courriel" name="courriel" value="<?php echo ($email!='') ? $email: '' ?>" placeholder="exemple@mail.com"/>
						</p>
						<p>
			                <label for="message">Le message que vous souhaitez m'adresser :</label></br>
							<textarea id="message" name="message" rows="1" cols="1"><?php echo ($_POST['message']!='') ? $_POST['message']: '' ?></textarea>
						</p>
						<div id="bottle">
							<input id="send" tabindex="1" type="submit" value="Envoyer"/>
		            	</div>
		            </fieldset>
		            <!--<div id="line1"></div>-->
		        </form>

			</main>

			<footer>
				<div id="social">
					<a class="network" id="fb" href="https://www.facebook.com/opaquay"></a>
					<a href="index.html"><img id="name" src="img/name-footer.png" alt="Olivia Paquay"/></a>
					<a class="network" id="tw" href="https://twitter.com/OliviaPaquay"></a>
				</div>

				<ul id="menu-footer">
					<li><a href="index.html">À propos</a></li>
					<li><a href="travaux.html">Travaux</a></li>
					<li><a class="active" href="contact.php">Contact</a></li>
					<li><a href="etudecas.html">Etude de cas</a></li>
					<li><a href="page404.html">Page 404</a></li>
					<li><a href="credits.html">Crédits</a></li>
				</ul>	
			</footer>

		</div> <!--end container-->

		<script src="js/jquery-1.7.2.min.js"></script>
	</body>



</html>

