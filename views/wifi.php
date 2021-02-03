<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<link href="../css/style.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
		<script src="../jquery/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<TITLE> Quiz Wi-Fi </TITLE>
		<link rel="icon" type="image/png" href="../images/wifi.png"> <!-- Icone dans l'onglet -->

	</HEAD>
	<BODY>
    <?php
spl_autoload_extensions(".php");
spl_autoload_register();

use yasmf\HttpHelper;
?>
<!-- menu qui permet de naviguer entre les différentes pages du site -->
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
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="">
                <input hidden name="controller" value="">
                <input type="submit" value="Accueil">
              </form>
            </li>
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="choixCIDR">
                <input hidden name="controller" value="Ip">
                <input type="submit" value="IP">
              </form>
            </li>
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="wifi">
                <input hidden name="controller" value="Wifi">
                <input type="submit" value="Wifi">
              </form>
            </li>
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="ethernet">
                <input hidden name="controller" value="Ethernet">
                <input type="submit" value="Ethernet">
              </form>
            </li>
				  </ul>
          <!-- CONNEXION / INSCRIPTION A METTRE EN PLACE A LA FIN
			    <ul class="nav navbar-nav navbar-right">
			      <li><a href="pages/inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
			      <li><a href="pages/connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
			    </ul>-->	             
			  </div>
		  </div>
	  </nav>
  </header>
		<section>
			<div class="container_fluid">
				<div class="img_fond col-xs-12 center">
					<br/><br/>
					<h1>PAGE EN COURS DE CONSTRUCTION</h1>
					<br/>
					<h3>Merci de revenir plus tard ! :)</h3>
					<br/><br/><br/>
				</div>
			</div>
		</section>
		
		<!-- pied de page -->
    <footer>
      <div class="container-fluid">
        <div class="col-xs-12 col-sm-6 col-md-10">
          <p>Ce site a été créé par des étudiants en DUT informatique 2ème année.</p>
          <div class="col-xs-6">
            <p>Pour plus d'informations, consultez les mentions légales.</p>
            <form action="index.php" method="post">
              <input hidden name="action" value="mentions">
              <input hidden name="controller" value="Home">
              <input type="submit" value="Mentions légales">
            </form>
          </div>	
          <div class="col-xs-6">			
            <p>Consultez également la manière dont son protegés vos données.</p>
            <form action="index.php" method="post">
              <input hidden name="action" value="protection">
              <input hidden name="controller" value="Home">
              <input type="submit" value="Protection des données">
            </form>				
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
          <a href="https://www.iut-rodez.fr/" target="_blank"> <img src="images/logoIut.png" alt="Logo IUT de Rodez" class="img_iut"> </a> 
        </div>
      </div>
    </footer>
	</BODY>
</HTML>