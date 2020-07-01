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
<?php
/** REDIRECTION SI PROF */
if ($_SESSION["role"] == "prof") {
    header("Location: tp_en_cours.php");
}

    $user_promo = $_SESSION['fk_id_promo'];
    $requser = $bdd->prepare("SELECT * FROM tp WHERE fk_id_promotion = :promoe ");
    $requser->bindParam('promoe', $user_promo);
    $requser->execute();


?>

    <div class="row">
        <div class="col body-border">
        </div>
        <div class="col-8 container-body">
            <div class="topnav" id="myTopnav">
                <a href="mes_tp.php" class="active">MES TP</a>
                <a href="deconnexion.php" class="">Se déconnecter </a>
                <img class="img-user" src="img/user.png">
            </div>
            <div class="body">
                <div class="header">
                    <h3>MES TP</h3>
                </div>
                <span class="sous-titre-page">Liste de vos tp en cours</span>
                <!---Liste des TP-- -->
                <div class="mes_tp">
                <?php
                    while ($infouser = $requser->fetch())
                    {
                        ?>

                    <div class="liste-tp">
                        <div class="tp">
                        <span> <?=$infouser['libelle_tp']; ?> </span> <br>
                        <span> <?=$infouser['desc_tp']; ?> </span> <br>
                        <span> <?=$infouser['dte_deb']; ?> </span>
                        <span> <?=$infouser['dte_fin']; ?> </span>
                        <span> <?=$infouser['fk_id_promotion']; ?> </span>

                        <div class="etapes_tp">
                            <?php 
                        
                            
                            ?>



                        </div>
                       
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