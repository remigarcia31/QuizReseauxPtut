<!--    page de contact du site web quiz reseau   -->

<!-- ============================================ -->

<!-- Methode de gestion des erreurs du formulaire -->
<?php
if(isset($_POST['formcontact'])) { 
   	$nom = htmlspecialchars($_POST['nom']);
   	$mail = htmlspecialchars($_POST['mail']);
	$message = htmlspecialchars($_POST['message']);
   	if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) {
      	$messagelength = strlen($message);
      	if($messagelength >= 5 AND $messagelength <= 300) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               	
            } else {
               	$msg = "Votre adresse mail n'est pas valide !";
            }
      	} else {
         	$msg = "Votre message doit posseder au moins 5 caractères et ne pas dépasser 300 caractères !";
      	}
   	} else {
     	$msg = "Tous les champs doivent être complétés !";
   	}
}
?>

<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />

		<!-- lien aux pages liées CCS /  Bootstrap  / Jquery  -->

		<link href="../css/style_connexion.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<script src="../jquery/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link rel="icon" type="image/png" href="../images/contact.png"> <!-- Icone dans l'onglet -->
		<TITLE>Contact</TITLE>
	</HEAD>

	<body>
		<header>
			  <!-- Barre de navigation -->
		    <nav class="navbar navbar-inverse navbar-darkblue">
			    <div class="container-fluid">
			        <div class="navbar-header">
				        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>                        
				        </button>
			        </div>
			        <div class="collapse navbar-collapse" id="myNavbar">
				        <ul class="nav navbar-nav">
				  	        <li><a href="../index.html">Accueil</a></li>
				  	        <li><a href="ip.php">IP</a></li>
			    	        <!-- ADD LATER -->
				  	        <li><a href="wifi.php">Wi-Fi</a></li>
					        <li><a href="ethernet.php">Ethernet</a></li>
			     	        <li class="active"><a href="contact.php">Contact</a></li>
				        </ul>

				        <!-- ADD LATER -->
				        <ul class="nav navbar-nav navbar-right">
				            <li><a href="../pages/inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
				            <li><a href="../pages/connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
				        </ul>
			        </div>
			    </div>
		    </nav>
		</header>
		<!-- Formulaire de contact -->
		<h1>Contact</h1>
		<br/> <br/>
		<div class="container-fluid">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="carre" >
					<div class="formulaire" align="center">
						<form method="post">
							<table>
									<tr>
										<td align="right">
											<label for="nom">Nom :</label>
										</td>
										<td>
											<input type="text" placeholder="Votre nom" id="nom" name="nom" 
														value="<?php if(isset($nom)) { echo $nom; } ?>" />
										</td>
									</tr>
									<tr>
										<td align="right">
											<label for="email">Mail :</label>
										</td>
										<td>
											<input type="text" placeholder="Votre mail" id="mail" name="mail"
													value="<?php if(isset($mail)) { echo $mail; } ?>" />
										</td>
									</tr>
									<tr>
										<td align="right">
											<label for="message">Message :</label>
										</td>
										<td>
											<textarea  rows="4" cols="28.8" placeholder="Ici, votre message" 
													id="message" name="message" > </textarea>
										</td>
									</tr>

									<tr>
										<td></td>
										<td align="center">
											<br />
											<button type="button submit" name="formcontact" 
													class="btn btn-success">J'envoie</button>
										</td>
									</tr>
								</table>
						</form>
						 <!-- Quand le formulaire est validé par la méthode de gestion des erreurs 
						 			le message est envoyé au mail indiqué SINON un message d'erreur apparait -->
						 <?php
							$validation=0;
							 if(isset($msg)) {
								echo '<font color="red">'.$msg."</font>";
								$validation = 1;
							 }
							 
						 ?>
						<?php
							if($validation!=1) {
								if(isset($_POST['message'])){
									$entete  = 'MIME-Version: 1.0' . "\r\n";
									$entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
									$entete .= 'From: ' . $_POST['mail'] . "\r\n";

									$message = '<h1>Message envoyé depuis la page Contact de Quiz Projet tutoré </h1>
									<p><b>Nom : </b>' . $_POST['nom'] . '<br>
									<b>Email : </b>' . $_POST['mail'] . '<br>
									<b>Message : </b>' . $_POST['message'] . '</p>';

									$retour = mail('loic.rieudebat@iut-rodez.fr', 'Envoi depuis page Contact', $message, $entete);
									if($retour) {
										echo '<p>Votre message a bien été envoyé.</p>';
									}
								}
								$validation=0;
							}

						?>
					</div>
			    </div>
			</div>
		</div>
	</body>
</HTML>