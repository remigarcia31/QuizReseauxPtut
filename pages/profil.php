<?php
session_start();
 
$bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');

/* Si un utilisateur est connecté on affiche la page de son profil*/
if(isset($_GET['id']) AND $_GET['id'] > 0) {
	/*récupérer l'id en int pour plus de sécurité*/
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

   /* vérifie l'identité de l'utilisateur, si ce n'est pas son profil(id) ne voit rien*/
   if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
   
?>

<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<link href="../css/style_connexion.css" rel="stylesheet"/>
		<TITLE> Profil </TITLE>
		<link rel="icon" type="image/png" href="../images/avatar.png"> <!-- Icone dans l'onglet -->

	</HEAD>
	<BODY>
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
				        	<?php 
							/* On affiche les boutons pour accèder à l'index, ip et contact*/
							echo '<li><a href="../index.php?id='.$_SESSION['id'].'">Accueil</a></li>';
						  	echo '<li><a href="ip.php?id='.$_SESSION['id'].'">IP</a></li>';
						  	echo '<li><a href="contact.php?id='.$_SESSION['id'].'">Contact</a></li>'; 						  
					        ?> 
				        </ul>
					    <ul class="nav navbar-nav navbar-right">
				            <li class="active"><?php echo '<a href="profil.php?id='.$_SESSION['id'].'"> ';?><span class="glyphicon glyphicon-user"></span>&nbsp<?php echo $userinfo['pseudo']; ?></a></li>
				            <li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a></li>
				        </ul>
					   
			        </div>
			    </div>
		    </nav>
		</header>

		<h1>Bonjour <?php echo $userinfo['pseudo']; ?></h1>
		<h2>TODO : En maintenance pour consulter l'historique</h2>
		<!-- pied de page -->
		<footer>
            <div class="container-fluid">
                <div class="col-xs-12 col-sm-6 col-md-10">
                    <p>Ce site à été crée par des étudiants en DUT informatique 2ème année. <br/> Pour plus d'information, consultez les 
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
	</BODY>
</HTML>

<?php  
	} 
} else {
	header('Location: connexion.php');
  	exit();
}
?>