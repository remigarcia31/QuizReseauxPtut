<!--
  ~ yasmf - Yet Another Simple MVC Framework (For PHP)
  ~     Copyright (C) 2019   Franck SILVESTRE
  ~
  ~     This program is free software: you can redistribute it and/or modify
  ~     it under the terms of the GNU Affero General Public License as published
  ~     by the Free Software Foundation, either version 3 of the License, or
  ~     (at your option) any later version.
  ~
  ~     This program is distributed in the hope that it will be useful,
  ~     but WITHOUT ANY WARRANTY; without even the implied warranty of
  ~     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  ~     GNU Affero General Public License for more details.
  ~
  ~     You should have received a copy of the GNU Affero General Public License
  ~     along with this program.  If not, see <https://www.gnu.org/licenses/>.
  -->

  <!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link href="css/style_contact.css" rel="stylesheet"/>
		<script src="jquery/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<TITLE> Quiz Réseaux </TITLE>
		<link rel="icon" type="image/png" href="images/monitor.png"> <!-- Icone dans l'onglet -->

	</head>
<body>
<?php
spl_autoload_extensions(".php");
spl_autoload_register();

use yasmf\HttpHelper;

if(isset($_POST['formcontact'])) { 
   	$nom = htmlspecialchars($_POST['nom']);
   	$mail = htmlspecialchars($_POST['mail']);
	$message = htmlspecialchars($_POST['message']);
   	if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) {
      	$messagelength = strlen($message);
      	if(preg_match('/[-0-9a-zA-Z.+_]+@iut-rodez\.fr/i', $mail)) {
      		if($messagelength >= 5 AND $messagelength <= 300) {
            
      		} else {
         		$msg = "Votre message doit posseder au moins 5 caractères et ne pas dépasser 300 caractères !";
         	}
      	} else{
      		$msg = "Votre adresse mail n'est pas valide ! (exemple@iut-rodez.fr)";
      	}
   	} else {
     	$msg = "Tous les champs doivent être complétés !";
   	}
}
?>
<!-- menu qui permet de naviguer entre les différentes pages du site -->
	<header>
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
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="">
                <input hidden name="controller" value="">
                <input type="submit" value="Accueil">
              </form>
            </li>
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="choixCIDR">
                <input hidden name="controller" value="Ip">
                <input type="submit" value="IP">
              </form>
            </li>
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="wifi">
                <input hidden name="controller" value="Wifi">
                <input type="submit" value="Wifi">
              </form>
            </li>
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="ethernet">
                <input hidden name="controller" value="Ethernet">
                <input type="submit" value="Ethernet">
              </form>
            </li>
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="contact">
                <input hidden name="controller" value="">
                <input type="submit" value="Contact">
              </form>
            </li>
				  </ul>
          <!-- CONNEXION / INSCRIPTION A METTRE EN PLACE A LA FIN
			    <ul class="nav navbar-nav navbar-right">
			      <li><a href="pages/inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
			      <li><a href="pages/connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
			    </ul>-->	             
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
						<form action="index.php" method="post">
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
											<input type="text" placeholder="Votre adresse mail" id="mail" name="mail" 
														value="<?php if(isset($mail)) { echo $mail; } ?>" />
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
											<input hidden name="action" value="contact">
                							<input hidden name="controller" value="">
											<button type="button submit" name="formcontact" class="btn btn-success">J'envoie</button>
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
          <p>Ce site a été créé par des étudiants en DUT informatique 2ème année.</p>
          <div class="col-xs-6">
            <p>Pour plus d'informations, consultez les mentions légales.</p>
            <form action="index.php" method="post">
              <input hidden name="action" value="mentions">
              <input hidden name="controller" value="Home">
              <input type="submit" value="Mentions légales">
            </form>
          </div>	
          <div class="col-xs-6">			
            <p>Consultez également la manière dont son protegés vos données.</p>
            <form action="index.php" method="post">
              <input hidden name="action" value="protection">
              <input hidden name="controller" value="Home">
              <input type="submit" value="Protection des données">
            </form>				
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
          <a href="https://www.iut-rodez.fr/" target="_blank"> <img src="images/logoIut.png" alt="Logo IUT de Rodez" class="img_iut"> </a> 
        </div>
      </div>
    </footer>
	</body>
</HTML>
