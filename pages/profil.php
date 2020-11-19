<?php
session_start();
 
$bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>

<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<link href="../css/style_connexion.css" rel="stylesheet"/>
		<TITLE> Profil </TITLE>
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
				  	        <li class="active"><a href="../index.html">Accueil</a></li>
				  	        <li><a href="pages/ip.php">IP</a></li>
			    	        <!-- ADD LATER -->
				  	        <li><a href="pages/wifi.php">Wi-Fi</a></li>
					        <li><a href="pages/ethernet.php">Ethernet</a></li>
			     	        <li><a href="pages/contact.php">Contact</a></li>
				        </ul>
				        <!-- ADD LATER -->
				        <?php
					    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
					    ?>
					    <ul class="nav navbar-nav navbar-right">
				            <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> <?php echo $userinfo['pseudo']; ?></a></li>
				            <li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span>Se déconnecter</a></li>
				        </ul>
					    <?php
					    }
					    ?>
			        </div>
			    </div>
		    </nav>
		</header>

		<h1>Bonjour <?php echo $userinfo['pseudo']; ?></h1>
		<h2>TODO : En maintenance pour consulter l'historique</h2>
		
	</BODY>
</HTML>

<?php   
}
?>