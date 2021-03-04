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
		<link href="css/styleIP.css" rel="stylesheet"/>
		<script src="jquery/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<TITLE> Quiz Réseaux </TITLE>
		<link rel="icon" type="image/png" href="images/monitor.png"> <!-- Icone dans l'onglet -->

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
          <!-- CONNEXION / INSCRIPTION A METTRE EN PLACE A LA FIN
			    <ul class="nav navbar-nav navbar-right">
			      <li><a href="pages/inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
			      <li><a href="pages/connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
			    </ul>-->	             
			  </div>
		  </div>
	  </nav>
  </header>

<body>
	<?php

	// Test si une Ip et son masque est valide
	function isValidIP($str, $cidr)
	{
		$valide = true;
		$explode = explode(".", $str);
		if (preg_match("/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))$/", $str) == 1) { // regex d'une IP
			if ($explode[0] > 191 && $cidr < 24) {
				$valide = false;
			} elseif ($explode[0] > 126 && $cidr < 16) {
				$valide = false;
			} elseif ($explode[0] <= 126 && $cidr < 8) {
				$valide = false;
			}
		} else {
			$valide = false;
		}


		return $valide;
	}

	//Indique la presence d'un sous reseau
	function srIsValide($classe, $masque)
	{
		$isValide = true;
		if ($classe == "A" && $masque == "8") {
			$isValide = false;
		} elseif ($classe == "B" && $masque == "16") {
			$isValide = false;
		} elseif ($classe == "C" && $masque == "24") {
			$isValide = false;
		}
		return $isValide;
	}

	//Renvoi la correction de la classe
	function CorrectionClasse($value)
	{
		$classe = "";
		if ($value > 191) {
			$classe = "C";
		} elseif ($value > 126) {
			$classe = "B";
		} else {
			$classe = "A";
		}
		return $classe;
	}

	//Renvoi la correction du masque
	function CorrectionMasque($value)
	{
		$masque = "";
		if ($value == "A") {
			$masque = "255.0.0.0";
		} elseif ($value == "B") {
			$masque = "255.255.0.0";
		} else {
			$masque = "255.255.255.0";
		}
		return $masque;
	}

	//Renvoi la correction de @Reseau
	function CorrectionReseau($value, $ip1, $ip2, $ip3)
	{
		$reseau = "";
		if ($value == "A") {
			$reseau = $ip1 . ".0.0.0";
		} elseif ($value == "B") {
			$reseau = $ip1 . "." . $ip2 . ".0.0";
		} else {
			$reseau = $ip1 . "." . $ip2 . "." . $ip3 . ".0";
		}
		return $reseau;
	}

	//Renvoi la correction de @Broadcast
	function CorrectionBroascast($value, $ip1, $ip2, $ip3)
	{
		if ($value == "A") {
			$reseau = $ip1 . ".255.255.255";
		} elseif ($value == "B") {
			$reseau = $ip1 . "." . $ip2 . ".255.255";
		} else {
			$reseau = $ip1 . "." . $ip2 . "." . $ip3 . ".255";
		}
		return $reseau;
	}

	//Renvoi la creation du res
	function CreationRes($ip1, $ip2, $ip3, $ip4)
	{
		$res = "";
		if ($ip4 != "") {
			$res = $ip1 . "." . $ip2 . "." . $ip3 . "." . $ip4;
		} elseif ($ip3 != "") {
			$res = $ip1 . "." . $ip2 . "." . $ip3;
		} elseif ($ip2 != "") {
			$res = $ip1 . "." . $ip2;
		} elseif ($ip1 != "") {
			$res = $ip1;
		}
		return $res;
	}

	//Renvoi la correction du int
	function CorrectionRes($value, $ip1, $ip2, $ip3)
	{
		$res = "";
		if ($value == "A") {
			$res = $ip1;
		} elseif ($value == "B") {
			$res = $ip1 . "." . $ip2;
		} elseif ($value == "C") {
			$res = $ip1 . "." . $ip2 . "." . $ip3;
		} else {
		}
		return $res;
	}

	//Renvoi la creation du int
	function CreationInt($ip1, $ip2, $ip3, $ip4)
	{
		$int = "";
		if ($ip1 != "") {
			$int = $ip1 . "." . $ip2 . "." . $ip3 . "." . $ip4;
		} elseif ($ip2 != "") {
			$int = $ip2 . "." . $ip3 . "." . $ip4;
		} elseif ($ip3 != "") {
			$int = $ip3 . "." . $ip4;
		} elseif ($ip4 != "") {
			$int = $ip4;
		}
		return $int;
	}

	//Renvoi la correction du res
	function CorrectionInt($value, $ip2, $ip3, $ip4)
	{
		$int = "";
		if ($value == "A") {
			$int = $ip2 . "." . $ip3 . "." . $ip4;
		} elseif ($value == "B") {
			$int = $ip3 . "." . $ip4;
		} elseif ($value == "C") {
			$int = $ip4;
		} else {
		}
		return $int;
	}

	//Renvoi la correction du masque de sous reseau
	function CorrectionMasqueSR($value)
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

	//convertit un masque en binaire
	function masqueEnIp($masque)
	{

		$masquebit = "";
		$masqueExplode = explode(".", $masque);
		$masquebit = base_convert($masqueExplode[0], 10, 2);
		$masquebit = $masquebit . base_convert($masqueExplode[1], 10, 2);
		$masquebit = $masquebit . base_convert($masqueExplode[2], 10, 2);
		$masquebit = $masquebit . base_convert($masqueExplode[3], 10, 2);
		while (strlen($masquebit) != 32) {
			$masquebit = $masquebit . "0";
		}
		return $masquebit;
	}

	//Renvoi la correction du Sres
	function CorrectionSRes($masque, $masquesr, $ip)
	{
		$ipbit = ipToBin($ip);
		$sres = "";
		$t = false;
		$s = false;
		$masquebit = masqueEnIp($masque);
		$masquesrbit = masqueEnIp($masquesr);
		for ($i = 0; $i < strlen($masquebit); $i++) {
			if ($masquebit[$i] != $masquesrbit[$i] && $t == false) {
				$j = $i;
				$t = true;
			}
			if ($masquebit[$i] == $masquesrbit[$i] && $t == true && $s == false) {
				$h = $i;
				$s = true;
			}
		}
		for ($i = $j; $i < $h; $i++) {
			$sres = $sres . $ipbit[$i];
		}

		return $sres;
	}

	//Convertit une IP en binaire
	function ipToBin($ip)
	{
		$ipbin = "";
		$ipExplode = explode(".", $ip);
		$ip1 = base_convert($ipExplode[0], 10, 2);
		$ip2 = base_convert($ipExplode[1], 10, 2);
		$ip3 = base_convert($ipExplode[2], 10, 2);
		$ip4 = base_convert($ipExplode[3], 10, 2);
		if (strlen($ip1) < 8) {
			while (strlen($ip1) != 8) {
				$ip1 = "0" . $ip1;
			}
		}
		if (strlen($ip2) < 8) {
			while (strlen($ip2) != 8) {
				$ip2 = "0" . $ip2;
			}
		}
		if (strlen($ip3) < 8) {
			while (strlen($ip3) != 8) {
				$ip3 = "0" . $ip3;
			}
		}
		if (strlen($ip4) < 8) {
			while (strlen($ip4) != 8) {
				$ip4 = "0" . $ip4;
			}
		}
		$ipbin = $ip1 . $ip2 . $ip3 . $ip4;
		return $ipbin;
	}

	//Renvoi la correction du Sint
	function CorrectionSInt($masque, $masquesr, $ip)
	{
		$ipbit = ipToBin($ip);
		$sint = "";
		$t = false;
		$masquebit = masqueEnIp($masque);
		$masquesrbit = masqueEnIp($masquesr);
		$j = 0;
		for ($i = 0; $i < strlen($masquebit); $i++) {
			if ($masquebit[$i] == 0 && $masquesrbit[$i] == 0 && $t == false) {
				$j = $i;
				$t = true;
			}
		}
		for ($i = $j; $i < strlen($ipbit); $i++) {
			$sint = $sint . $ipbit[$i];
		}
		return $sint;
	}

	//Renvoi la correction de @Sous Reseau
	function CorrectionIPSR($ip, $sint)
	{
		$ipbit = ipToBin($ip);
		$j = strlen($sint);
		$ipsr = substr($ipbit, 0, 32 - $j);
		while (strlen($ipsr) < 32) {
			$ipsr = $ipsr . "0";
		}
		return binToIp($ipsr);
	}

	//Renvoi la correction de @Broadcast de SR
	function CorrectionBroascastSR($ip, $sint)
	{
		$ipbit = ipToBin($ip);
		$j = strlen($sint);
		$brosr = substr($ipbit, 0, 32 - $j);
		while (strlen($brosr) < 32) {
			$brosr = $brosr . "1";
		}
		return binToIp($brosr);
	}

	//convertit un ip binaire en ip base 10
	function binToIp($ip)
	{
		$ipExplode = str_split($ip, 8);
		$ip1 = base_convert($ipExplode[0], 2, 10);
		$ip2 = base_convert($ipExplode[1], 2, 10);
		$ip3 = base_convert($ipExplode[2], 2, 10);
		$ip4 = base_convert($ipExplode[3], 2, 10);

		return $ip1 . "." . $ip2 . "." . $ip3 . "." . $ip4;
	}

	if (isset($_POST)) {

		$randIP = $_POST["randIP"];  //recuperation de l'ip
		$explodeIp = explode("/", $randIP);  
		if (isValidIP($explodeIp[0], $explodeIp[1])) { //si l'ip est valide

			$point = 0; //compteur de point

			$masqueCIDR = $explodeIp[1];

			$CreaIp = explode(".", $explodeIp[0]);
			$randIP1 = $CreaIp[0];
			$randIP2 = $CreaIp[1];
			$randIP3 = $CreaIp[2];
			$randIP4 = $CreaIp[3];
			$ip = $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4;

			$sousReseau = $_POST["sr"];

			$classe = $_POST["classe"];

			//recuperation du masque
			$masque1 = $_POST["masque1"];
			$masque2 = $_POST["masque2"];
			$masque3 = $_POST["masque3"];
			$masque4 = $_POST["masque4"];
			$masque = $masque1 . "." . $masque2 . "." . $masque3 . "." . $masque4;

			//recuperation du res
			$res1 = $_POST["res1"];
			$res2 = $_POST["res2"];
			$res3 = $_POST["res3"];
			$res4 = $_POST["res4"];
			$res = CreationRes($res1, $res2, $res3, $res4);

			//recuperation du int
			$int1 = $_POST["int1"];
			$int2 = $_POST["int2"];
			$int3 = $_POST["int3"];
			$int4 = $_POST["int4"];
			$int = Creationint($int1, $int2, $int3, $int4);

			//recuperation du reseau
			$reseau1 = $_POST["reseau1"];
			$reseau2 = $_POST["reseau2"];
			$reseau3 = $_POST["reseau3"];
			$reseau4 = $_POST["reseau4"];
			$reseau = $reseau1 . "." . $reseau2 . "." . $reseau3 . "." . $reseau4;

			//recuperation du broadcast
			$broadcast1 = $_POST["broadcast1"];
			$broadcast2 = $_POST["broadcast2"];
			$broadcast3 = $_POST["broadcast3"];
			$broadcast4 = $_POST["broadcast4"];
			$broadcast = $broadcast1 . "." . $broadcast2 . "." . $broadcast3 . "." . $broadcast4;

			//recuperation du masque de SR
			$masquesr1 = $_POST["msreseau1"];
			$masquesr2 = $_POST["msreseau2"];
			$masquesr3 = $_POST["msreseau3"];
			$masquesr4 = $_POST["msreseau4"];
			$masquesr = $masquesr1 . "." . $masquesr2 . "." . $masquesr3 . "." . $masquesr4;

			//recuperation du reseau SR
			$sreseau1 = $_POST["sreseau1"];
			$sreseau2 = $_POST["sreseau2"];
			$sreseau3 = $_POST["sreseau3"];
			$sreseau4 = $_POST["sreseau4"];
			$sreseau = $sreseau1 . "." . $sreseau2 . "." . $sreseau3 . "." . $sreseau4;

			//recuperation du broadcastSR
			$broadcastsr1 = $_POST["broadcastsr1"];
			$broadcastsr2 = $_POST["broadcastsr2"];
			$broadcastsr3 = $_POST["broadcastsr3"];
			$broadcastsr4 = $_POST["broadcastsr4"];
			$broadcastsr = $broadcastsr1 . "." . $broadcastsr2 . "." . $broadcastsr3 . "." . $broadcastsr4;

			//recuperation du sres
			$sres1 = $_POST["sres1"];
			$sres2 = $_POST["sres2"];
			$sres3 = $_POST["sres3"];
			$sres4 = $_POST["sres4"];
			$sres = $sres1 . $sres2 . $sres3 . $sres4;

			//recuperation du sint
			$sint1 = $_POST["sint1"];
			$sint2 = $_POST["sint2"];
			$sint3 = $_POST["sint3"];
			$sint4 = $_POST["sint4"];
			$sint = $sint1 . $sint2 . $sint3 . $sint4;

			//calcul des points
			$CorClasse = CorrectionClasse($randIP1);
			if ($CorClasse == $classe) {
				$point++;
			}
			$CorMasque = CorrectionMasque($CorClasse);
			if ($CorMasque == $masque) {
				$point++;
			}
			$CorRes = CorrectionRes($CorClasse, $randIP1, $randIP2, $randIP3);
			if ($CorRes == $res) {
				$point++;
			}
			$CorInt = CorrectionInt($CorClasse, $randIP2, $randIP3, $randIP4);
			if ($CorInt == $int) {
				$point++;
			}
			$CorReseau = CorrectionReseau($CorClasse, $randIP1, $randIP2, $randIP3);
			if ($CorReseau == $reseau) {
				$point++;
			}
			$CorBroadcast  = CorrectionBroascast($CorClasse, $randIP1, $randIP2, $randIP3);
			if ($CorBroadcast  == $broadcast) {
				$point++;
			}
			if (srIsValide($CorClasse, $masqueCIDR)) {
				$CorMasquesr = CorrectionMasqueSR($masqueCIDR);
				if ($CorMasquesr == $masquesr) {
					$point+=2;
				}
				$CorSRes = CorrectionSRes($CorMasque, $CorMasquesr, $ip);
				if ($CorSRes == $sres) {
					$point+=2;
				}
				$CorSInt = CorrectionSInt($CorMasque, $CorMasquesr, $ip);
				if ($CorSInt == $sint) {
					$point++;
				}
				$CorIpSr = CorrectionIPSR($ip, $CorSInt);
				if ($CorIpSr == $sreseau) {
					$point++;
				}
				$CorBroadcastSr = CorrectionBroascastSR($ip, $CorSInt);
				if ($CorBroadcastSr == $broadcastsr) {
					$point++;
				}
			}


			echo "<h1> Correction de  : $randIP </h1>";
	?>
		<div class="container-fluid">
			<div class="col-xs-6">
				<fieldset>
					<legend><h2>Correction</h2></legend>
					<h3>Classe : <?= $CorClasse ?></h3>
					<h3>Masque : <?= $CorMasque ?></h3>
					<h3>Res : <?= $CorRes ?></h3>
					<h3>Int : <?= $CorInt ?></h3>
					<h3>Adresse de réseau : <?= $CorReseau ?></h3>
					<h3>Adresse de broadcast : <?= $CorBroadcast ?></h3>
					<?php
					if (srIsValide($CorClasse, $masqueCIDR)) {
					?>
						<h3>Adresse de sous-réseau : <?= $CorIpSr ?></h3>
						<h3>Adresse de broacast de sous-réseau : <?= $CorBroadcastSr ?></h3>
						<h3>Masque de sous-réseau : <?= $CorMasquesr ?></h3>
						<h3>S-Res : <?= $CorSRes . "b" ?></h3>
						<h3>S-Int : <?= $CorSInt . "b" ?></h3>
					<?php
					}
					?>
				</fieldset>
			</div>
			<div class="col-xs-6">
				<fieldset>
					<legend><h2>Vos réponses</h2></legend>
					<h3>Classe : <?= $classe ?></h3>
					<h3>Masque : <?= $masque ?></h3>
					<h3>Res : <?= $res ?></h3>
					<h3>Int : <?= $int ?></h3>
					<h3>Adresse de réseau : <?= $reseau ?></h3>
					<h3>Adresse de broadcast : <?= $broadcast ?></h3>
					<?php
					if ($sousReseau == "oui") {
					?>
						<h3>Adresse de sous-réseau : <?= $sreseau ?></h3>
						<h3>Adresse de broacast de sous-réseau : <?= $broadcastsr ?></h3>
						<h3>Masque de sous-réseau : <?= $masquesr ?></h3>
						<h3>S-Res : <?= $sres . "b" ?></h3>
						<h3>S-Int : <?= $sint . "b" ?></h3>
					<?php
					}
					?>
				</fieldset>
			</div>
		</div>
			<?php
			if (!srIsValide($CorClasse, $masqueCIDR)) {
				if($point > 4) {
					echo "<h2>Bravo !</h2>";
				} else if ($point == 6){
					echo "<h2>Magnifique !</h2>";
				} else {
					echo "<h2>Vous pouvez faire mieux !</h2>";
				}
			?>
				<h2>Note : <?= $point ?> / 6</h2>
			<?php
			} else {
				if($point > 10 && $point != 13) {
					echo "<h2>Bravo !</h2>";
				} else if ($point == 13){
					echo "<h2>Magnifique !</h2>";
				} else {
					echo "<h2>Vous pouvez faire mieux !</h2>";
				}
			?>
				<h2>Note : <?= $point ?> / 13</h2>
			<?php
			}
			?>


	<?php
		} else {
			echo "L'ip et/ou le masque entrée est invalide, veuillez recommencer";
		}
	}
	?>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="choixCIDR">
        <input type="hidden" name="controller" value="ip">
        <input value="Recommencer avec une nouvelle IP" type="submit">
    </form>
</body>
</html>