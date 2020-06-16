<?php session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe','root',''); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/js" href="js/me-stp.js">

</head>
<body>
<?php
   if ($_SESSION["role"] == "eleve") {
      header("Location: mes_tp.php");
    }
?>
    <div class="row">
        <div class="col body-border">
        </div>
        <div class="col-8 container-body">
            <div class="topnav" id="myTopnav">
                <a href="mes_tp.php" class="active">MES TP</a>
                <a href="creer_tp.php" class="">CREER UN TP</a>
                <img class="img-user" src="img/user.png">
            </div>
            <div class="body ">
                <div class="header">
                    <h3>TP EN COURS</h3>
                </div>

                <div class="tab">
                  <button class="tablinks" onclick="openCity(event, 'London')">Publiés</button>
                  <button class="tablinks" onclick="openCity(event, 'Paris')">Non Publiés</button>
                  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Archivés</button>
                  <input type="text" name="rechercher" class="rechercher-bar" placeholder=" Rechercher">
                  <img class="img-rechercher" src="img/rechercher.png">
                </div>
                <!---Liste des TP-- -->
                <div class="mes_tp">

                    <div class="liste-tp">
                        <div id="London" class="tabcontent">
                          <div class="tp">
                            <img class="img-suivi-tp" src="img/suivi-tp.png">
                            <img class="img-archive" src="img/archive.png">
                            <div class="nom-tp-note">
                            <div class="nom-promo">
                              Promotion :
                            </div>
                            </div>
                            <!--<div class="">
                                <button onclick="myFunction('Demo1')" class="acordion-tp">Open Section 1</button>
                                <div id="Demo1" class="w3-container w3-hide">
                                    <h4>Section 1</h4>
                                    <p>Some text..</p>
                                </div>
                                -->
                        </div>

                        </div>
                    </div>






                        
                </div>

            </div>
        </div>
        <div class="col body-border"></div>
    </div>

<script>
    function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}</script>
</body>
</html>