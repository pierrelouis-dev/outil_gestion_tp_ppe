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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<?php
if ($_SESSION["role"] == "eleve") {
    header("Location: mes_tp.php");
}

$req = "SELECT * FROM tp t, promotion p WHERE t.Option_tp = p.id_promo";
$result = $bdd->query($req)->fetchAll(PDO::FETCH_ASSOC);


/** ARCHIVAGE */
if(isset($_POST['archiver'])){

    $req = "UPDATE tp SET publier = 2 WHERE id_tp = :id ";
    $req = $bdd->prepare($req);
    $req->bindParam('id', $_POST['id_tp']);
    $req->execute();

}
/** PUBLICATION */
if(isset($_POST['publication'])){

    $req = "UPDATE tp SET publier = 1 WHERE id_tp = :id ";
    $req = $bdd->prepare($req);
    $req->bindParam('id', $_POST['id_tp']);
    $req->execute();

}

/** EDITION */
if(isset($_POST['edit'])){
    header("Location: edition.php?id={$_POST['id_tp']}");
}

/** SUPPRESSION */
if(isset($_POST['delete'])){

    $req = "DELETE FROM etape WHERE fk_id_tp = :id";
    $req = $bdd->prepare($req);
    $req->bindParam('id', $_POST['id_tp']);
    $req->execute();
    $req = "DELETE FROM tp WHERE id_tp = :id";
    $req = $bdd->prepare($req);
    $req->bindParam('id', $_POST['id_tp']);
    $req->execute();

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
            <div id="London" class="tabcontent">
                <div class="content-tp-en-cours">
                    <div class="mes_tp">
                        <div class="liste-tp">

                            <?php foreach ($result as $element){

                                if($element['publier'] == 1){

                                    ?>

                                    <div class="tp">
                                        <img class="img-suivi-tp" src="img/suivi-tp.png">

                                        <form action="" method="POST">

                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="archiver"><img class="img-archive"  src="img/archive.png"></button>

                                        </form>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="edit" ><img class="img-archive"  src="img/edit.png"></button>
                                        </form>

                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="delete" ><img class="img-archive"  src="img/trash.png"></button>
                                        </form>


                                        <div class="nom-tp-note">

                                            <span><?= $element['libelle_tp'] ?></span>
                                            <span><?= substr($element['desc_tp'], 0, 50). '...'?></span>
                                            <div class="nom-promo">
                                                Promotion : <span> <?= $element['libelle_promo'] ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div id="Paris" class="tabcontent">
                <div class="content-tp-en-cours">
                    <div class="mes_tp">
                        <div class="liste-tp">

                            <?php foreach ($result as $element){

                                if($element['publier'] == 0){

                                    ?>

                                    <div class="tp">
                                        <img class="img-suivi-tp" src="img/suivi-tp.png">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="archiver"><img class="img-archive"  src="img/archive.png"></button>
                                        </form>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="edit" ><img class="img-archive"  src="img/edit.png"></button>
                                        </form>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="delete" ><img class="img-archive"  src="img/trash.png"></button>
                                        </form>

                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="publication" >Publier</button>
                                        </form>
                                        <div class="nom-tp-note">

                                            <span><?= $element['libelle_tp'] ?></span>
                                            <span><?= substr($element['desc_tp'], 0, 50). '...'?></span>
                                            <div class="nom-promo">
                                                Promotion : <span> <?= $element['libelle_promo'] ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div id="Tokyo" class="tabcontent">
                <div class="content-tp-en-cours">
                    <div class="mes_tp">
                        <div class="liste-tp">

                            <?php foreach ($result as $element){

                                if($element['publier'] == 2){

                                    ?>

                                    <div class="tp">
                                        <img class="img-suivi-tp" src="img/suivi-tp.png">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="img-archive" type="submit" name="delete" ><img class="img-archive"  src="img/trash.png"></button>
                                        </form>
                                        <div class="nom-tp-note">

                                            <span><?= $element['libelle_tp'] ?></span>
                                            <span><?= $element['desc_tp'] ?></span>
                                            <div class="nom-promo">
                                                Promotion : <span> <?= $element['libelle_promo'] ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

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
        let i, tabcontent, tablinks;

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