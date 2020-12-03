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
				        	<!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur l'accueil il est redirigé vers sa page index -->
				  	        <li> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
				  	        						  	echo '<a href="../index.php?id='.$_SESSION['id'].'"> ';
				  	        						  } else {
				  	        						  	/*sinon ramène à l'index de base*/
				  	        						  	echo '<a href="../index.php"> ';
				  	        						  }
				  	        					?>Accueil</a></li>
				  	        <!-- Vérifie si un utilisateur est connecté (existance de id), si il clique sur le bouton il est redirigé vers sa page  -->
							<li class="active"> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
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
							<li> <?php if(isset($_GET['id']) AND $_GET['id'] > 0) {
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
<script type="application/javascript">

  function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
           return false;
        return true;
    }

</script>
<body>
</body>
    <?php
        $randIP1 = mt_rand(1, 255);
        $randIP2 = mt_rand(0, 255);
        $randIP3 = mt_rand(0, 255);
        $randIP4 = mt_rand(0, 255);
        if ($randIP1 > 126) {
            $randMask = mt_rand(16, 32);
        } elseif ($randIP1 > 191) {
            $randMask = mt_rand(24, 32);
        } elseif ($randIP1 > 239) {
            $randMask = 32;
        } else {
            $randMask = mt_rand(8, 32);;
        }
        $randIP = $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4 . "/" . $randMask ;

    ?>
    <form amethod="POST" action="#">
        <div>Ip à analyser : </div><input type="text" name="IP" value="<?php echo $randIP; ?>" disabled>
        <p>Classe : </p>
        <label for="A">A</label>
        <input type="radio" name="classe" id="A">
        <label for="B">B</label>
        <input type="radio" name="classe" id="B">
        <label for="C">C</label>
        <input type="radio" name="classe" id="C">
        <label for="D">D</label>
        <input type="radio" name="classe" id="D">
        <p>Masque : </p>
        <input type="text" name="masque1" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="masque2" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="masque3" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="masque4" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>Res (ne remplir que le nécessaire): </p>
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/> . 
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>Int (ne remplir que le nécessaire): </p>
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>@Broadcast : </p>
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>@Réseau : </p>
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>Sous réseau ? : </p>
        <label for="oui" checked>oui</label>
        <input type="radio" name="sr" id="oui">
        <label for="non">non</label>
        <input type="radio" name="sr" id="non">
        <p>@Sous-Réseau : </p>
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>S-Res (ne remplir que le nécessaire) : </p>
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/> . 
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>S-Int (ne remplir que le nécessaire) : </p>
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/><br><br>
        <input type="submit" value="Envoyer la réponse">
    </form>

</html> 