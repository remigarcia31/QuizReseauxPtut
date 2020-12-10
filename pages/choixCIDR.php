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

?>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Quiz IP</title>
    
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
	<script src="../jquery/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<link rel="icon" type="image/png" href="../images/ip.png"> <!-- Icone dans l'onglet -->
	<link href="../css/styleip.css" rel="stylesheet"/>
</head>
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
            		        echo '<li class="active"><a href="choixCIDR.php?id='.$_SESSION['id'].'">IP</a></li>';
            		        echo '<li><a href="contact.php?id='.$_SESSION['id'].'">Contact</a></li>';                          
            		        ?> 
            		    </ul>
            		    <ul class="nav navbar-nav navbar-right">
            		        <?php
            		        /* On affiche les boutons pour accèder à son compte et de déconnexion*/
            		        echo '<li><a href="profil.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-user"></span>&nbsp'.$userinfo['pseudo'].'</a></li>';
            		        echo '<li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a></li>';
            		        ?>
            		    </ul>
			        </div>
			    </div>
		    </nav>
		</header>

<body>
    <h1> Quiz IP : Choix du type du masque </h1>
    <?php echo '<form action="ip.php?id='.$_SESSION['id'].'" method="post">';?>
        <p>Avant de commencer le quiz, veuillez choisir si vous voulez un masque avec la notation CIDR ou non </p>
            <label for="ACIDR">Masque avec notation CIDR</label>
            <input type="radio" name="typeMasque" value="ACIDR" required> </br>
            <label for="SCIDR">Masque sans notation CIDR</label>
            <input type="radio" name="typeMasque" value="SCIDR">
            <br/><br/>
            <input value="Choisir" type="submit"/>
    </form>
    </body>
</html> 

<?php
}
?>