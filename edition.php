<?php session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe','root',''); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Edition d'un tp</title>
=======
    <title>Title</title>
>>>>>>> ethan
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="../ckeditor.js"></script>
<<<<<<< HEAD
=======
    <script src="https://kit.fontawesome.com/264bee4198.js" crossorigin="anonymous"></script>
>>>>>>> ethan
</head>
<body>
<?php
    if ($_SESSION["role"] == "eleve") {
      header("Location: mes_tp.php");
    }

if (!isset($_REQUEST['id']) || ($_REQUEST['id']) =="" ){
    header("Location: creer_tp.php");

}

    $id = $_REQUEST['id'];

    $sql = 'SELECT * FROM tp WHERE id_tp = :id';
    $req = $bdd->prepare($sql);
    
    $req->bindParam('id', $id);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if (empty($result)){

        header("Location: creer_tp.php");

    }

?>
<?php 

if (isset($_POST['btn_save'])){

    if  (!empty($_POST['titre_tp'])  && !empty($_POST['select_promo'])  && !empty($_POST['select_option'])  && !empty($_POST['dte_start'])  && !empty($_POST['dte_end'])  && !empty($_POST['desc_tp_ck'])){
        
        $titre_tp = $_POST ['titre_tp'];
        $select_promo = $_POST ['select_promo'];
        $select_option = $_POST ['select_option'];
        $dte_start = $_POST ['dte_start'];
        $dte_end = $_POST ['dte_end'];
        $desc_tp_ck = $_POST ['desc_tp_ck'];
        $publier = 0 ;

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $inserttp = $bdd->prepare("UPDATE tp SET libelle_tp = ? ,  desc_tp = ? , dte_deb = ? , dte_fin = ? , publier = ? , Option_tp = ? WHERE id_tp = ?");
        $inserttp->execute(array($titre_tp, $desc_tp_ck, $dte_start, $dte_end, $publier, $select_option, $_REQUEST['id']));



    } 
}

<<<<<<< HEAD
$req = "SELECT * FROM option_eleve";

$req = $bdd->query($req);
$options = $req->fetchAll(PDO::FETCH_ASSOC);

$req = "SELECT * FROM promotion";

$req = $bdd->query($req);
$promotions = $req->fetchAll(PDO::FETCH_ASSOC);



=======
>>>>>>> ethan

/*ETAPES*/
if  (isset($_POST['ajouter_etape'])){
 
    if (!empty($_POST['titre_etape'])  && !empty($_POST['desc_etape_ck'])) {

        $titre_etape = $_POST['titre_etape'];
        $desc_etape_ck = $_POST['desc_etape_ck'];

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $inserttp = $bdd->prepare("INSERT INTO etape (libelle_etape,  desc_etape, fk_id_tp) VALUES (?,?,?)");
        $inserttp->execute(array($titre_etape, $desc_etape_ck, $id));
<<<<<<< HEAD
    }
}
=======
>>>>>>> ethan

        $insertetape = $bdd->prepare("SELECT * FROM etape WHERE fk_id_tp = $id");
        $insertetape->execute(array($id));
        /*$tabletape = $insertetape->fetch();
        $id_etape = $tabletape['id_etape'];
        var_dump($id_etape);*/

<<<<<<< HEAD
=======



        

>>>>>>> ethan
       /* if (isset($_POST['edit_etape'])){
            $updateetape = $bdd->prepare("UPDATE etape SET libelle_etape = ? ,  desc_etape = ?  WHERE fk_id_tp =  $id and id_tp = $id_etape");
            $updateetape->execute(array($titre_etape, $desc_etape_ck, $id));

        }
        if (isset($_POST['save_etape'])){

<<<<<<< HEAD
        }*/

/**
 * Affichage des etapes lors de l'edition
 */
if(isset($_REQUEST['edit_etape'])){
    if(isset($_REQUEST['id_etape'])) {
        $test = $_REQUEST['id_etape'];

        $req = "SELECT * FROM etape WHERE id_etape = :id";
        $req = $bdd->prepare($req);
        $req->bindParam('id', $test);
        $req->execute();
        $step_get = $req->fetch(PDO::FETCH_ASSOC);

        if ($step_get) {
            $erreur = "L'étape ne fonctionne pas";
        }
    }
}

if (isset($_POST['save_etape'])){

    $titre_etape = $_POST['titre_etape'];
    $desc_etape_ck = $_POST['desc_etape_ck'];
    $id_etape = $_REQUEST['id_etape'];
    $id = $_REQUEST['id'];
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = $bdd->prepare("UPDATE etape SET libelle_etape = :t_etape, desc_etape = :d_etape WHERE id_etape=:id_etape ");
        $req->bindParam('t_etape', $titre_etape);
        $req->bindParam('d_etape', $desc_etape_ck);
        $req->bindParam('id_etape', $id_etape);
        $req->execute();
        header('Location: edition.php?id='.$id);



 }
=======

    
>>>>>>> ethan

?>

    <div class="row">
    <div class="col body-border"></div>
    <div class="col-8 container-body">
<<<<<<< HEAD
        <div class="topnav" id="myTopnav">
            <a href="mes_tp.php" class="active">TP EN COURS</a>
            <a href="creer_tp.php" class="">CREER UN TP</a>
            <a href="creer_tp.php" class="">ADMINISTRATION DES INSCRIPTIONS</a>
=======
>>>>>>> ethan
            <img class="img-user" src="img/user.png">
        </div>
        <div class="body ">
            <div class="header">
<<<<<<< HEAD
                <h3>EDITION D'UN TP</h3>
            </div>
            <span class="sous-titre-page">Interface d'édition</span>

>>>>>>> ethan
            <!---Liste des TP-- -->
            <div class="interface-creation">

                <div class="form-interface">
                    <!--INPUT NOM-->
                    <div class="champs-creation">
                        <!--INPUT Titre du TP-->
                        <form method="POST" action="">
                            <table>
                                <div class="first_form">
                                    <div class="title_tp">
                                        <label>Titre du TP</label>
                                        <input type="text" name="titre_tp" class="champs champs-titre-tp" id="titre_tp"
                                               value="<?= $result['libelle_tp'] ?>">
                                    </div>
                                    <!--INPUT promo-->
                                    <div class="div_promo">
                                        <label for="label_promo">Séléction de la promotion</label>
                                        <select name="select_promo" id="select_promo">
                                            <option value="">Promotions</option>
<<<<<<< HEAD

                                            <?php

                                            foreach ($promotions as $promotion){
                                                ?>

                                                <option value="<?= $promotion['id_promo'] ?>"
                                                    <?=( $result[ 'Option_tp']=== $result['fk_id_promotion'] )? 'selected' : ''; ?>
                                                ><?= $promotion['libelle_promo'] ?></option>

                                                <?php
                                            }
                                            ?>
=======
>>>>>>> ethan
                                        </select>
                                    </div>
                                    <!--INPUT option-->
                                    <div class="div_option">
                                        <label for="label_option">Séléction de l'option</label>
                                        <select name="select_option" id="select_option">
                                            <option value="">Options</option>
<<<<<<< HEAD

                                            <?php

                                            foreach ($options as $option){
                                                ?>

                                                <option value="<?= $option['id_option'] ?>"
                                                    <?=( $result[ 'Option_tp']=== $result['Option_tp'] )? 'selected' : ''; ?>
                                                ><?= $option['libelle_option'] ?></option>

                                                <?php
                                            }
                                            ?>

=======
>>>>>>> ethan
                                        </select>
                                    </div>
                                    <div class="date-form">
                                        <div class="date_start">
                                            <label class="label_start" for="start">Date de début</label>
                                            <input type="date" id="start" name="dte_start" min="2020-01-01"
                                                   max="2020-12-31" value="<?= explode(' ', $result['dte_deb'])[0] ?>">
                                        </div>
                                        <div class="date_end">
                                            <label for="start">Date de fin</label>
                                            <input type="date" id="label_end" name="dte_end" min="2020-01-01"
                                                   max="2020-12-31" value="<?= explode(' ', $result['dte_fin'])[0] ?>">
                                        </div>
                                    </div>
                                </div>
                            </table>
                            <textarea name="desc_tp_ck" id="editor1" rows="10" cols="80">
                                    <?=$result[ 'desc_tp'] ?>
                                </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                // instance, using default configuration.
                                CKEDITOR.replace('desc_tp_ck');
                            </script>
<<<<<<< HEAD
                            <input type="submit" name="btn_save" value="Save" class="btn-save">
                        </form>

                        <h4>Création des étapes</h4>
                        <div class="bloc_etape" id="etape-test" disabled>
                            <form method="POST" action="">
                                <label class="lab_etape">Nom de l'étape</label>
                                <!-- VALUE -->
                                <input type="text" name="titre_etape" class="champs champs-titre-etape" value="<?= @$step_get['libelle_etape'] ?>">

                                <label class="lab_etape">Description de l'étape</label>
                                <textarea name="desc_etape_ck" value="" id="desc_etape_ck" rows="10" cols="80">

                                    <?= @$step_get['desc_etape'] ?>

                                </textarea>

>>>>>>> ethan
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                    // instance, using default configuration.
                                    CKEDITOR.replace('desc_etape_ck');
                                </script>
                                <div class="etape_cree">
                                    <!-- Mettre la req pour afficher les étapes deja creés  -->
                                </div>
<<<<<<< HEAD

                                <?php

                                if(isset($_REQUEST['id_etape'])){
                                    ?>

                                    <input type="submit" name="save_etape" value="Save" class="btn-edit-etape">
                                    <?php
                                }else{
                                    ?>
                                    <input type="submit" name="ajouter_etape" value="Ajouter" class="btn-creer">
                                    <?php
                                }
                                ?>
                                </form>
                                <?php
                                while($steps = $insertetape->fetch()){
                
                                    ?>  
                                    <div class="etape_creer">
                                    <span> <?= $steps['libelle_etape']?></span>
                                    <span> <?= $steps['desc_etape']?></span>
                                        <form method="GET" action="">
                                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                            <input type="hidden" name="id_etape" value="<?= $steps['id_etape'] ?>">
                                            <input type="submit" name="edit_etape" value="Edi" class="btn-edit-etape">
                                        </form>
                                        <form method="POST" action="">
                                            <input type="hidden" name="id_etape" value="<?= $steps['id_etape'] ?>">
                                            <input type="submit" name="supp_etape" value="Supp" class="btn-supp-etape">
                                        </form>


                                    </div> 

                                     <?php
=======
>>>>>>> ethan
                                }

                                    if (isset($_POST['supp_etape'])){
                                        $id_etape = $_POST['id_etape'];
                                        $delete_etape = $bdd->prepare("DELETE FROM etape WHERE fk_id_tp =  $id AND id_etape = $id_etape ");
                                        $delete_etape->execute();
                                       
                                        }
                                
                                
                                ?>
<<<<<<< HEAD

                        </div>
                        <div class="">
=======
>>>>>>> ethan
                            <?php if (isset($erreur)) { echo $erreur; } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col body-border"></div>
</div>
</div>

</body>
</html>