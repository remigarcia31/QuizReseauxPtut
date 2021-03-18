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

    spl_autoload_extensions(".php");
    spl_autoload_register();

    use yasmf\DataSource;
    use yasmf\HttpHelper;

    $bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');
    $max = $bdd->prepare("SELECT MAX(id_scenario) AS max_id FROM ethernet");
    $max->execute();
    $invNum = $max->fetch(PDO::FETCH_ASSOC);
    $max_id = $invNum['max_id'];

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

    <h1> Quiz Ethernet : Ajout de scénario </h1>

    <?php
    $nbScenario = $bdd->query("SELECT COUNT(*) as nombre FROM ethernet"); //on récupère le total des requetes pour pouvoir les afficher plus tard
    $requete = $nbScenario->fetch();
    $nombreScenarios = $requete["nombre"];
    $idScenarioAAjouter = ++$nombreScenarios;

    if (isset($_POST)) {
        if (isset($_POST["supprimerScenar"])) { //Si l'utilisateur à cliqué sur un des boutons pour supprimer le scénario
            $ScenarioDelete = $_POST["supprimerScenar"];
            $delete = $bdd->query("DELETE FROM ethernet WHERE id_scenario = $ScenarioDelete");

            $max = $bdd->query("SELECT MAX(id_scenario) AS scenarioMax FROM ethernet");
            $changeIdScenar = $bdd->query("UPDATE ethernet SET id_scenario = $ScenarioDelete WHERE id_scenario = $max_id");

            echo "<h2 class='correct'> Le scénario à bien été supprimé ! </h2>";
        } else if (isset($_POST["scenario"])) { //si l'utilisateur à cliqué sur le bouton pour ajouter un scénario
            $scenario = $_POST['scenario']; //transformations des $_POST en variables pour les inserer dans la base de données
            $macdest1 = $_POST['macdest1'];
            $macdexp1 = $_POST['macdexp1'];
            $type1 = $_POST['type1'];
            $data1 = $_POST['data1'];
            $FCS1 = $_POST['FCS1'];
            $FCS2 = $_POST['FCS2'];
            $macdest2 = $_POST['macdest2'];
            $macdexp2 = $_POST['macdexp2'];
            $type2 = $_POST['type2'];
            $data2 = $_POST['data2'];
            $T1 = $_POST['T1'];
            $T2 = $_POST['T2'];
            $T3 = $_POST['T3'];
            $T1M1 = $_POST['T1M1'];
            $T1M2 = $_POST['T1M2'];
            $T2M1 = $_POST['T2M1'];
            $T2M2 = $_POST['T2M2'];
            $T3M1 = $_POST['T3M1'];
            $T3M2 = $_POST['T3M2'];
            $T1temps = $_POST['T1temps'];
            $T2temps = $_POST['T2temps'];
            $T3temps = $_POST['T3temps'];
            //On insère toutes les données fournie par l'utilisateur pour les stocker dans la bdd avec un INSERT INTO
            if ($bdd->query("INSERT INTO ethernet (id_scenario,scenario,macdest1, macdexp1, type1, data1, FCS1, FCS2, macdest2, macdexp2, type2, data2, T1, T2, T3 ,T1M1, T1M2, T2M1, T2M2, T3M1, T3M2, T1temps, T2temps,T3temps) VALUES('$idScenarioAAjouter','$scenario','$macdest1','$macdexp1','$type1','$data1','$FCS1','$FCS2','$macdest2','$macdexp2','$type2','$data2','$T1','$T2','$T3','$T1M1','$T1M2','$T2M1','$T2M2','$T3M1','$T3M2','$T1temps','$T2temps','$T3temps')") == TRUE) {
                echo "<h2 class='correct'> Le scénario à bien été crée ! </h2>";
            }
        }
    }

    ?>
    <h1> Ajouter un scénario </h1>
    <form action="index.php" method="post" class="container bordureForm">
        <!-- affichage du formulaire à remplir pour ajouter un scénario-->
        <table class="container enonceScenario">
            <tr>
                <td>
                    <h2>Enoncé du scénario :</h2>
                </td>
                <td><textarea id=scenario class="text" cols="50" rows="10" name=scenario required></textarea></td>
            </tr>
        </table>
        <table class="container ajoutScenario">
            <thead>
                <tr>
                    <th>
                        <h3>Trames</h3>
                    </th>
                    <th>
                        <h3>@ MAC dest</h3>
                    </th>
                    <th>
                        <h3>@ MAC exp</h3>
                    </th>
                    <th>
                        <h3>TYPE</h3>
                    </th>
                    <th>
                        <h3>DATA</h3>
                    </th>
                    <th>
                        <h3>FCS </h3>
                    </th>
                </tr>
            </thead>
            <tbody>

                <h1>Remplissez la correction des trames : </h1>

                <tr>
                    <td>Trame n°1</td>
                    <td><input type="text" name="macdest1" required /></td>
                    <td><input type="text" name="macdexp1" required /></td>
                    <td><input type="text" name="type1" required /></td>
                    <td><input type="text" name="data1" required /></td>
                    <td><input type="text" name="FCS1" required /></td>
                </tr>
                <tr>
                    <td>Trame n°2</td>
                    <td><input type="text" name="macdest2" required /></td>
                    <td><input type="text" name="macdexp2" required /></td>
                    <td><input type="text" name="type2" required /></td>
                    <td><input type="text" name="data2" required /></td>
                    <td><input type="text" name="FCS2" required /></td>
                </tr>
            </tbody>
        </table>
        <table class="container ajoutScenario">
            <thead>
                <h1>Remplissez la correction pour les chronogrammes : </h1>
                <tr>
                    <th></th>
                    <th>Trame envoyée</th>
                    <th>Machine envoyant la trame</th>
                    <th>Machine recevant la trame</th>
                    <th>Temps (en µs) du transfert de données de la trame</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Trame n°1</td>
                    <td><input type="text" name="T1" required /></td>
                    <td><input type="text" name="T1M1" required /></td>
                    <td><input type="text" name="T1M2" required /></td>
                    <td><input type="text" name="T1temps" required /></td>
                </tr>
                <tr>
                    <td>Trame n°2</td>
                    <td><input type="text" name="T2" required /></td>
                    <td><input type="text" name="T2M1" required /></td>
                    <td><input type="text" name="T2M2" required /></td>
                    <td><input type="text" name="T2temps" required /></td>
                </tr>
                <tr>
                    <td>Trame n°3</td>
                    <td><input type="text" name="T3" required /></td>
                    <td><input type="text" name="T3M1" required /></td>
                    <td><input type="text" name="T3M2" required /></td>
                    <td><input type="text" name="T3temps" required /></td>
                </tr>
            </tbody>
        </table>
        <input hidden name="action" value="ajoutScenario">
        <input hidden name="controller" value="Ethernet">
        <input type="submit" value="Ajouter le scénario">
    </form>


    <h1> Affichage des scénarios existants</h1>
    <?php
    //Boucle for pour afficher tous les scénarios existants dans la base de données
    echo "------------------------------";
    for ($i = 1; $i <= $nombreScenarios; $i++) {
        $maRequete = $bdd->query("SELECT * FROM ethernet WHERE id_scenario = $i");
        $affichageScenario = $maRequete->fetch();
        if ($affichageScenario["scenario"] != "") {
            echo "<h2> Scénario n°$i</h2>";
            // restriction concernant la suppression des scénario
            //impossible de supprimer les trois premiers scénarios pour permettre au site son bon déroulement
            echo $affichageScenario['scenario'];
            if ($i > 3) {
    ?>
                <form action="index.php" method="post">
                    <input hidden name="action" value="ajoutScenario">
                    <input hidden name="controller" value="ethernet">
                    <input hidden name="supprimerScenar" value="<?php echo "$i"; ?>">
                    <input type="submit" value="Supprimer scénario">
                </form>
    <?php
            }
            echo "------------------------------";
        }
    }
    ?>


</BODY>

</HTML>