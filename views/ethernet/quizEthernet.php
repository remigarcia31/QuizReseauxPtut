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
                <!-- CONNEXION / INSCRIPTION A METTRE EN PLACE A LA FIN
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="pages/inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
                        <li><a href="pages/connexion.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
                      </ul>-->
            </div>
        </div>
    </nav>
</header>

<h1> Quiz Ethernet</h1>
<div class="container-fluid">
    <br/>
    <br/>
    <div>
        <?php
        $bdd = new PDO("mysql:host=mysql-ptutquizz.alwaysdata.net;dbname=ptutquizz_bd", 'ptutquizz', 'ptut123');
        $nbScenario = $bdd->query("SELECT COUNT(*) as nombre FROM ethernet");
        $requete = $nbScenario->fetch();
        $nombreScenarios = $requete["nombre"];
        $num_scenario = rand(1, $nombreScenarios); //A MODIFIER EN FONCTION DU NOMBRE DE SCENARIOS DISPONIBLES
        $leScenario = $bdd->query("SELECT scenario FROM ethernet WHERE id_scenario = $num_scenario");
        /* On récupère l'information*/
        $scene = $leScenario->fetch();
        echo $scene['scenario'];
        ?>
    </div>
    <br/>
    <br/>
    <br/>
    <?php
    if (isset($_POST["typeEthernet"])) {
        $typeEthernet = $_POST["typeEthernet"];
        $typeChrono = $_POST["typeChrono"];
    }
    if ($typeEthernet == "TRAMES") {
        //on affiche la trame à résoudre si l'user à choisit la trame ?>
        <form action="index.php" method="post">
            <input hidden name="action" value="correction">
            <input hidden name="controller" value="ethernet">
            <table class="container" border="2">
                <thead>
                <tr>
                    <th><h3>Trames</h3></th>
                    <th><h3>@ MAC dest</h3></th>
                    <th><h3>@ MAC exp</h3></th>
                    <th><h3>TYPE</h3></th>
                    <th><h3>DATA</h3></th>
                    <th><h3>FCS </h3></th>
                </tr>
                </thead>
                <tbody>

                <h1>Complétez la trame suivante : </h1>

                <tr>
                    <td>T1</td>
                    <td><input type="text" name="macdest1" required/></td>
                    <td><input type="text" name="macexp1" required/></td>
                    <td><input type="text" name="type1" required/></td>
                    <td><input type="text" name="data1" required/></td>
                    <td><input type="text" name="fcs1" required/></td>
                </tr>
                <tr>
                    <td>T3</td>
                    <td><input type="text" name="macdest2" required/></td>
                    <td><input type="text" name="macexp2" required/></td>
                    <td><input type="text" name="type2" required/></td>
                    <td><input type="text" name="data2" required/></td>
                    <td><input type="text" name="fcs2" required/></td>
                </tr>
                </tbody>

            </table>
            <input name="num_scenario" value="<?php echo $num_scenario; ?>" hidden>
            <input type="submit" value="Envoyer la réponse">
        </form>

        <?php
    } else if ($typeEthernet == "CHRONO" && $typeChrono == "PARTAGE") {
        ?>
        <!-- completer et rajouter l'affichage d'un chronogramme à résoudre -->
        <form action="index.php" method="post">
            <input hidden name="action" value="correctionChronogramme">
            <input hidden name="controller" value="Ethernet">
            <table class="container">
                <thead>
                <tr>
                    <th><h3></h3></th>
                    <th>
                        <h3>
                            <select class="machine" name="T1M1">
                                <option value=""></option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="M3">M3</option>
                                <option value="M4">M4</option>
                            </select>
                            <img src="images/petitefleche.png" height="30px" width="50px">
                            <select class="machine" name="T1M2">
                                <option value=""></option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="M3">M3</option>
                                <option value="M4">M4</option>
                            </select>
                        </h3>
                    </th>
                    <th><h3></h3></th>
                    <th>
                        <h3>
                            <select class="machine" name="T2M1">
                                <option value=""></option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="M3">M3</option>
                                <option value="M4">M4</option>
                            </select>
                            <img src="images/petitefleche.png" height="30px" width="50px">
                            <select class="machine" name="T2M2">
                                <option value=""></option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="M3">M3</option>
                                <option value="M4">M4</option>
                            </select>
                        </h3>
                    </th>
                    <th><h3></h3></th>
                    <th>
                        <h3>
                            <select class="machine" name="T3M1">
                                <option value=""></option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="M3">M3</option>
                                <option value="M4">M4</option>
                            </select>
                            <img src="images/petitefleche.png" height="30px" width="50px">
                            <select class="machine" name="T3M2">
                                <option value=""></option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="M3">M3</option>
                                <option value="M4">M4</option>
                            </select>
                        </h3>
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <td><select class="machine" name="T1">
                            <option value=""></option>
                            <option value="T1">T1</option>
                            <option value="T2">T2</option>
                            <option value="T3">T3</option>
                        </select></td>
                    <td></td>
                    <td><select class="machine" name="T2">
                            <option value=""></option>
                            <option value="T1">T1</option>
                            <option value="T2">T2</option>
                            <option value="T3">T3</option>
                        </select></td>
                    <td></td>
                    <td><select class="machine" name="T3">
                            <option value=""></option>
                            <option value="T1">T1</option>
                            <option value="T2">T2</option>
                            <option value="T3">T3</option>
                        </select></td>
                </tr>
                </thead>

                <tbody>

                <h1>Complétez le chronogramme suivant : </h1>
            </table>
            <img src="images/grandefleche.png" height="50px" width="1600px">
            <table class="container">
                <tr>
                    <td></td>
                    <td><input type="text" name="t1temps" required/>μs</td>
                    <td></td>
                    <td><input type="text" name="t2temps" required/>μs</td>
                    <td></td>
                    <td><input type="text" name="t3temps" required/>μs</td>
                </tr>
                </tbody>

            </table>
            <input name="num_scenario" value="<?php echo $num_scenario; ?>" hidden>
            <input type="submit" value="Envoyer la réponse">
        </form>
        <?php
    } else if ($typeEthernet == "CHRONO" && $typeChrono == "COMMUTE") {
        ?>
        <!-- completer et rajouter l'affichage d'un chronogramme à résoudre -->
        <form action="index.php" method="post">
            <input hidden name="action" value="correction">
            <input hidden name="controller" value="ethernet">
            <table class="container">
                <thead>
                <tr>
                    <th><h3></h3></th>
                    <th>
                        <h3>
                            <select class="machine">
                                <option value="volvo">M1</option>
                                <option value="saab">M2</option>
                                <option value="opel">M3</option>
                                <option value="audi">M4</option>
                            </select>
                            <img src="images/petitefleche.png" height="30px" width="50px">
                            <select class="machine">
                                <option value="volvo">M1</option>
                                <option value="saab">M2</option>
                                <option value="opel">M3</option>
                                <option value="audi">M4</option>
                            </select>
                        </h3>
                    </th>
                    <th><h3></h3></th>
                    <th>
                        <h3>
                            <select class="machine">
                                <option value="volvo">M1</option>
                                <option value="saab">M2</option>
                                <option value="opel">M3</option>
                                <option value="audi">M4</option>
                            </select>
                            <img src="images/petitefleche.png" height="30px" width="50px">
                            <select class="machine">
                                <option value="volvo">M1</option>
                                <option value="saab">M2</option>
                                <option value="opel">M3</option>
                                <option value="audi">M4</option>
                            </select>
                        </h3>
                    </th>
                    <th><h3></h3></th>
                </tr>
                <tr>
                    <td></td>
                    <td><select class="machine">
                            <option value="volvo">T1</option>
                            <option value="saab">T2</option>
                            <option value="opel">T3</option>
                        </select></td>
                    <td></td>
                    <td><select class="machine">
                            <option value="volvo">T1</option>
                            <option value="saab">T2</option>
                            <option value="opel">T3</option>
                        </select></td>
                    <td></td>
                </tr>
                </thead>
                <tbody>

                <h1>Complétez les chronogrammes suivant : </h1>
            </table>
            <img src="images/grandefleche.png" height="50px" width="1600px">
            <table class="container">
                <tr>
                    <td></td>
                    <td><input type="text" name="macdest1" required/>μs</td>
                    <td></td>
                    <td><input type="text" name="type1" required/>μs</td>
                    <td></td>
                </tr>
                </tbody>

            </table>

            <table class="container">
                <thead>
                <tr>
                    <th><h3></h3></th>
                    <th>
                        <h3>
                            <select class="machine">
                                <option value="volvo">M1</option>
                                <option value="saab">M2</option>
                                <option value="opel">M3</option>
                                <option value="audi">M4</option>
                            </select>
                            <img src="images/petitefleche.png" height="30px" width="50px">
                            <select class="machine">
                                <option value="volvo">M1</option>
                                <option value="saab">M2</option>
                                <option value="opel">M3</option>
                                <option value="audi">M4</option>
                            </select>
                        </h3>
                    </th>
                    <th><h3></h3></th>
                </tr>
                <tr>
                    <td></td>
                    <td><select class="machine">
                            <option value="volvo">T1</option>
                            <option value="saab">T2</option>
                            <option value="opel">T3</option>
                        </select></td>
                </tr>
                </thead>
                <tbody>
            </table>
            <img src="images/grandefleche.png" height="50px" width="1600px">
            <table class="container">
                <tr>
                    <td></td>
                    <td><input type="text" name="macdest1" required/>μs</td>
                    <td></td>
                </tr>
                </tbody>

            </table>

            <input name="num_scenario" value="<?php echo $num_scenario; ?>" hidden>
            <input type="submit" value="Envoyer la réponse">
        </form>
        <?php
    }
    ?>
</div>

</BODY>
</HTML>