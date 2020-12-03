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
		<TITLE> Protection des données </TITLE>
		<link rel="icon" type="image/png" href="../images/monitor.png"> <!-- Icone dans l'onglet -->
	</HEAD>
	
	<body>
		<header>
		    <nav class="navbar navbar-inverse navbar-darkblue"> <!-- NAVBAR contenant le menu déroulant avec les paramètres du site -->
			    <div class="container-fluid">
			        <div class="navbar-header">
				        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <!-- s'affiche quand le site est réduit-->
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
				        </button>
			        </div>
			        <div class="collapse navbar-collapse" id="myNavbar"> 
                    <ul class="nav navbar-nav">
				        	<!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur l'accueil il est redirigé vers sa page index -->
				  	        <?php 
	                	    if(isset($_GET['id']) AND $_GET['id'] > 0) {
	                	    	echo '<li><a href="../index.php?id='.$_SESSION['id'].'">Accueil</a></li> ';						
                   		 		echo '<li><a href="ip.php?id='.$_SESSION['id'].'">IP</a></li> ';
                   		 		echo '<li><a href="contact.php?id='.$_SESSION['id'].'">Contact</a></li> ';
                   		 		echo '</ul>';

                   		 		echo '<ul class="nav navbar-nav navbar-right">';
				            	echo '<li><a href="profil.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-user"></span>'.$userinfo['pseudo'].'</a></li>';
				            	echo '<li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span>Se déconnecter</a></li>';
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
				        </ul>
			        </div>
			    </div>
		    </nav>
		</header>

		<section>
			<p>
			<div class="container_fluid">
				<div class="img_fond center"> <!-- Bandeau central -->
					<br/><br/>
					<h1>Protection des données personnelles</h1>
					<br/>
					<h3>Collecte des données personnelles</h3>
					<br/><br/><br/>
				</div>
			</div>
            </p>
            <div class="container"> <!-- Container avec les informations concernant les protections des données -->
                <div class="texte">
				    <h2>Pourquoi les données personnelles sont elles collectées ?</h2>
				    <p>Le site peut être ammené à collecter les informations suivantes :<br/>
				    - Prénom <br/>
				    - Nom <br/>
				    - Adresse mail <br/>
				    - Pseudonyme <br/>
                    <br/>
                    <h2>Comment sont conservées les données?</h2>
                    <p>Nous avons nommé un Correspondant informatique et Liberté chargé de garantir la 
                    conformité des collectes et traitements que nous sommes amenés à réaliser, à tenir 
                    la liste des traitements enregistrés, ainsi qu’à assurer l’exercice de vos droits d’accès, 
                    de rectification et d’opposition.
                    <br/>
                    En savoir plus : <a href="https://www.cnil.fr/fr/correspondants-informatique-et-libertes-cil" target="_blank"> 
                                              https://www.cnil.fr/fr/correspondants-informatique-et-libertes-cil</a>
                    <br/><br/><br/>

                    <h2>Conservation</h2>
                    Les données sont conservées 3 ans à compter de la création du compte. 
                    Au-delà de cette durée, les données seront effacées ou anonymisées.
                    <br/><br/><br/>

                    <h2>Sécurité de stockage des données</h2>
                    Nous mettons en place toutes les précautions nécessaires pour préserver la sécurité de vos données.
                    L'ensemble des données sont stockées sur des serveurs sécurisés, accessibles à un nombre limité de personnes
                    ayant droit d'accès spécifiques.
                    <br/><br/><br/>

                    <h2>Quels sont vos droits vis à vis de vos données ?</h2>
                    Sur l'ensemble de vos données collectées vous bénéficiez : <br/>
                    <h3>- D'un droit d'accès :</h3> Le droit pour toute personne d'obtenir la communication de toutes les informations la concernant.<br/>
                    <h3>- D'un droit de rectification :</h3> Le droit pour toute personne d'obtenir la rectification des informations inexactes la concernant.<br/>
                    <h3>- D'un droit d'opposition :</h3> Le droit pour toute personne d'obtenir la suppression des informations.
                    <br/><br/><br/>

                    <h2>Exercer vos droits vis à vis de vos données</h2>
                    <h3>Si vous souhaitez accéder ou rectifier vos données</h3>
                    Vous pouvez faire une demande d'accès à vos données ou exercer vos droits en écrivant aux adresses mail suivantes :<br/>
                    thomas.gaffet@iut-rodez.fr<br/>
                    loic.rieudebat@iut-rodez.fr<br/>
                    remi.garcia@iut-rodez.fr<br/>
                    adam.khalepo@iut-rodez.fr
                    <br/><br/>
                    <h3>Si vous souhaitez vous opposer au transfert de vos données</h3>
                    Vous pouvez exercer vos droits d'opposition au transfer de vos données en écrivant aux adresses mail suivantes :<br/>
                    thomas.gaffet@iut-rodez.fr<br/>
                    loic.rieudebat@iut-rodez.fr<br/>
                    remi.garcia@iut-rodez.fr<br/>
                    adam.khalepo@iut-rodez.fr
                    <br/><br/>
                    <h3>Si vous souhaitez donner des directives relatives à vos données personnelles après décès</h3>
                    Vous pouvez exercer votre droit à donner des directives concernant vos données après votre décès en écrivant aux adresses mail suivantes :<br/>
                    thomas.gaffet@iut-rodez.fr<br/>
                    loic.rieudebat@iut-rodez.fr<br/>
                    remi.garcia@iut-rodez.fr<br/>
                    adam.khalepo@iut-rodez.fr
                    <br/><br/><br/>

                    <h2>Informations relatives aux "cookies"</h2>
                    <h3>Qu'est-ce qu'un "cookies" ?</h3>
                    Un cookie est un petit fichier contenant diverses informations textuelles. Il est déposé sur votre terminal 
                    (ordinateur, tablette, smartphone, etc.) via votre navigateur, par le site web que vous visitez.<br/>
                    <br/>
                    Les différents types de cookies :<br/>
                    <br/>
                    - Les cookies essentiels : Ces cookies sont nécessaires au bon fonctionnement de notre site et vous permettent d’utiliser les fonctionnalités de base. 
                    Sans ces cookies, vous ne pourrez pas utiliser notre site de manière fonctionnelle.<br/><br/>
                    - Les cookies de confort : Ces cookies amènent des fonctionnalités supplémentaires qui sont susceptibles d’intéresser l’internaute, 
                    sans pour autant être indispensables au fonctionnement de base du site. <br/><br/>
                    - Les cookies analytiques : Ces cookies nous permettent de connaître l’utilisation et les performances de notre site et d’en améliorer le fonctionnement. 
                    Ils portent par exemple sur les pages les plus consultées, les requêtes faites dans notre moteur de recherche etc.<br/><br/>
                    - Les cookies publicitaires : Ces cookies collectent des informations sur vos habitudes de navigation dans le but de vous présenter des publicités adaptées à vos centres d’intérêt. 
                    Ces cookies enregistrent votre visite sur notre site, les pages que vous avez visitées et les liens que vous avez suivis ainsi que votre navigation en dehors de notre site. 
                    Ils sont également utilisés pour limiter le nombre de fois où vous voyez une publicité ainsi que pour mesurer l’efficacité des campagnes publicitaires. 
                    Ils sont généralement placés par des tiers avec notre permission.
                    <br/><br/>
                    <h3>Comment accepter/refuser l'utilisation de cookies</h3>
                    Vous pouvez restreindre, bloquer ou supprimer les Cookies de ce site Internet à tout moment en modifiant la configuration de votre navigateur. 
                    Puisque les paramètres sont différents d’un navigateur à l’autre, la configuration des Cookies s’effectue habituellement dans les menus « Préférences » ou « Outils ». 
                    Pour de plus amples informations sur la configuration des Cookies dans votre navigateur, veuillez consulter le menu « Aide » de ce dernier.
                    <br/><br/>
                    <h3>Le paramétrage est spécifique à chaque navigateur</h3>
                    Pour Internet Explorer™ : <a target="_blank" href="https://support.microsoft.com/fr-fr/help/17442/windows-internet-explorer-delete-manage-cookies">https://support.microsoft.com/fr-fr/help/17442/windows-internet-explorer-delete-manage-cookies</a><br/>
                    Pour Firefox™ : <a target="_blank" href="https://support.mozilla.org/fr/kb/activer-desactiver-cookies-preferences">https://support.mozilla.org/fr/kb/activer-desactiver-cookies-preferences</a><br/>
                    Pour Chrome™ : <a target="_blank" href="https://support.google.com/chrome/answer/95647">https://support.google.com/chrome/answer/95647</a><br/>
                    Pour Safari™ : <a target="_blank" href="https://support.apple.com/fr-fr/HT201265">https://support.apple.com/fr-fr/HT201265</a><br/>
                    Pour Opera™ : <a target="_blank" href="https://help.opera.com/en/latest/web-preferences">https://help.opera.com/en/latest/web-preferences</a><br/>

                    </p>
                </div>
			</div>
		</section>
	</body>
</HTML>