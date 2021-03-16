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
                        <!-- Bouton pour aller à l'accueil -->
                        <form action="index.php" method="post">
                            <input hidden name="action" value="">
                            <input hidden name="controller" value="">
                            <input type="submit" value="Accueil">
                        </form>
                    </li>
                    <li>
                        <!-- Bouton pour aller à la page IP -->
                        <form action="index.php" method="post">
                            <input hidden name="action" value="choixCIDR">
                            <input hidden name="controller" value="Ip">
                            <input type="submit" value="IP">
                        </form>
                    </li>
                    <li>
                        <!-- Bouton pour aller à la page Ethernet -->
                        <form action="index.php" method="post">
                            <input hidden name="action" value="ethernet">
                            <input hidden name="controller" value="Ethernet">
                            <input type="submit" value="Ethernet">
                        </form>
                    </li>
                    <li>
                        <!-- Bouton pour aller à la page contact -->
                        <form action="index.php" method="post">
                            <input hidden name="action" value="contact">
                            <input hidden name="controller" value="">
                            <input type="submit" value="Contact">
                        </form>
                    </li>
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
// TODO mettre toutes les fonctions dans services/fonctionsIP.php et les appeler ensuite 
// TODO optimiser le code
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
$tableauA = array(8 => 8, 10 => 10, 14 => 14);
$tableauB = array(16 => 16, 20 => 20, 22 => 22);
$tableauC = array(24 => 24, 28 => 28, 30 => 30);

if ($randIP1 <= 126) { // classe A
    $randMask = array_rand($tableauA, 1);
} elseif ($randIP1 <= 191) { // classe B
    $randMask = array_rand($tableauB, 1);
} elseif ($randIP1 <= 223) { // class C
    $randMask = array_rand($tableauC, 1);
}
$randIP = $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4 . "/" . $randMask;

?>


<h1>Quiz IP</h1>
<h2>Donnez les informations suivantes à l'aide de cette adresse IP :</h2>

<h2><span class="encadrer-un-contenu">
                <?php if (isset($_POST["typeMasque"])) {
                    $typeMasque = $_POST["typeMasque"];
                    if ($typeMasque == "ACIDR") {
                        echo $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4 . "/" . $randMask;
                    } else if ($typeMasque == "SCIDR") {
                        echo $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4;
                        echo " | " . $masqueCIDR = masqueCIDR($randMask);
                    }
                } ?> 
            </span>
    <h4>
        </br>
        <img src="images/f5.png" alt="" height="30px"
             width="30px" Onclick="javascript:window.history.go(0)"/>
    </h4>
</h2>
<?php echo '<form action="index.php" method="post">'; ?>
<?php
if (isset($_POST["typeMasque"])) {
    $typeMasque = $_POST["typeMasque"];
    if ($typeMasque == "ACIDR") {
        ?>
        <div> Ip à analyser (vous pouvez la changer) :</div>
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
<input type="text" name="masque1" onkeypress="return isNumberKey(event)" maxlength="3" size="3" required/> .
<input type="text" name="masque2" onkeypress="return isNumberKey(event)" maxlength="3" size="3" required/> .
<input type="text" name="masque3" onkeypress="return isNumberKey(event)" maxlength="3" size="3" required/> .
<input type="text" name="masque4" onkeypress="return isNumberKey(event)" maxlength="3" size="3" required/>
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

<input type="hidden" name="action" value="correctionIP">
<input type="hidden" name="controller" value="ip">
<input type="hidden" name="randMasque" value="<?php echo "" . $randMask . "" ?>"></input>
<input type="submit" value="Envoyer la réponse">

</form>

</body>


</html>

