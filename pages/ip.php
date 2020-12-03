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
            echo '<li class="active"><a href="ip.php?id='.$_SESSION['id'].'">IP</a></li>';
            echo '<li><a href="contact.php?id='.$_SESSION['id'].'">Contact</a></li>';
            ?>   
				  </ul>
						<?php
					  /* On affiche les boutons pour accèder à son compte et de déconnexion*/
					 	echo '<ul class="nav navbar-nav navbar-right">';
				    echo '<li><a href="profil.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-user"></span>&nbsp'.$userinfo['pseudo'].'</a></li>';
				    echo '<li><a href="deconnexion.php"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a></li>';
				    echo '</ul>';
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
        $ip1 = mt_rand(1, 255);
        $ip2 = mt_rand(0, 255);
        $ip3 = mt_rand(0, 255);
        $ip4 = mt_rand(0, 255);
        if ($ip1 > 126) {
            $randMask = mt_rand(16, 32);
        } elseif ($ip1 > 191) {
            $randMask = mt_rand(24, 32);
        } elseif ($ip1 > 239) {
            $randMask = 32;
        } else {
            $randMask = mt_rand(8, 32);;
        }
        $ip = $ip1 . "." . $ip2 . "." . $ip3 . "." . $ip4 . "/" . $randMask ;

    ?>
    <form action="" method="post">
         <fieldset>
            <h1>Détermine une classe d'adresse IPv4</h1>
                <input type="text" id="ip1" name="ip1" size="3" value="<?php echo $ip1; ?>">&nbsp;.&nbsp;
                <input type="text" id="ip2" name="ip2" size="3" value="<?php echo $ip2; ?>">&nbsp;.&nbsp;
                <input type="text" id="ip3" name="ip3" size="3" value="<?php echo $ip3; ?>">&nbsp;.&nbsp;
                <input type="text" id="ip4" name="ip4" size="3" value="<?php echo $ip4; ?>">&nbsp;.&nbsp;
                <input type="text" name="mask" value=" / <?php echo $randMask; ?> CIDR" >
                <!-- Utiliser disabled pour bloquer la saisie mais du coup erreur php
                    on ne recuêre pas la variable --> 
            <br/>
            <input value="Vérifier" type="submit"/>
         </fieldset>
    
        <p>Classe : </p>
            <label for="A">A</label>
            <input type="radio" name="classe" value="A">
            <label for="B">B</label>
            <input type="radio" name="classe" value="B">
            <label for="C">C</label>
            <input type="radio" name="classe" value="C">
            <label for="D">D</label>
            <input type="radio" name="classe" value="D">
    </form>

    <?php
function valideIP($ip)
{
   if(function_exists('inet_pton')) 
   {
      $in_addr = inet_pton($ip);
      if($in_addr === false)
            return false;
      else  return true;
   }
   if(function_exists('filter_var')) 
   {
      if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === FALSE)
            return false;
      else  return true;
   }
   if(ereg("^(([0-9]{1,3}\.){3}[0-9]{1,3})$", $ip)) 
   {
      return true;
   }
   return false;
}



   // une saisie ?
   if(IsSet($_POST) && !Empty($_POST))
   {
      $adresse_ip = $_POST["ip1"].".".$_POST["ip2"].".".$_POST["ip3"].".".$_POST["ip4"];
      echo "Adresse IPv4 à vérifier : $adresse_ip<br>";

      if(!valideIP($adresse_ip))
            echo "$adresse_ip n'est pas une adresse IPv4 valide !<br>";
      else  
      {         
         $ip1 = $_POST["ip1"];
         if(($ip1 & 0x80) == 0)
            $classe = "A";
         elseif(($ip1 & 0xC0) == 128)
            $classe = "B";
         elseif(($ip1 & 0xE0) == 192)
            $classe = "C";
         elseif(($ip1 & 0xF0) == 224)
            $classe = "D";
         else
            $classe = "E";
         
         if ($_POST['classe'] == $classe) {
            echo " C'est VRAI !      ";
         } else {
            echo "FAUX";
            echo " $adresse_ip est une adresse de classe $classe <br/>";
         }
      }
   }
?>

</html> 
<?php
} else {
  header('Location: connexion.php');
  exit();
}
?>