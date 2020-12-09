<!--    page de contact du site web quiz reseau   -->

<!-- ============================================ -->

<!-- Methode de gestion des erreurs du formulaire -->
<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

$bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');

/*Vérifie si un utilisateur est connecté*/
if (isset($_GET['id']) AND $_GET['id'] > 0) {
	/* On met l'id en int pour la sécurité*/
	$getid = intval($_GET['id']);
	/*On va chercher le pseudo de l'utilisateur*/
    $pseudouser = $bdd->prepare('SELECT pseudo FROM utilisateurs WHERE id = ?');
    $pseudouser->execute(array($getid));
    /* On récupère l'information*/
    $userinfo = $pseudouser->fetch();

	if(isset($_POST['formcontact'])) { 
	   	$nom = htmlspecialchars($_POST['nom']);
	   	$mail = htmlspecialchars($_POST['mail']);
		$message = htmlspecialchars($_POST['message']);
	   	if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) {
	      	$messagelength = strlen($message);
	      	if($messagelength >= 5 AND $messagelength <= 300) {
	            
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

		
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<script src="../jquery/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link rel="icon" type="image/png" href="../images/contact.png"> <!-- Icone dans l'onglet -->
		<link href="../css/style_contact.css" rel="stylesheet"/>
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

						<?php 
						/* On affiche les boutons pour accèder à l'index, ip et contact*/
						echo '<li><a href="../index.php?id='.$_SESSION['id'].'">Accueil</a></li>';
<<<<<<< HEAD
					  	echo '<li><a href="ip.php?id='.$_SESSION['id'].'">IP</a></li>';
=======
					  	echo '<li><a href="choixCIDR.php?id='.$_SESSION['id'].'">IP</a></li>';
>>>>>>> adam
					  	echo '<li class="active"><a href="contact.php?id='.$_SESSION['id'].'">Contact</a></li>'; 						  
				        ?> 
				    </ul>

						<?php
						/* On affiche les boutons pour accèder à son compte et de déconnexion*/
					    echo '<ul class="nav navbar-nav navbar-right">';
				        echo '<li><a href="profil.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-user"></span>&nbsp'.$userinfo['pseudo'].'</a></li>';
				        echo '<li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a></li>';
				        echo '</ul>';
				        ?>
			        </div>
			    </div>
		    </nav>
		</header>
		<!-- Formulaire de contact -->
		<div class="container-fluid center">
		<h1>Contact</h1>
		<br/> <br/>
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
											<input type="text" id="mail" name="mail"
													value="<?php
																/*On va chercher le mail de l'utilisateur*/
   																$mailuser = $bdd->query("SELECT mail FROM utilisateurs WHERE id = $_GET[id]");
   																/* On récupère l'information*/
   																$sonmail = $mailuser->fetch();
   																echo $sonmail['mail']; 	 
   															?>"readonly/>
										</td>
									</tr>
									<tr>
										<td align="right">
											<label for="message">Message :</label>
										</td>
										<td>
											<textarea  rows="4" cols="29" placeholder="Ici, votre message" 
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

									$retour = mail('remi.garcia@iut-rodez.fr', 'Envoi depuis page Contact', $message, $entete);
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
			<!-- pied de page -->
			<footer>
            <div class="container-fluid">
                <div class="col-xs-12 col-sm-6 col-md-10">
<<<<<<< HEAD
                    <p>Ce site à été crée par des étudiants en DUT informatique 2ème année. <br/> Pour plus d'information, consultez les 
=======
                    <p>Ce site a été créée par des étudiants en DUT informatique 2ème année. <br/> Pour plus d'informations, consultez les 
>>>>>>> adam
	                    <?php 
						echo '<a href="mentions_legales.php?id='.$_SESSION['id'].'">Mentions légales</a>.';						
                   	 	echo "<br/> Consultez également la ";
                  		echo '<a href="protection_donnees.php?id='.$_SESSION['id'].'">Protection des données</a>.';
						?>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                      <a href="https://www.iut-rodez.fr/" target="_blank"> <img src="../images/logoIut.png" alt="Logo IUT de Rodez" class="img_iut"> </a> 
                </div>
            </div>
        </footer>
	</body>
</HTML>
<?php
} else {
	header('Location: connexion.php');
  	exit();
}
?>