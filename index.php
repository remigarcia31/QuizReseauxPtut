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
<<<<<<< HEAD
		<meta charset="utf-8"/>
=======
		<meta charset="utf-8" />
>>>>>>> adam
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link href="css/style.css" rel="stylesheet"/>
		<script src="jquery/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<TITLE> Quiz Réseaux </TITLE>
		<link rel="icon" type="image/png" href="images/monitor.png"> <!-- Icone dans l'onglet -->

	</HEAD>
	<body>
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
				        	<!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur l'accueil il est redirigé vers sa page index -->
				  	        <li class="active"> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
				  	        						  	echo '<a href="index.php?id='.$_SESSION['id'].'">Accueil</a></li>';
<<<<<<< HEAD
				  	        						  	echo '<li><a href="pages/ip.php?id='.$_SESSION['id'].'">IP</a></li>';
=======
				  	        						  	echo '<li><a href="pages/choixCIDR.php?id='.$_SESSION['id'].'">IP</a></li>';
>>>>>>> adam
				  	        						  	echo '<li><a href="pages/contact.php?id='.$_SESSION['id'].'">Contact</a></li>';
				  	        						  } else {
				  	        						  	/*sinon ramène à l'index de base*/
				  	        						  	echo '<a href="index.php">Accueil</a></li>';
				  	        						  }				  
				  	        					?> 
				        </ul>
				        <?php
				        if ((isset($_GET['id']) AND $_GET['id'] > 0)) {
						    /* On affiche le bouton pour accèder à son compte et de déconnexion si l'user est connecté*/
					    	echo '<ul class="nav navbar-nav navbar-right">';
				            	echo '<li><a href="pages/profil.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-user"></span>&nbsp'.$userinfo['pseudo'].'</a></li>';
				            	echo '<li><a href="pages/deconnexion.php"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a></li>';
				        	echo '</ul>';
					 	} else {
					    ?>
					    <!-- else -->
					    <!-- Si pas d'utilisateur connecté alors on affiche inscription et connexion -->
				        <ul class="nav navbar-nav navbar-right">
				            <li><a href="pages/inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
				            <li><a href="pages/connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
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
			<p>
			<div class="container_fluid">
				<div class="img_fond col-xs-12 center">
					<br/><br/>
					<h1>Quiz Réseaux</h1>
					<br/>
					<h3>Ce site vous permet de réviser les notions du cours de réseaux. 
						<br/>Allant de l'adressage IP au Wi-Fi, testez vos connaissances !</h3>
					<br/><br/><br/>
				</div>
			</div>
			</p>
		</section>
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
	                    if(isset($_GET['id']) AND $_GET['id'] > 0) {
	                    	echo '<a href="pages/mentions_legales.php?id='.$_SESSION['id'].'">Mentions légales</a>.';						
                   	 		echo "<br/> Consultez également la ";
                  			echo '<a href="pages/protection_donnees.php?id='.$_SESSION['id'].'">Protection des données</a>.';
						} else {
							/*sinon ramène aux mentions légales de base*/
						  	echo '<a href="pages/mentions_legales.php">Mentions légales</a>.';						
                   	 		echo "<br/> Consultez également la ";
                  			echo '<a href="pages/protection_donnees.php">Protection des données</a>.';	
						}
					?>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                      <a href="https://www.iut-rodez.fr/" target="_blank"> <img src="images/logoIut.png" alt="Logo IUT de Rodez" class="img_iut"> </a> 
                </div>
            </div>
        </footer>
	</body>
</HTML>

<?php   

?>