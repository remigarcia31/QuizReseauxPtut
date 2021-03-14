<!--
  ~ yasmf - Yet Another Simple MVC Framework (For PHP)
  ~     Copyright (C) 2019   Franck SILVESTRE
  ~
  ~     This program is free software: you can redistribute it and/or modify
  ~     it under the terms of the GNU Affero General Public License as published
  ~     by the Free Software Foundation, either version 3 of the License, or
  ~     (at your option) any later version.
  ~
  ~     This program is distributed in the hope that it will be useful,
  ~     but WITHOUT ANY WARRANTY; without even the implied warranty of
  ~     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  ~     GNU Affero General Public License for more details.
  ~
  ~     You should have received a copy of the GNU Affero General Public License
  ~     along with this program.  If not, see <https://www.gnu.org/licenses/>.
  -->

  <!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link href="css/style_ethernet.css" rel="stylesheet"/>
		<script src="jquery/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<TITLE> Quiz Réseaux </TITLE>
		<link rel="icon" type="image/png" href="images/ethernet.png"> <!-- Icone dans l'onglet -->

	</head>
<body>
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
            <li>
              <form action="index.php" method="post">
                <input hidden name="action" value="contact">
                <input hidden name="controller" value="">
                <input type="submit" value="Contact">
              </form>
            </li>
				  </ul>
          <ul class="nav navbar-nav navbar-right">
				            <li>
                      <form action="index.php" method="post">
                        <input hidden name="action" value="ajoutScenario">
                        <input hidden name="controller" value="ethernet">
                        <input type="submit" value="Ajout scénario">
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
  
  <script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}

</script>

  <h1> Quiz Ethernet : Choix du type du quizz </h1>
    <form action="index.php" method="post">
        <p>Avant de commencer le quiz, veuillez choisir si vous voulez vous entrainer avec des trames ou bien avec des chronogrammes :</p>
            <label for="TRAMES">Avec des trames Ethernet </label>
            <input type="radio" name="typeEthernet" value="TRAMES" onclick="javascript:yesnoCheck()" name="yesno" id="noCheck" required> </br>
            <label for="CHRONO">Avec des chronogrammes Ethernet</label>
            <input type="radio" name="typeEthernet" value="CHRONO" onclick="javascript:yesnoCheck()" name="yesno" id="yesCheck">
            <div id="ifYes" style="display:none" class="typeChronogramme">
              <br>
              <label for="PARTAGE">Chronogramme partagé</label>
              <input type="radio" name="typeChrono" value="PARTAGE" checked></br>
              <label for="COMMUTE">Chronogramme commuté</label>
              <input type="radio" name="typeChrono" value="COMMUTE"> </br>
            </div>
            <input hidden name="action" value="quizEthernet">
            <input hidden name="controller" value="Ethernet">
            <br/><br/>
            <input value="Choisir" type="submit"/>
    </form>
		
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