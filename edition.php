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
</head>
<body>
<?php
    if ($_SESSION["role"] == "eleve") {
      header("Location: mes_tp.php");
    }

    $id = $_REQUEST['id'];

    $sql = 'SELECT * FROM tp WHERE id_tp = :id';
    $req = $bdd->prepare($sql);
    
    $req->bindParam('id', $id);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);

?>
<?php 

if  (isset($_POST['btn_creer'])  Or isset($_POST['btn_brouillon'])){

    if (!empty($_POST['titre_tp'])  && !empty($_POST['select_promo'])  && !empty($_POST['select_option'])  && !empty($_POST['dte_start'])  && !empty($_POST['dte_end'])  && !empty($_POST['desc_tp_ck'])) {

        $titre_tp = $_POST ['titre_tp'];
        $select_promo = $_POST ['select_promo'];
        $select_option = $_POST ['select_option'];
        $dte_start = $_POST ['dte_start'];
        $dte_end = $_POST ['dte_end'];
        $desc_tp_ck = $_POST ['desc_tp_ck'];

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $inserttp = $bdd->prepare("INSERT INTO tp (libelle_tp,  desc_tp, dte_deb, dte_fin, publier, Option_tp) VALUES (?,?,?,?,1,?)");
        $inserttp->execute(array($titre_tp,$desc_tp_ck,$dte_start, $dte_end,$select_option));
        
    }
    else{
        $erreur = "Vous devez remplir tous les champs ";
    }
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
                                        <input type="text" name="titre_tp" class="champs champs-titre-tp" id="titre_tp" value="<?= $result['libelle_tp'] ?>">
                                   </div>
                                   <!--INPUT promo-->
                                   <div class="div_promo">
                                      <label for="label_promo">Séléction de la promotion</label>
                                      <select name="select_promo" id="select_promo">    
                                          <option value="">Promotions</option>
                                          <option value="sio_1" <?= ($result['Option_tp'] === 'sio_1')? 'selected' : ''; ?>>Sio 1</option>
                                          <option value="sio_2" <?= ($result['Option_tp'] === 'sio_2')? 'selected' : ''; ?>>Sio 2</option>
                                      </select>
                                    </div>
                                    <!--INPUT option-->
                                    <div class="div_option">
                                      <label for="label_option">Séléction de l'option</label>
                                      <select name="select_option" id="select_option">
                                          <option value="">Options</option>
                                          <option value="slam"  <?= ($result['Option_tp'] === 'slam')? 'selected' : ''; ?> >SLAM</option>
                                          <option value="sisr"  <?= ($result['Option_tp'] === 'sisr')? 'selected' : ''; ?> >SISR</option>
                                      </select>
                                     </div>
                                       <div class="date-form">
                                         <div class="date_start">
                                                <label class="label_start" for="start">Date de début</label>
                                                <input type="date" id="start" name="dte_start" min="2020-01-01" max="2020-12-31" value="<?= explode(' ', $result['dte_deb'])[0] ?>">
                                        </div>
                                        <div class="date_end">
                                          <label for="start">Date de fin</label>
                                          <input type="date" id="label_end" name="dte_end" min="2020-01-01" max="2020-12-31" value="<?= explode(' ', $result['dte_fin'])[0] ?>">
                                        </div>
                                    </div>
                                  </div>
                               </table>

                               <textarea name="desc_tp_ck" id="editor1" rows="10" cols="80"><?= $result['desc_tp'] ?></textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'desc_tp_ck' );
                                </script>
                                    <h4>Création des étapes</h4>
                                <div class="bloc_etape" id ="etape-test" disabled>

                                    <label class="lab_etape">Nom de l'étape</label>
                                    <input type="text" name="titre_etape" class="champs champs-titre-etape">
                                    <label class="lab_etape" >Description de l'étape</label>
                                    <textarea name="desc_etape_ck" id="desc_etape_ck" rows="10" cols="80"></textarea>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor 4
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'desc_etape_ck' );
                                    </script>

                                    <div class="etape_cree">
                                    <!-- Mettre la req pour afficher les étapes deja creés  -->
                                    </div>
      
                                </div>
                               
                               <input type="submit" name="btn_creer" value="Publié" class="btn-creer">
                               <input type="submit" name="btn_creer" value="Brouillon" class="btn-creer">
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