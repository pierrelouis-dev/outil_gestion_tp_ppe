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
    /** REDIRECTION SI PROF */
    if (!isset($_SESSION['id'])){
        header("Location: connexion.php");

    } else{
        if ($_SESSION["role"] == "eleve") {
                header("Location: mes_tp.php");
            }
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

        $req = "DELETE FROM creer WHERE fk_id_tp = :id";
        $req = $bdd->prepare($req);
        $req->bindParam('id', $_POST['id_tp']);
        $req->execute();

        $req = "DELETE FROM etape WHERE fk_id_tp = :id";
        $req = $bdd->prepare($req);
        $req->bindParam('id', $_POST['id_tp']);
        $req->execute();

        $req = "DELETE FROM tp WHERE id_tp = :id";
        $req = $bdd->prepare($req);
        $req->bindParam('id', $_POST['id_tp']);
        $req->execute();

        $req = "DELETE FROM etape WHERE fk_id_tp = :id";
        $req = $bdd->prepare($req);
        $req->bindParam('id', $_POST['id_tp']);
        $req->execute();

    }

    ?>
    <div class="row tp_en_cours">
        <div class="col body-border"></div>
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
                    <h3>TP EN COURS</h3>
                </div>
                <!---Liste des TP-- -->
                            <div class="background-btn-menu">
                                <div class="btn-position-menu">
                                    <bouton type="submit" id="1" class="statut btn-publie">Publié</bouton>
                                    <bouton type="submit" id="0" class="statut btn-npublie">Non publié</bouton>
                                    <bouton type="submit" id="2" class="statut btn-archive">Archivé</bouton>
                                </div>
                            </div>
                        <div class="mes_tp en_cours">
                          
                            <?php foreach ($result as $element){
                            ?>
                            <div class="liste-tp">
                                
                                <div class="tp statut<?= $element['publier']?>">
                                    <div class="libelle-desc-tp">
                                        <div><B><?= $element['libelle_tp'] ?></B></div>
                                        <div><?= $element['desc_tp']?></div>
                                    </div>    
                                    <div class="content-btn-img">
                                        <form action="" method="POST">

                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="btn-archive" type="submit" name="archiver"><img title="archiver" class="img-archive"  src="img/archive.png"></button>

                                        </form>

                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="btn-edit" type="submit" name="edit" ><img title="éditer" class="img-edit"  src="img/edit.png"></button>
                                        </form>

                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="btn-bin" type="submit" name="delete" ><img title="supprimer" class="img-bin"  src="img/trash.png"></button>
                                        </form>
                                            <?php
                                                if($element['publier'] == 0 || $element['publier'] == 2){
                                            ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_tp" value="<?= $element['id_tp'] ?>">
                                            <button class="btn-publier" type="submit" name="publication"><img title="publier" class="img-publier"  src="img/publish.png"></button>
                                        </form>
                                    
                                        <?php
                                            }
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
        $('#toggle').click(function(){
            $('#a').toggle();
            $('#b').toggle(1000);
            $('#c').toggle('slow');
        });
        $('.statut').click(function(){
            var id = $(this).attr('id');
            $('.tp').hide();
        $('.statut' + id).show();
        });

        $('#1').click(function () {
        $('#1').addClass('btn-active')
        $('#0').removeClass('btn-active')
        $('#2').removeClass('btn-active')
    })
    $('#0').click(function () {
        $('#1').removeClass('btn-active')
        $('#0').addClass('btn-active')
        $('#2').removeClass('btn-active')
    })
    $('#2').click(function () {
        $('#1').removeClass('btn-active')
        $('#0').removeClass('btn-active')
        $('#2').addClass('btn-active')
    })
        </script>
           </body>
    </html>