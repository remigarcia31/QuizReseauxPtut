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
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<script src="../jquery/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<TITLE> Quiz Ethernet </TITLE>
		<link rel="icon" type="image/png" href="../images/ethernet.png"> <!-- Icone dans l'onglet -->

	</HEAD>
	<BODY>
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
				        	<!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur l'accueil il est redirigé vers sa page index -->
				  	        <li> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
				  	        						  	echo '<a href="../index.php?id='.$_SESSION['id'].'"> ';
				  	        						  } else {
				  	        						  	/*sinon ramène à l'index de base*/
				  	        						  	echo '<a href="../index.php"> ';
				  	        						  }
				  	        					?>Accueil</a></li>
				  	        <!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur le bouton il est redirigé vers sa page  -->
							<li> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
				  	        						  	echo '<a href="ip.php?id='.$_SESSION['id'].'"> ';
				  	        						  } else {
				  	        						  	/*sinon ramène à la page de base*/
				  	        						  	echo '<a href="ip.php"> ';
				  	        						  }
				  	        					?>IP</a></li>
				  	        <!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur le bouton il est redirigé vers sa page  -->
							<li> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
				  	        						  	echo '<a href="wifi.php?id='.$_SESSION['id'].'"> ';
				  	        						  } else {
				  	        						  	/*sinon ramène à la page de base*/
				  	        						  	echo '<a href="wifi.php"> ';
				  	        						  }
				  	        					?>Wi-Fi</a></li>
					        <!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur le bouton il est redirigé vers sa page  -->
							<li class="active"> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
				  	        						  	echo '<a href="ethernet.php?id='.$_SESSION['id'].'"> ';
				  	        						  } else {
				  	        						  	/*sinon ramène à la page de base*/
				  	        						  	echo '<a href="ethernet.php"> ';
				  	        						  }
				  	        					?>Ethernet</a></li>
			     	        <!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur le bouton il est redirigé vers sa page  -->
				  	        <li> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
				  	        						  	echo '<a href="contact.php?id='.$_SESSION['id'].'"> ';
				  	        						  } else {
				  	        						  	/*sinon ramène à la page de base*/
				  	        						  	echo '<a href="contact.php"> ';
				  	        						  }
				  	        					?>Contact</a></li>
				        </ul>

						<?php
				        if ((isset($_GET['id']) AND $_GET['id'] > 0)) {
						    /* On affiche le bouton pour accèder à son compte et de déconnexion*/
					    	echo '<ul class="nav navbar-nav navbar-right">';
				            	echo '<li><a href="profil.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-user"></span>'.$userinfo['pseudo'].'</a></li>';
				            	echo '<li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span>Se déconnecter</a></li>';
				        	echo '</ul>';
					 	} else {

					    ?>
					    <!-- Si pas d'utilisateur connecté alors on affiche inscription et connexion -->
				        <ul class="nav navbar-nav navbar-right">
				            <li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
				            <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
				        </ul>	        
				        <?php
				        /* Fin du if */
				    	}
				        ?>
			        </div>
			    </div>
		    </nav>
		</header>

		<section>
			<div class="container_fluid">
				<div class="img_fond col-xs-12 center">
					<br/><br/>
					<h1>PAGE EN COURS DE CONSTRUCTION</h1>
					<br/>
					<h3>Merci de revenir plus tard ! :)</h3>
					<br/><br/><br/>
				</div>
			</div>
		</section>
		<?php

		?>
		<!-- pied de page -->
		<footer>
            <div class="container-fluid">
                <div class="col-xs-12 col-sm-6 col-md-10">
                    <p>Ce site à été crée par des étudiants en DUT informatique 2ème année. <br/> Pour plus d'information, consultez les 
	                    <?php 
	                    if(isset($_GET['id']) AND $_GET['id'] > 0) {
	                    	echo '<a href="mentions_legales.php?id='.$_SESSION['id'].'"> ';
						} else {
							/*sinon ramène aux mentions légales de base*/
						  	echo '<a href="mentions_legales.php"> ';	
						}
					?>Mentions légales</a>.
                    <br/> Consultez également la
						<?php 
	                    if(isset($_GET['id']) AND $_GET['id'] > 0) {
	                    	echo '<a href="protection_donnees.php?id='.$_SESSION['id'].'"> ';
						} else {
							/*sinon ramène aux protection de données de base*/
						  	echo '<a href="protection_donnees.php"> ';	
						}
					?>Protection des données</a>.
                    </p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                      <a href="https://www.iut-rodez.fr/" target="_blank"> <img src="../images/logoIut.png" alt="Logo IUT de Rodez" class="img_iut"> </a> 
                </div>
            </div>
        </footer>
	</BODY>
</HTML>