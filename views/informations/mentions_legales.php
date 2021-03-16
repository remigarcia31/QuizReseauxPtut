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
    <link href="css/style_mentions_donnees.css" rel="stylesheet"/>
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

<section>
    <p>
    <div class="container_fluid"> <!--Bande centrale-->
        <div class="img_fond col-xs-12 center">
            <br/><br/>
            <h1>Mentions légales</h1>
            <br/>
            <h3>Consultez les mentions légales
                <br/>Informations concernant le site web et le groupe de projet.</h3>
            <br/><br/><br/>
        </div>
    </div>
    </p>
    <div class="container"> <!--Container contenant les mentions légales du site internet-->
        <div class="texte">
            <h2>Propriété intellectuelle</h2>
            <p>Le site internet n'accepte pas et ne reçoit pas de fonds publicitaires.<br/>
                Tout le contenu du site <a target="_blank" href="http://ptutquizz.alwaysdata.net/">http://ptutquizz.alwaysdata.net/</a>
                est libre de droit.<br/>
                Les icones sont des images libres de droit récupérés sur le site <a target="_blank"
                                                                                    href="https://www.flaticon.com/">https://www.flaticon.com/</a>
                Toute reproduction, distribution, modification, retransmission ou publication de ces différents éléments
                est autorisée.
                <br/><br/><br/>
            <h2>Confidentialité des données personnelles</h2>
            Les informations personnelles que vous fournissez sur le site, sont confidentielles.
            Nous nous engageons sur l’honneur à respecter les conditions légales de confidentialité applicables en
            France et à ne pas divulguer ces informations à des tiers.
            <br/><br/><br/>
            <h2>Hébergement</h2>
            SARL Alwaysdata - 91 rue du Faubourg Saint Honoré - 75008 Paris FRANCE
            <br/><br/><br/>
            <h2>Responsable de publication</h2>
            Thomas GAFFET
            </p>
        </div>
    </div>
</section>
</body>
</HTML>
