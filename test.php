<?php session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe', 'root', ''); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


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
                while ($infouser = $requser->fetch()) {
                    ?>

                    <div class="liste-tp">
                        <div class="tp">
                            <div class="info_tp">
                                <div class="div_lib_esc">
                                    <span> <?= $infouser['libelle_tp']; ?> </span> <br>
                                    <span> <?= $infouser['desc_tp']; ?> </span> <br>
                                </div>
                                <div class="div_flex">
                                    <div class="div_date_deb">
                                        <label>Donné le : </label> <br>
                                        <span> <?= $infouser['dte_deb']; ?> </span>
                                    </div>
                                    <div class="div_date_fin" >
                                        <label>A rendre le :</label> <br>
                                        <span> <?= $infouser['dte_fin']; ?> </span>
                                    </div>
                                </div>
                                <span> <?= $infouser['fk_id_promotion']; ?> </span>
                                <span><center>10/20</center></span>
                            </div>

                            <div class="etapes_tp">
                                <?php
                                    $req = "SELECT * FROM etape WHERE fk_id_tp = :id";
                                    $req = $bdd->prepare($req);
                                    $req->bindParam('id', $infouser['id_tp']);
                                    $req->execute();
                                    $steps = $req->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($steps as $step):
                                        ?>

                                        <form id="form-<?=$step['id_etape']?>" action="update_etape.php" method="get">

                                            <input type="hidden" name="id_eleve" value="<?= $_SESSION['id'] ?>">
                                            <input type="checkbox" onclick="update(<?= $step['id_etape'] ?>)" id="<?= $step['id_etape'] ?>" value="<?= $step['id_etape'] ?>" name="id_etape"> <span><?= $step['desc_etape']?></span>

                                        </form>

                                    <?php


                                    endforeach;



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


<script>
    function update(id){
        $('#form-' + id).submit();
        disabled(id)
    }

    function disabled(id){
        $('#'+id).attr("checked", "checked");
        $('#'+id).attr("disabled", "disabled");
    }
</script>

<?php

    $req = "SELECT * FROM valider WHERE fk_id_eleve = :id";
    $req = $bdd->prepare($req);
    $req->bindParam('id', $_SESSION['id']);
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_ASSOC);

    foreach($res as $el){
        ?>
            <script>disabled(<?= $el['fk_id_etape'] ?>)</script>
        <?php
    }

?>




</body>
</html>