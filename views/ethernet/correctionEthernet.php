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
            </div>
        </div>
    </nav>
</header>

<div class="container-fluid">
    <br/>
    <br/>
    <h2>Correction</h2>
    <br/>
    <table class="container" border="2">
        <thead>
        <tr>
            <th><h1>Trames</h1></th>
            <th><h1>@ MAC dest</h1></th>
            <th><h1>@ MAC exp</h1></th>
            <th><h1>TYPE</h1></th>
            <th><h1>DATA</h1></th>
            <th><h1>FCS </h1></th>
        </tr>
        </thead>
        <?php

        if (isset($_POST['num_scenario'])) {
            $num_scenario = $_POST['num_scenario'];
        }

        $bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');
        $maRequete = $bdd->query("SELECT * FROM ethernet WHERE id_scenario = $num_scenario");

        $note = 0;

        while ($ligne = $maRequete->fetch()) {
        ?>
        <tr>
            <td>T1</td>
            <?php
            echo "<td>" . $ligne['macdest1'] . "</td>";
            echo "<td>" . $ligne['macdexp1'] . "</td>";
            echo "<td>" . $ligne['type1'] . "</td>";
            echo "<td>" . $ligne['data1'] . "</td>";
            echo "<td>" . $ligne['FCS1'] . "</td>";
            ?>
        </tr>
        <tr>
            <td>T3</td>
            <?php
            echo "<td>" . $ligne['macdest2'] . "</td>";
            echo "<td>" . $ligne['macdexp2'] . "</td>";
            echo "<td>" . $ligne['type2'] . "</td>";
            echo "<td>" . $ligne['data2'] . "</td>";
            echo "<td>" . $ligne['FCS2'] . "</td>";
            echo "</tr>";
            ?>

    </table>
    <br/>
    <br/>
    <br/>
    <h2>Votre réponse</h2>
    <br/>
    <table class="container" border="2">
        <thead>
        <tr>
            <th><h1>Trames</h1></th>
            <th><h1>@ MAC dest</h1></th>
            <th><h1>@ MAC exp</h1></th>
            <th><h1>TYPE</h1></th>
            <th><h1>DATA</h1></th>
            <th><h1>FCS </h1></th>
        </tr>
        </thead>
        <tr>
            <td>T1</td>

            <?php
            if ($_POST['macdest1'] == $ligne['macdest1']) {
                echo "<td><p class=\"correct\";>" . $_POST['macdest1'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['macdest1'] . "</p></td>";
            }

            if ($_POST['macexp1'] == $ligne['macdexp1']) {
                echo "<td><p class=\"correct\";>" . $_POST['macexp1'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['macexp1'] . "</p></td>";
            }

            if ($_POST['type1'] == $ligne['type1']) {
                echo "<td><p class=\"correct\";>" . $_POST['type1'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['type1'] . "</p></td>";
            }

            if ($_POST['data1'] == $ligne['data1']) {
                echo "<td><p class=\"correct\";>" . $_POST['data1'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['data1'] . "</p></td>";
            }

            if ($_POST['fcs1'] == $ligne['FCS1']) {
                echo "<td><p class=\"correct\";>" . $_POST['fcs1'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['fcs1'] . "</p></td>";
            }
            ?>
        </tr>
        <tr>
            <td>T3</td>
            <?php
            if ($_POST['macdest2'] == $ligne['macdest2']) {
                echo "<td><p class=\"correct\";>" . $_POST['macdest2'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['macdest2'] . "</p></td>";
            }

            if ($_POST['macexp2'] == $ligne['macdexp2']) {
                echo "<td><p class=\"correct\";>" . $_POST['macexp2'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['macexp2'] . "</p></td>";
            }

            if ($_POST['type2'] == $ligne['type2']) {
                echo "<td><p class=\"correct\";>" . $_POST['type2'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['type2'] . "</p></td>";
            }

            if ($_POST['data2'] == $ligne['data2']) {
                echo "<td><p class=\"correct\";>" . $_POST['data2'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['data2'] . "</p></td>";
            }

            if ($_POST['fcs2'] == $ligne['FCS2']) {
                echo "<td><p class=\"correct\";>" . $_POST['fcs2'] . "</td>";
                $note++;
            } else {
                echo "<td><p class=\"faux\";>" . $_POST['fcs2'] . "</p></td>";
            }
            }
            ?>
        </tr>
    </table>
    </form>

    <?php

    echo "<h2> Vous avez eu $note/10 </h2>";
    ?>
    <br/>
    <form action="index.php" method="post">
        <input hidden name="action" value="ethernet">
        <input hidden name="controller" value="Ethernet">
        <input type="submit" value="Réessayer">
    </form>

</div>

</footer>
</BODY>
</HTML>