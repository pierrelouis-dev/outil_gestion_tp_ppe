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


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
<body>

<?php
/** REDIRECTION SI eleve */
if ($_SESSION["role"] == "eleve") {
    header("Location: tp_en_cours.php");
}

$req = "SELECT * FROM tp";
$req = $bdd->query($req);
$tps = $req->fetchAll(PDO::FETCH_ASSOC);


/** Notes */

if (isset($_POST['update_note'])) {

    $note = $_POST['update_note'];
    $id_tp = $_POST['id_tp'];
    $id_eleve = $_POST['id_eleve'];

    $req = "SELECT * FROM note WHERE id_eleve = :id_eleve AND id_tp = :id_tp";
    $req = $bdd->prepare($req);
    $req->bindParam('id_eleve', $id_eleve);
    $req->bindParam('id_tp', $id_tp);
    $req->execute();

    if (@is_null($req->fetch()['note'])) {
        $req = "INSERT INTO `note`(`id_eleve`, `id_tp`, `note`) VALUES (:id_eleve, :id_tp, :note)";
        $req = $bdd->prepare($req);

        $req->bindParam('id_eleve', $id_eleve);
        $req->bindParam('id_tp', $id_tp);
        $req->bindParam('note', $note);
        $req->execute();

    } else {

        $req = "UPDATE note SET note = :note WHERE id_eleve = :id_eleve AND id_tp = :id_tp";
        $req = $bdd->prepare($req);
        $note = intval($note);
        $id_eleve = intval($id_eleve);
        $id_tp = intval($id_tp);

        $req->bindParam('note', $note);
        $req->bindParam('id_eleve', $id_eleve);
        $req->bindParam('id_tp', $id_tp);
        $req->execute();
    }

}

?>

<div class="row">
    <div class="col body-border">
    </div>
    <div class="col-8 container-body">
        <div class="topnav" id="myTopnav">
        <a href="tp_en_cours.php" class="active">TP EN COURS</a>
        <a href="creer_tp.php" class="">CREER UN TP</a>
        <a href="gestion_tp.php" class="">GESTION DES TP</a>
        <a href="deconnexion.php" class="">Se déconnecter </a>
            <img class="img-user" src="img/user.png">
        </div>
        <div class="body">

            <div class="header">
                <h3>GESTION TP</h3>
            </div>
            <span class="sous-titre-page">Gestions des tp</span>
            <!---Liste des TP-- -->
            <br>

            <div class="row">
                <div class="col-md-8">
                    <form class="form-group">
                        <select class="form-control" name="" id="tp_choose">
                            <?php
                    /**POUR LISTE select     */
                            foreach ($tps as $tp) {
                                ?>

                                <option value="<?= $tp['id_tp'] ?>" <?= @$_GET['id'] == $tp['id_tp'] ? 'selected' : '' ?>><?= $tp['libelle_tp'] ?></option>

                                <?php
                            }

                            ?>
                        </select>
                    </form>

                </div>
                <div class="col">
                    <input type="text" id="search" class="form-control" placeholder="Rechercher">
                </div>
            </div>

            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">Nom Prénom</th>
                    <th scope="col">Note</th>

                    <?php


                    $req = "SELECT * FROM etape WHERE fk_id_tp = :id";
                    $req = $bdd->prepare($req);
                    $req->bindParam('id', $_GET['id']);
                    $req->execute();
                    $steps = $req->fetchAll(PDO::FETCH_ASSOC);
                    $count = $req->rowCount();

                    for ($i = 0; $i < $count; $i++) {
                        ?>
                        <th scope="col">Etape <?= $i + 1 ?></th>
                        <?php
                    }
                    ?>

                    <th scope="col">Avancement</th>
                </tr>
                </thead>
                <tbody id="table">

                <?php

                if (isset($_GET['id'])) {

                    $req = "SELECT e.* FROM tp t, eleve e WHERE t.Option_tp = e.fk_id_option AND t.id_tp = :id";
                    $req = $bdd->prepare($req);
                    $req->bindParam('id', $_GET['id']);
                    $req->execute();
                    $res = $req->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($res as $el) {
                        $stepsFinished = 0;
                        ?>
                        <tr>
                            <td><?= $el['nom_e'] . ' ' . $el['prenom_e'] ?></td>

                            <td>

                                <?php

                                $req = "SELECT * FROM note WHERE id_tp = :id_tp AND id_eleve = :id_eleve";
                                $req = $bdd->prepare($req);
                                $req->bindParam('id_tp', $_GET['id']);
                                $req->bindParam('id_eleve', $el['id_eleve']);
                                $req->execute();
                                $note = $req->fetch();

                                ?>

                                <form action="" method="post" id="form_note-<?= $el['id_eleve'] ?>">
                                    <input type="hidden" name="id_eleve" value="<?= $el['id_eleve'] ?>">
                                    <input type="hidden" name="id_tp" value="<?= $_GET['id'] ?>">
                                    <input name="update_note" type="text" onchange="update(<?= $el['id_eleve'] ?>)"
                                           id="note-<?= $el['id_eleve'] ?>"
                                           value="<?= isset($note['note']) ? $note['note'] : 'NaN' ?>">
                                </form>
                            </td>

                            <?php

                            foreach ($steps as $step) {

                                $req = "SELECT * FROM valider WHERE fk_id_eleve = :id_eleve AND fk_id_etape = :id_etape";
                                $req = $bdd->prepare($req);
                                $req->bindParam('id_eleve', $el['id_eleve']);
                                $req->bindParam('id_etape', $step['id_etape']);
                                $req->execute();
                                $t = $req->fetch(PDO::FETCH_ASSOC);

                                if (isset($t['date_validation'])) {

                                    $stepsFinished += 1;

                                    ?>
                                    <td><?= substr($t['date_validation'], 0, 10) ?></td>
                                    <?php
                                } else {
                                    ?>

                                    <td>-</td>
                                    <?php
                                }
                            }
                            ?>

                            <td><?php
                                if ($count == 0) {
                                    echo '0%';
                                } else {
                                    echo number_format((($stepsFinished * 100) / $count))  . '%';
                                }
                                ?>
                        </tr>

                        <?php

                    }
                } else {
                    echo "Aucun TP Sélectionné";
                }

                ?>
                </tbody>
            </table>

        </div>
    </div>
    <div class="col body-border"></div>
</div>

<script>
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            let value = $(this).val().toLowerCase();
            $("#table tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            })
        })
    })


    $("#tp_choose").change(function () {

        window.location = "gestion_tp.php?id=" + $("#tp_choose").val()

    })

    function update(id_eleve) {
        let note = $("#note-" + id_eleve).val()

        if (note == '') note = 'NaN'

        if ($.isNumeric(note)) {
            if (note <= 20 && note >= 0) {
                $("#form_note-" + id_eleve).submit()
            }
        }

    }
</script>
</body>
</html>