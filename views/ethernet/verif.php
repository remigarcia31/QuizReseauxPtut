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
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link href="css/style_ethernet.css" rel="stylesheet" />
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <TITLE> Quiz Réseaux </TITLE>
    <link rel="icon" type="image/png" href="images/ethernet.png"> <!-- Icone dans l'onglet -->

</head>

<body>
    <?php
    $bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');

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

    <h1>Quizz ethernet : Connexion administrateur </h1>    
    <?php
    if(isset($_POST["pseudo"]) && isset($_POST["pwd"])) {
        if ($_POST["pseudo"] == "admin" && $_POST["pwd"] == "ptut123") {
            ?>
                            <form action="index.php" method="post">
                                <input hidden name="action" value="ajoutScenario">
                                <input hidden name="controller" value="Ethernet">
                                <input type="submit" value="Ajouter/consulter un scénario">
                            </form>
            <?php
        } else {
            ?>
            <form action="index.php" method="POST">
            <table class="container enonceScenario">
                <tr>
                    <th>Nom d'utilisateur :</th>
                    <td><input name="pseudo" type="text" placeholder="Veuillez rentrer l'identifiant administrateur" size="40" required></td>
                </tr>
                <tr>
                    <th>Mot de passe :</th>
                    <td><input name="pwd" type="password" placeholder="Veuillez rentrer le mot de passe" size="40" required></td>
                </tr>
            </table>
                <input hidden name="action" value="verif">
                <input hidden name="controller" value="Ethernet"> 
                <input type="submit" value="Valider">
            </form>
            <?php
            echo "<h2 class='faux'> Pseudo ou mot de passe incorrect ! </h2>";
        }
    } else {
        ?>
        <form action="index.php" method="POST">
        <table class="container enonceScenario">
            <tr>
                <th>Nom d'utilisateur :</th>
                <td><input name="pseudo" type="text" placeholder="Veuillez rentrer l'identifiant administrateur" size="40" required></td>
            </tr>
            <tr>
                <th>Mot de passe :</th>
                <td><input name="pwd" type="password" placeholder="Veuillez rentrer le mot de passe" size="40" required></td>
            </tr>
        </table>
            <input hidden name="action" value="verif">
            <input hidden name="controller" value="Ethernet"> 
            <input type="submit" value="Valider">
        </form>
        <?php
    }

    ?>

</BODY>

</HTML>