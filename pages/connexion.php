	<?php
session_start();
 
$bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');
 
if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $message = "Mail ou mot de passe incorrect !";
      }
   } else {
      $message = "Tous les champs doivent être complétés !";
   }
}
?>

<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<link href="../css/style_connexion.css" rel="stylesheet"/>
		<TITLE> Connexion </TITLE>
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
				        <ul class="nav navbar-nav navbar-right">
				            <li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
				        </ul>
			        </div>
			    </div>
		    </nav>
		</header>

		<h1>Connexion</h1>
		<br/><br/>
		<div class="container-fluid">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="carre" >
					<div class="formulaire" align="center">
			         	<form method="POST" action="">
				            <table>
				               	<tr>
				                	<td align="right">
				                    	<label>Mail :</label>
					                </td>
					                <td>
					                    <input type="text" placeholder="Votre mail" name="mailconnect" />
					                </td>
					            </tr>
					            <tr>
					                <td align="right">
					                    <label>Mot de passe :</label>
					                </td>
					                <td>
					                    <input type="password" placeholder="Votre mot de passe" name="mdpconnect" />
					                </td>
					            </tr>
					            <tr>
					                <td></td>
					                <td align="center">
					                    <br />
					                    <button type="button submit" name="formconnexion" class="btn btn-success">Je me connecte</button>
					                </td>
					            </tr>
				            </table>
			         </form>
			         <?php
			         if(isset($message)) {
			            echo '<font color="red">'.$message."</font>";
			         }
			         ?>
			      	</div>
			    </div>
			</div>
		</div>
	</BODY>
</HTML>