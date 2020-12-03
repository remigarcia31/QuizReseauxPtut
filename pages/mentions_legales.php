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
}
?>

<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<link href="../css/style.css" rel="stylesheet"/>
		<link href="../css/style_mentions_donnees.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<script src="../jquery/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<TITLE> Mentions Légales </TITLE>
		<link rel="icon" type="image/png" href="../images/monitor.png"> <!-- Icone dans l'onglet -->
	</HEAD>

	<body>
		<header> <!-- NAVBAR pour le menu déroulant-->
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
				        	<!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur l'accueil il est redirigé vers sa page index etc.. -->
				  	        <?php 
	                	    if(isset($_GET['id']) AND $_GET['id'] > 0) {
	                	    	echo '<li><a href="../index.php?id='.$_SESSION['id'].'">Accueil</a></li> ';						
                   		 		echo '<li><a href="ip.php?id='.$_SESSION['id'].'">IP</a></li> ';
                   		 		echo '<li><a href="contact.php?id='.$_SESSION['id'].'">Contact</a></li> ';
                   		 		echo '</ul>';
                   		 		
                   		 		echo '<ul class="nav navbar-nav navbar-right">';
				            	echo '<li><a href="profil.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-user"></span>&nbsp'.$userinfo['pseudo'].'</a></li>';
				            	echo '<li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a></li>';
				        		echo '</ul>';

							} else {
								echo '<li><a href="../index.php">Accueil</a></li> ';
								echo '</ul>';
							?>
							<!-- Si pas d'utilisateur connecté alors on affiche inscription et connexion -->
				        	<ul class="nav navbar-nav navbar-right">
				            	<li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
				            	<li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
				        	</ul>
							<?php
							/*fin du else*/
							}
							?>
			        </div>
			    </div>
		    </nav>
		</header>

		<section>
			<p>
			<div class="container_fluid"> <!--Bande centrale-->
				<div class="img_fond col-xs-12 center">
					<br/><br/>
					<h1>Mentions légales</h1>
					<br/>
					<h3>Consultez les mentions légales 
						<br/>Informations concernant le site web et le groupe de projet.</h3>
					<br/><br/><br/>
				</div>
			</div>
			</p>
			<div class="container"> <!--Container contenant les mentions légales du site internet-->
                <div class="texte">
				    <h2>Propriété intellectuelle</h2>
					<p>Le site internet n'accepte pas et ne reçoit pas de fonds publicitaires.<br/>
					Tout le contenu du site <a target="_blank" href="http://ptutquizz.alwaysdata.net/">http://ptutquizz.alwaysdata.net/</a> est libre de droit.<br/>
					Les icones sont des images libres de droit récupérés sur le site <a target="_blank" href="https://www.flaticon.com/">https://www.flaticon.com/</a>
					Toute reproduction, distribution, modification, retransmission ou publication de ces différents éléments est autorisé.
					<br/><br/><br/>
					<h2>Confidentialité des données personnelles</h2>
					Les informations personnelles que vous fournissez sur le site, sont confidentielles.
					Nous nous engageons sur l’honneur à respecter les conditions légales de confidentialité applicables en France et à ne pas divulguer ces informations à des tiers.
					<br/><br/><br/>
					<h2>Hébergement</h2>
					SARL Alwaysdata - 91 rue du Faubourg Saint Honoré - 75008 Paris FRANCE
					<br/><br/><br/>
					<h2>Responsable de publication</h2>
					Thomas GAFFET
					</p>
                </div>
			</div>
		</section>
	</body>
</HTML>
<?php

?>