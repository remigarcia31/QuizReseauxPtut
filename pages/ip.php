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

<script type="application/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<body>

<?php

function masqueCIDR($value) // fonction pour convertir CIDR en masque décimal (exemple : CIDR = 8 => 255.0.0.0)
{
    $masquebit = "";
    $masquesr = "";
    $split = "";
    $i = 0;
    for ($i; $i < $value; $i++) {
        $masquebit = $masquebit . "1";
    }
    for ($i; $i < 32; $i++) {
        $masquebit = $masquebit . "0";
    }
    $split = str_split($masquebit, 8);

    $masquesr = base_convert($split[0], 2, 10);
    $masquesr = $masquesr . "." . base_convert($split[1], 2, 10);
    $masquesr = $masquesr . "." . base_convert($split[2], 2, 10);
    $masquesr = $masquesr . "." . base_convert($split[3], 2, 10);

    return $masquesr;
}

$randIP1 = mt_rand(1, 223);
$randIP2 = mt_rand(0, 255);
$randIP3 = mt_rand(0, 255);
$randIP4 = mt_rand(0, 254);
$tableauA = array(8 => 8,10 => 10,14 => 14);
$tableauB = array(16 => 16, 20 => 20, 22 => 22);
$tableauC = array(24 => 24, 28 => 28, 30 => 30);

    if ($randIP1 <= 126) { // classe A
        $randMask = array_rand($tableauA,1);
    } elseif ($randIP1 <= 191) { // classe B
        $randMask = array_rand($tableauB,1);
    } elseif ($randIP1 <= 223) { // class C
        $randMask = array_rand($tableauC,1);
    }
    $randIP = $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4 . "/" . $randMask;
    
?>


<h1>Quiz IP</h1>
            <h2>Donnez les informations suivantes à l'aide de cette adresse IP :</h2>
			
			<h2><span class="encadrer-un-contenu"> 
                <?php if(isset($_POST["typeMasque"])) {
                    $typeMasque = $_POST["typeMasque"];
                if($typeMasque  == "ACIDR") {
                    echo $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4 . "/" . $randMask;
                } else if ($typeMasque == "SCIDR"){
                    echo $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4;
                    echo " | " . $masqueCIDR = masqueCIDR($randMask);
                }
                } ?> 
            </span>
				<h4> 
				    </br>
					<img src="../images/f5.png" alt="" height="30px" 
								width="30px"  Onclick="javascript:window.history.go(0)"/>
				</h4>
			</h2>
<?php echo '<form action="correctionIP.php?id='.$_SESSION['id'].'" method="post">';?>
    <?php
    if(isset($_POST["typeMasque"])) {
        $typeMasque = $_POST["typeMasque"];
        if($typeMasque  == "ACIDR") {
        ?>
            <div> Ip à analyser (vous pouvez la changer) : </div>
            <input type="text" name="randIP" id="IP" value="<?php echo "" . $randIP . "" ?>" required>
        <?php
        } else {
            ?>
            <input type="hidden" name="randIP" id="IP" value="<?php echo $randIP ?>">
            <input type="hidden" name="SCIDR" id="SCIDR" value="<?php echo $masqueCIDR ?>">            
            <?php
        }
    }
    ?>
    <p>Classe : </p>
    <label for="A">
        <input type="radio" name="classe" value="A" required>
        A
    </label>
    <label for="B">
        <input type="radio" name="classe" value="B">
        B
    </label>
    <label for="C">
        <input type="radio" name="classe" value="C">
        C
    </label>
    <p>Masque par défaut de la classe : </p>
    <input type="text" name="masque1" onkeypress="return isNumberKey(event)" maxlength="3" size="3"required /> .
    <input type="text" name="masque2" onkeypress="return isNumberKey(event)" maxlength="3" size="3"required /> .
    <input type="text" name="masque3" onkeypress="return isNumberKey(event)" maxlength="3" size="3"required /> .
    <input type="text" name="masque4" onkeypress="return isNumberKey(event)" maxlength="3" size="3"required />
    <p>Res (il est possible de le laisser vide) : </p>
    <input type="text" name="res1" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="res2" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="res3" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="res4" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/>
    <p>Int (il est possible de le laisser vide) : </p>
    <input type="text" name="int1" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="int2" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="int3" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="int4" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/>
    <p>Adresse de broadcast : </p>
    <input type="text" name="broadcast1" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/> .
    <input type="text" name="broadcast2" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/> .
    <input type="text" name="broadcast3" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/> .
    <input type="text" name="broadcast4" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/>
    <p>Adresse de réseau : </p>
    <input type="text" name="reseau1" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/> .
    <input type="text" name="reseau2" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/> .
    <input type="text" name="reseau3" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/> .
    <input type="text" name="reseau4" onkeypress="return isNumberKey(event)" maxlength="3" required size="3"/>
    <p>Sous réseau ? : </p>
    <label for="oui">Oui
        <input type="radio" name="sr" value="oui" required>
    </label>
    <label for="non">Non
        <input type="radio" name="sr" value="non">
    </label>
    <p>Adresse de sous-réseau : </p>
    <input type="text" name="sreseau1" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="sreseau2" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="sreseau3" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="sreseau4" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/>
    <p>Adresse de broacast de sous-réseau : </p>
    <input type="text" name="broadcastsr1" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="broadcastsr2" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="broadcastsr3" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="broadcastsr4" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/>
    <p>Masque de sous-réseau</p>
    <input type="text" name="msreseau1" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="msreseau2" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="msreseau3" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/> .
    <input type="text" name="msreseau4" onkeypress="return isNumberKey(event)" maxlength="3" size="3"/>
    <p>S-Res (doit etre rentré en binaire) : </p>
    <input type="text" name="sres1" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/> .
    <input type="text" name="sres2" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/> .
    <input type="text" name="sres3" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/> .
    <input type="text" name="sres4" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/>
    <p>S-Int (doit etre rentré en binaire) : </p>
    <input type="text" name="sint1" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/> .
    <input type="text" name="sint2" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/> .
    <input type="text" name="sint3" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/> .
    <input type="text" name="sint4" onkeypress="return isNumberKey(event)" maxlength="8" size="8"/><br><br>

    <input type="hidden" name="randMasque" value="<?php echo "" . $randMask . "" ?>"></input>
    <input type="submit" value="Envoyer la réponse">

</form>

</body>


</html>
<?php
}
?>
