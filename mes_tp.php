<?php session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe', 'root', '');?>
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
                    <h3>MES TP</h3>
                </div>
                <span class="sous-titre-page">Liste de vos tp en cours</span>
                <!---Liste des TP-- -->
                <div class="mes_tp">
                <?php

                $requser = $bdd->prepare("SELECT * FROM tp");
                    while ($infouser = $requser->fetch())
                    {
                        ?>

                    <div class="liste-tp">
                        <div class="tp">
                        <span> <?php echo $infouser['libelle_tp']; ?> </span>
                                <span><?php echo $infouser['note_tp']; ?>/20</span>
                        </div>
                            
                    </div>






                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col body-border"></div>
    </div>
</body>
</html>