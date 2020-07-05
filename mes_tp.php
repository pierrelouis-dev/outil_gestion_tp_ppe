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
    <script src="https://kit.fontawesome.com/264bee4198.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</head>
<body>

<?php

/** REDIRECTION SI PROF */
if (!isset($_SESSION['id'])){
    header("Location: connexion.php");

} 
if ($_SESSION["role"] == "prof") {
    header("Location: tp_en_cours.php");
}


$user_promo = $_SESSION['fk_id_promo'];
$user_option = $_SESSION['fk_id_option'];
$requser = $bdd->prepare("SELECT * FROM tp WHERE fk_id_promotion = :promoe AND option_tp = :optione AND publier = 1");
$requser->bindParam('promoe', $user_promo);
$requser->bindParam('optione', $user_option);
$requser->execute();

//req note
    /*NOTE TP*/ 
    $id_eleve = $_SESSION['id'];
    $req_note = "SELECT * FROM note n,tp t WHERE n.id_tp = t.id_tp AND id_eleve = :id_eleve";
    $req_note = $bdd->prepare($req_note);
    $req_note->bindParam('id_eleve', $id_eleve);
    $req_note->execute();
    $req_result = $req_note->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="row mes_tp">
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
            <div class="sous-titre-div">
                <div class="sous-titre-background">
                    <span class="sous-titre-page">Liste de vos tp en cours</span>
                </div>
            </div>
            <!---Liste des TP-- -->
            <div class="mes_tp">
                <?php
                while ($infouser = $requser->fetch()) {
                    ?>

                    <div class="liste-tp">
                        <div class="tp">
                            <div class="info_tp">
                                <div class="div_lib_esc">
                                    <strong><span> <?= $infouser['libelle_tp']; ?> </span></strong> <br>
                                    <span> <?= $infouser['desc_tp']; ?> </span> <br>
                                </div>
                                <div class="div_flex">
                                    <div class="div_date_deb">
                                        <i class="far fa-clock donner"></i><br>
                                        <span> <?= $infouser['dte_deb']; ?> </span>
                                    </div>
                                    <div class="div_date_fin" >
                                        <i class="far fa-clock rendre"></i><br>
                                        <span> <?= $infouser['dte_fin']; ?> </span>
                                    </div>
                                </div>

                                <?php 
                                //Affichage de la note 
                                    $note = "--/20";
                                    foreach($req_result as $notes){

                                        if($notes['id_tp'] == $infouser['id_tp']){
                                            $note = $notes['note']."/20";

                                        }
                                     }
                            ?>
                                    <span><center><?= $note?></center></span>
        
                            </div>
                        
                                        <button class="btn btn-primary btn-accord" id="<?= $infouser['id_tp'] ?>"><i style="text-align: center" class="fas fa-sort-down"></i></button>
                                    
                            <div class="etapes_tp">
                                <div class="box">
                                    <div class="bg-info" id="bg-info<?= $infouser['id_tp'] ?>">

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
                                                <input type="checkbox" onclick="update(<?= $step['id_etape'] ?>)" id="b<?= $step['id_etape'] ?>" value="<?= $step['id_etape'] ?>" name="id_etape">
                                                <span class="titre_etape_accordion"><?= $step['libelle_etape']?></span><br>
                                                <span class="desc_tape_accordion"><?= $step['desc_etape']?></span>
                                            </form>

                                        <?php
                                           endforeach;
                                        ?>
                                    </div>

                                </div>
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
        $('#b'+id).attr("checked", "checked");
        $('#b'+id).attr("disabled", "disabled");
    }

    $('#toggle').click(function(){
    $('#a').toggle();
    $('#b').toggle(1000);
    $('#c').toggle('slow');
    $('#d').toggle('slow', function(){
        console.log('Élément #d est caché/affiché');
    });
});
$('button').click(function(){
    var id = $(this).attr('id');
  $('#bg-info' + id).toggle();
});
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