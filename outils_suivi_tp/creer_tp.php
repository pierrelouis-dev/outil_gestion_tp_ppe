<?php session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_gestion_tp_ppe','root',''); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <h3>CREER UN TP</h3>
                </div>
                <span class="sous-titre-page">Interface de création</span>
                <!---Liste des TP-- -->
               <div class="interface-creation">
                   <form method="POST" action="">
                       <div class="form-interface">
                           <!--INPUT NOM-->
                           <div class="champs-creation">
                                   <!--INPUT Titre du TP-->

                               <table>
                                <div class="first_form">
                                  <div class="title_tp">
                                   <label>Titre du TP</label>
                                   <input type="text" name="titre_tp" class="champs champs-titre-tp" id="titre_tp">
                                   </div>
                                   <!--INPUT promo-->
                                   <div class="div_promo">
                                      <label for="label_promo">Séléction de la promotion</label>
                                      <select name="select_promo" id="select_promo">
                                          <option value="">Promotions</option>
                                          <option value="sio_1">Sio 1</option>
                                          <option value="sio_2">Sio 2</option>
                                      </select>
                                    </div>
                                    <!--INPUT option-->
                                    <div class="div_option">
                                      <label for="label_option">Séléction de l'option</label>
                                      <select name="select_option" id="select_option">
                                          <option value="">Options</option>
                                          <option value="slam">SLAM</option>
                                          <option value="sisr">SISR</option>
                                      </select>
                                     </div>
                                       <div class="date-form">
                                         <div class="date_start">
                                          <label class="label_start" for="start">Date de début</label>
                                          <input type="date" id="start" name="trip-start" value="2020-05-14" min="2020-01-01" max="2020-12-31">
                                        </div>
                                        <div class="date_end">
                                          <label for="start">Date de fin</label>
                                          <input type="date" id="label_end" name="trip-start" value="2020-05-14" min="2020-01-01" max="2020-12-31">
                                        </div>
                                    </div>
                                  </div>
                               </table>

                               <input type="submit" name="btn-creer" value="creer" class="btn-connecter">
                               <div class="error creation">
                                   <?php
                                   if (isset($erreur))
                                   {
                                       echo $erreur;
                                   }

                                   ?>
                               </div>


                           </div>
                       </div>
                   </form>
               </div>

                </div>
            </div>
            <div class="col body-border"></div>
        </div>
        
    </div>


</body>
</html>