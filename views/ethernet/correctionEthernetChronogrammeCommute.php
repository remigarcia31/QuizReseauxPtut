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

    <div class="container-fluid">
        <br />
        <br />
        <h2>Correction</h2>
        <br />
        <table class="container">
            <THEAD>
                <?php

                if (isset($_POST['num_scenario'])) {
                    $num_scenario = $_POST['num_scenario'];
                }

                $bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');
                $maRequete = $bdd->query("SELECT * FROM ethernet WHERE id_scenario = $num_scenario");

                $note = 0;
                //affichage de la correction du scénario sur lequel l'utilisateur à travaillé
                while ($ligne = $maRequete->fetch()) {
                ?>
                    <tr>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3>
                                <?php
                                echo $ligne['T1M1'];
                                echo "<img src=\"images/petitefleche.png\" height=\"30px\" width=\"50px\">";
                                echo $ligne['T1M2'];
                                ?>
                            </h3>
                        </th>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3>
                                <?php
                                echo $ligne['T2M1'];
                                echo "<img src=\"images/petitefleche.png\" height=\"30px\" width=\"50px\">";
                                echo $ligne['T2M2'];
                                ?>
                            </h3>
                        </th>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3>
                                <?php
                                echo $ligne['T3M1'];
                                echo "<img src=\"images/petitefleche.png\" height=\"30px\" width=\"50px\">";
                                echo $ligne['T3M2'];
                                ?>
                            </h3>
                        </th>

                    <tr>
                        <td></td>
                        <?php
                        echo "<td>" . $ligne['T1'] . "</td>";
                        ?>
                        <td></td>
                        <?php
                        echo "<td>" . $ligne['T2'] . "</td>";
                        ?>
                        <td></td>
                        <?php
                        echo "<td>" . $ligne['T3'] . "</td>";
                        ?>
                    </tr>
        </table>
        <table>
            <img src="images/grandefleche.png" height="50px" width="1600px">
            <table class="container">
                <tr>
                    <td></td>
                    <?php
                    echo "<td>" . $ligne['T1temps'] . "μs</td>";
                    ?>
                    <td></td>
                    <?php
                    echo "<td>" . $ligne['T2temps'] . "μs</td>";
                    ?>
                    <td></td>
                <?php
                    echo "<td>" . $ligne['T3temps'] . "μs</td>";
                }
                ?>
                </tr>
                </tbody>

            </table>
            </THEAD>
        </table>
        </form>
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        <br />
        <br />
        <h2>Votre réponse </h2>
        <br />
        <!-- affichage de la réponse de l'utilisateur-->
        <table class="container">
            <THEAD>
                <tr>
                    <th>
                        <h3></h3>
                    </th>
                    <th>
                        <h3>
                            <?php
                            echo $_POST['T1M1'];
                            echo "<img src=\"images/petitefleche.png\" height=\"30px\" width=\"50px\">";
                            echo $_POST['T1M2'];
                            ?>
                        </h3>
                    </th>
                    <th>
                        <h3></h3>
                    </th>
                    <th>
                        <h3>
                            <?php
                            echo $_POST['T2M1'];
                            echo "<img src=\"images/petitefleche.png\" height=\"30px\" width=\"50px\">";
                            echo $_POST['T2M2'];
                            ?>
                        </h3>
                    </th>
                    <th>
                        <h3></h3>
                    </th>
                    <th>
                        <h3>
                            <?php
                            echo $_POST['T3M1'];
                            echo "<img src=\"images/petitefleche.png\" height=\"30px\" width=\"50px\">";
                            echo $_POST['T3M2'];
                            ?>
                        </h3>
                    </th>

                <tr>
                    <td></td>
                    <?php
                    echo "<td>" . $_POST['T1'] . "</td>";
                    ?>
                    <td></td>
                    <?php
                    echo "<td>" . $_POST['T2'] . "</td>";
                    ?>
                    <td></td>
                    <?php
                    echo "<td>" . $_POST['T3'] . "</td>";
                    ?>
                </tr>
        </table>
        <table>
            <img src="images/grandefleche.png" height="50px" width="1600px">
            <table class="container">
                <tr>
                    <td></td>
                    <?php
                    echo "<td>" . $_POST['t1temps'] . "μs</td>";
                    ?>
                    <td></td>
                    <?php
                    echo "<td>" . $_POST['t2temps'] . "μs</td>";
                    ?>
                    <td></td>
                    <?php
                    echo "<td>" . $_POST['t3temps'] . "μs</td>";

                    ?>
                </tr>
                </tbody>

            </table>
            </THEAD>
        </table>

        <?php
        //affichage de la note obtenue par l'utilisateur (sur 10)
        echo "<h2> Vous avez eu $note/10 </h2>";
        ?>
        <br />
        <!-- bouton qui ramène au choix du quizz ethernet -->
        <form action="index.php" method="post">
            <input hidden name="action" value="ethernet">
            <input hidden name="controller" value="Ethernet">
            <input type="submit" value="Réessayer">
        </form>

    </div>

    </footer>
</BODY>

</HTML>