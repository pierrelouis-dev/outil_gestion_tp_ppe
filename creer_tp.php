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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="../ckeditor.js"></script>
    <script src="https://kit.fontawesome.com/264bee4198.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
/** AUTORISATION */
    if (!isset($_SESSION['id'])){
        header("Location: connexion.php");

    } else{
        if ($_SESSION["role"] == "eleve") {
                header("Location: mes_tp.php");
            }
    }
?>
<?php 
/** CREATIONS TP */
if  (isset($_POST['btn_creer'])){

    if (!empty($_POST['titre_tp'])  && !empty($_POST['select_promo'])  && !empty($_POST['select_option'])  && !empty($_POST['dte_start'])  && !empty($_POST['dte_end'])  && !empty($_POST['desc_tp_ck'])) {

        $titre_tp = $_POST ['titre_tp'];
        $select_promo = $_POST ['select_promo'];
        $select_option = $_POST ['select_option'];
        $dte_start = $_POST ['dte_start'];
        $dte_end = $_POST ['dte_end'];
        $desc_tp_ck = $_POST ['desc_tp_ck'];

        $publication = 0;

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $inserttp = $bdd->prepare("INSERT INTO tp (libelle_tp,  desc_tp, dte_deb, dte_fin, publier, Option_tp, fk_id_promotion) VALUES (:lib, :desc, :dte_db, :dte_fn, :pub, :opt, :promo)");
        $inserttp->bindParam('promo', $select_promo);
        $inserttp->bindParam('lib', $titre_tp);
        $inserttp->bindParam('desc', $desc_tp_ck);
        $inserttp->bindParam('dte_db', $dte_start);
        $inserttp->bindParam('dte_fn', $dte_end);
        $inserttp->bindParam('pub', $publication);
        $inserttp->bindParam('opt', $select_option);

        $inserttp->execute();
        
        header('Location: edition.php?id='.$bdd->lastinsertid());
        
    }
    else{
        $erreur = "Vous devez remplir tous les champs ";
    }

}
/** REQ OPTION */
$req = "SELECT * FROM option_eleve";
$req = $bdd->query($req); 
$options = $req->fetchAll();

$req = "SELECT * FROM promotion";
$req = $bdd->query($req);
$promotions = $req->fetchAll(PDO::FETCH_ASSOC);

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
                                          <?php
                                          foreach ($promotions as $promotion){
                                              ?>

                                              <option value="<?= $promotion['id_promo'] ?>"><?= $promotion['libelle_promo'] ?></option>
                                              
                                              <?php
                                          }
                                          ?>
                                      </select>
                                    </div>
                                    <!--INPUT option-->
                                    <div class="div_option">
                                      <label for="label_option">Séléction de l'option</label>
                                      <select name="select_option" id="select_option">
                                          <option value="">Options</option>
                                          <?php 
                                          
                                          foreach($options as $option){

                                            ?>
                                            <option value="<?= $option['id_option']?>"><?= $option['libelle_option']?></option>

                                            <?php 
                                          }
                                        
                                          ?>
                                         
                                      </select>
                                     </div>
                                       <div class="date-form">
                                         <div class="date_start">
                                                <label class="label_start" for="start">Date de début</label>
                                                <input type="date" id="start" name="dte_start" value="2020-05-14" min="2020-01-01" max="2020-12-31">
                                        </div>
                                        <div class="date_end">
                                          <label for="start">Date de fin</label>
                                          <input type="date" id="label_end" name="dte_end" value="2020-05-14" min="2020-01-01" max="2020-12-31">
                                        </div>
                                    </div>
                                  </div>
                               </table>

                               <textarea name="desc_tp_ck" id="editor1" rows="10" cols="80"></textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'desc_tp_ck' );
                                </script>    

                               <input type="submit" name="btn_creer" value="Creer le tp" class="btn-creer">

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