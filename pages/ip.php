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
<<<<<<< HEAD

=======
>>>>>>> adam
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
<<<<<<< HEAD
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

<body>
    <?php
        $ip1 = mt_rand(1, 223);
        $ip2 = mt_rand(0, 255);
        $ip3 = mt_rand(0, 255);
        $ip4 = mt_rand(0, 255);
        $tableauA = array(8 => 8,10 => 10,14 => 14);
        $tableauB = array(16 => 16, 20 => 20, 22 => 22);
        $tableauC = array(24 => 24, 28 => 28, 30 => 30);

        if ($ip1 <= 126) { // classe A
            $randMask = array_rand($tableauA,1);
        } elseif ($ip1 <= 191) { // classe B
            $randMask = array_rand($tableauB,1);
        } elseif ($ip1 <= 223) { // class C
            $randMask = array_rand($tableauC,1);
        }
        $ip = $ip1 . "." . $ip2 . "." . $ip3 . "." . $ip4 . "/" . $randMask ;

    ?>
    <form action="" method="post">
         <fieldset>
            <h1>Quiz IP</h1>
            <h2>Donnez les informations suivantes à l'aide de cette adresse IP :</h2>
			
			<h2><span class="encadrer-un-contenu"> <?php echo "$ip"; ?> </span>
=======
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
				  	        echo '<a href="choixCIDR.php?id='.$_SESSION['id'].'"> ';
				  	} else {
				  	    /*sinon ramène à la page de base*/
				  	    echo '<a href="choixCIDR.php"> ';
				  	}
				  	?>IP</a></li>
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
>>>>>>> adam
				<h4> 
				    </br>
					<img src="../images/f5.png" alt="" height="30px" 
								width="30px"  Onclick="javascript:window.history.go(0)"/>
				</h4>
			</h2>
<<<<<<< HEAD
			
                <input type="text" id="ip1" name="ip1" size="3" maxlength="3" value="<?php echo $ip1; ?>">&nbsp;.
                <input type="text" id="ip2" name="ip2" size="3" maxlength="3" value="<?php echo $ip2; ?>">&nbsp;.
                <input type="text" id="ip3" name="ip3" size="3" maxlength="3" value="<?php echo $ip3; ?>">&nbsp;.
                <input type="text" id="ip4" name="ip4" size="3" maxlength="3" value="<?php echo $ip4; ?>">&nbsp;/
                <input type="text" size="3" name="cidr" value=<?php echo $randMask; ?>>&nbsp;CIDR
                <!-- Utiliser disabled pour bloquer la saisie mais du coup erreur php
                    on ne recuêre pas la variable --> 
			  
            <br/><br/>
         </fieldset>
    
        <p>Classe : </p>
            <label for="A">A</label>
            <input type="radio" name="classe" value="A">
            <label for="B">B</label>
            <input type="radio" name="classe" value="B">
            <label for="C">C</label>
            <input type="radio" name="classe" value="C">
            <br/><br/>

        <p> Masque : </p>
            <input type="text" name="masque" size="20" placeholder="Entrez votre réponse">
            <br/><br/>

        <p> Adresse réseau : </p>
            <input type="text" name="adresseR" size="20" placeholder="Entrez votre réponse" value="">
            <br/><br/>

        <p> Adresse de la machine : </p>
            <input type="text" name="adresseM" size="20" placeholder="Entrez votre réponse" value="">
            <br/><br/>

        <p> Adresse de broadcast : </p>
            <input type="text" name="adresseB" size="20" placeholder="Entrez votre réponse" value="">
            <br/><br/>

            <input value="Vérifier" type="submit"/>
    </form>

    <?php
function valideIP($ip)
{
    $in_addr = inet_pton($ip);
    if($in_addr === false) {
        return false;
    } else {  
        return true;
    }
}

function u_int_to_octets($myVal)
{   
   $val1 = $myVal & 0xff000000;
   $val1 = $val1 >> 24;
   $val2 = $myVal & 0x00ff0000;
   $val2 = $val2 >> 16;
   $val3 = $myVal & 0x0000ff00;
   $val3 = $val3 >> 8;
   $val4 = $myVal & 0x000000ff;

   $buf = $val1.".".$val2.".".$val3.".".$val4;

   return $buf;
}

function estValide($masque)
{
   if(!is_numeric($masque))
      return false;

   $zeroTrouve = 0;

   // tant qu'il y a des bits ?
   while($masque != 0)
   {
      // test le bit de poids fort
      if( ($masque & 0x80) != 0)   /* test leftmost bit */
      {
         if($zeroTrouve)
            return false; /* non valide */
      }
      else
      {
         $zeroTrouve = 1;
      }         
      $masque <<= 1; /* décalage à gauche */
   }

   return true; /* valide */
}

function octets_to_u_int($buf)
{
   $val = explode(".", $buf);
   $myVal = $val[3];
   $val[2] <<= 8;
   $myVal |= $val[2];
   $val[1] <<= 16;
   $myVal |= $val[1];
   $val[0] <<= 24;
   $myVal |= $val[0];

   return $myVal;
}

function bitfill_from_left($numBits)
{
   $myVal = 0;
   $start = true;

   for($i = 1; $i < $numBits+1; $i++)
   {
      $myVal = $myVal >> 1;
      $myVal |= 0x80;
      if(($i % 8) == 0)
      {
         if($start === true)
               $value = $myVal;
         else  $value .= ".".$myVal;
         $myVal = 0;
         $start = false;
      }
   }

   if((($i-1) % 8) != 0)
   {
      if($start === true)
            $value = $myVal;
      else  $value .= ".".$myVal;
   }

   for($i=ceil($numBits/8);$i<4;$i++)
      $value .= ".0";
   
   return $value;
}

   // CORRECTION DE LA CLASSE DE L'ADRESSE
   // une saisie ?
   if(IsSet($_POST) && !Empty($_POST))
   {
    $note = 0;
      $adresse_ip = $_POST["ip1"].".".$_POST["ip2"].".".$_POST["ip3"].".".$_POST["ip4"];
      echo "Adresse IPv4 à vérifier : $adresse_ip<br>";

      if(!@valideIP($adresse_ip))
            echo "$adresse_ip n'est pas une adresse IPv4 valide !<br/>";
      else  
      {    
          
        echo "$adresse_ip est une adresse IP valide. <br/><br/><br/>";

        $p_cidr = $_POST["cidr"];
        if(is_numeric($p_cidr) && $p_cidr > 0 && $p_cidr <= 32)
        {
           $masque_cidr = bitfill_from_left($p_cidr);                              
  
           $masque = explode(".", $masque_cidr);
           $net1 = intval($_POST["ip1"]) & intval($masque[0]);
           $net2 = intval($_POST["ip2"]) & intval($masque[1]);
           $net3 = intval($_POST["ip3"]) & intval($masque[2]);
           $net4 = intval($_POST["ip4"]) & intval($masque[3]);

           $net = $net1.".".$net2.".".$net3.".".$net4; //ADRESSE DE RESEAU

           $host1 = intval($_POST["ip1"]) & ~intval($masque[0]);
           $host2 = intval($_POST["ip2"]) & ~intval($masque[1]);
           $host3 = intval($_POST["ip3"]) & ~intval($masque[2]);
           $host4 = intval($_POST["ip4"]) & ~intval($masque[3]);
           $host = $host1.".".$host2.".".$host3.".".$host4; //ADRESSE DE BROADCAST
           $masqueCIDR = $masque[0].".".$masque[1].".".$masque[2].".".$masque[3]; //masque à comparer avec le masque renseigné par l'utilisateur

           $n = octets_to_u_int($net);
           $m = octets_to_u_int($masque_cidr);
           $b = ( $n + ~$m );
           $broadcast = u_int_to_octets($b);

           if($_POST["masque"] == "") { // Si le masque n'est pas renseigné
               echo "Erreur, vous n'avez pas renseigné de masque.<br/>";
           } else {
               $masqueUser = $_POST["masque"];
               if($masqueUser == $masqueCIDR) {
                   echo "Bonne réponse ! Le masque est effectivement $masqueCIDR <br/>";
                   $note++;
               } else {
                   echo "Mauvaise réponse, le masque correct est $masqueCIDR <br/>";
               }
           }

            if($_POST["adresseR"] == "") { // Si le champ n'est pas renseigné
                echo "Erreur, vous n'avez pas renseigné d'adresse de réseau.<br/>";
            } else {
                $adresseR = $_POST["adresseR"];
                if($adresseR == $net) {
                    echo "Bonne réponse ! L'adresse de réseau est bien $net <br/>";
                    $note++;
                } else {
                    echo "Mauvaise réponse, l'adresse de réseau était $net <br/>";
              }
            }

            if($_POST["adresseM"] == "") { // Si le champ n'est pas renseigné
                echo "Erreur, vous n'avez pas renseigné l'adresse de la machine.<br/>";
            } else {
                $adresseM = $_POST["adresseM"];
                if($adresseM == $host) {
                    echo "Bonne réponse ! L'adresse de la machine est bien $host <br/>";
                    $note++;
                } else {
                    echo "Mauvaise réponse, l'adresse de la machine était $host <br/>";
                }
            }

            if($_POST["adresseB"] == "") { // Si le champ n'est pas renseigné
                echo "Erreur, vous n'avez pas renseigné l'adresse de broadcast.<br/>";
            } else {
                $adresseB = $_POST["adresseB"];
                if($adresseB == $broadcast) {
                    echo "Bonne réponse ! L'adresse de la machine est bien $broadcast <br/>";
                    $note++;
                } else {
                    echo "Mauvaise réponse, l'adresse de la machine était $broadcast <br/>";
                }
            }

        }
        else  echo "CIDR /$p_cidr n'est pas valide !<br>";

         $ip1 = $_POST["ip1"];
         if(($ip1 & 0x80) == 0)
            $classe = "A";
         elseif(($ip1 & 0xC0) == 128)
            $classe = "B";
         elseif(($ip1 & 0xE0) == 192)
            $classe = "C";
         else
            $classe = "D ou E";

         if (isset($_POST['classe']) && $_POST['classe'] == $classe) {
            echo " C'est VRAI ! <br/>";
            $note++;
         } else if(!(isset($_POST['classe']))){
            echo "Erreur, il n'y a pas de classe choisie <br/>";
         } else {
            echo "C'est FAUX !";
            echo " $adresse_ip est une adresse de classe $classe <br/>";
         }
         echo "<h3> Vous avez eu une note de $note/5.</h3>";

         
         
      }
   }
?>
    </body>
</html> 
=======
<form method="POST" action="correctionIP.php">
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
>>>>>>> adam
