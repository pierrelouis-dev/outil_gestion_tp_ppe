<?php session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_gestion_tp','root',''); ?>
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
<?php if (isset($_GET['id']) AND $_GET['id'] > 0 )
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM eleve WHERE id = ?');
    $requser->execute(array($getid));
    $infouser = $requser->fetch();


    ?>
    <div class="row">
        <div class="col body-border">
            mes_tp.php?id=".$_SESSION['id']);
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
                    $reponsebrut = $bdd->query('SELECT * FROM tp');
                    while ($donneestrie = $reponsebrut->fetch())
                    {
                        ?>

                    <div class="liste-tp">
                        <div class="tp">
                            <img class="img-user-tp" src="img/user_tp.png">
                            <span class="nom-eleve"><?php echo $infouser['nom_eleve'];  ?></span>
                            <span class="nom-eleve"><?php echo $infouser['prenom_eleve'];  ?></span>
                            <div class="nom-promo">
                                <span><?php echo $infouser['classe_eleve']; ?></span>
                                <span><?php echo $infouser['option_eleve']; ?></span>
                            </div>
                            <div class="nom-tp-note">
                                <span> <?php echo $donneestrie['titre_tp']; ?> </span>
                                <span><?php echo $donneestrie['note_tp']; ?>/20</span>
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






                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col body-border"></div>
    </div>

    <?php
}
?>
</body>
</html>