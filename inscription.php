<!DOCTYPE html>

<html>
<head>
	<title>TP PHP</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div>
	<?php 
    session_start();
    $base = new PDO('mysql:host=localhost; dbname=outils_geestion_tp_ppe', 'root', '');
                                                                
                                 
    #include('function.php');
    #neweleve();
	?>
        <div class="col-12 form-co">
		<!--INPUT NOM-->
                <div class="champs-co">
                    <!--Début formulaire-->
                    <form method="POST" action="inscription.php" enctype="multipart/form-data">
                    <span class="login-title">Inscription</span>
                        <table>
                            <!--INPUT Nom-->
                            <label>Nom*</label>
                            <input type="text" name="nom" class="champs champs-nom-co" id="nom" required>
                            <!--INPUT Prénom-->
                            <label>Prénom*</label>
                            <input type="text" name="prenom" class="champs champs-prenom-co" id="prenom" required>
                            <!--INPUT login -->
                            <label>Login*</label>
                            <input type="login" name="login" class="champs champs-login" id="login" required>
                            <!--INPUT MPD -->
                            <label>Mot de passe*</label>
                            <input type="password" name="mdp" class="champs champs-mdp" id="mdp" required>
                            <!--INPUT option-->
                            <label>Option de l'élèves</label>
                            <select name="option" class="champs champs-promo">
                                <?php 
                                $requete_option = $base->query("SELECT * FROM option_eleve");
                                echo '<option selected>Choisir...</option>';
                                while ($req_option = $requete_option->fetch()){
                                    echo "<option value=".$req_option['id_option'].">".$req_option['libelle_option']."</option>";
                                };
                                                                
                                 ?>
                            </select>
                              <!--choix de la promo-->
                             <label>Choisir une promo élève</label>
                            <select name="promo" class="champs champs-promo">
                                <?php 
                                $requete_promo = $base->query("SELECT * FROM promotion");
                                echo '<option selected>Choisir...</option>';
                                while ($req_promo = $requete_promo->fetch()){
                                    echo "<option value=".$req_promo['id_promo'].">".$req_promo['libelle_promo']."</option>";
                                };
                               
                                                                
                                 ?>
                            </select>
                            <!--champs déroulent élève ou prof-->
                             <label>Choisir un statut</label>
                            <select name="role" class="champs champs-categorie">
                            <option selected>Choisir...</option>
                            <option value="eleve">Eleve</option>
                            <option value="prof">Prof</option>
                        </select>
                        <!--INPUT photo-->
                           <!--  <label>photo de profil</label>
                            <input type="file" name="avatar" class="champs champs-avatar" id="avatar">-->
                        </table>
                        <input type="submit" name="inscription" value="S'inscrire" class="btn-connecter">
                       <!-- <input type="submit" name="subconnect" value="Connexion">-->
                        <a href="connexion.php">Vous connecter </a>
                        <div class="error inscription">
                    </form>
                </div>
                    </div>
                        </div>

                         <?php 
                            try
                            {
                        if(isset($_POST["inscription"]))
                            {

                 
                 $role = ($_POST['role']); 
                 if ($role == "eleve") {


                  $login = ($_POST ['login']); 
                    $mdp = md5($_POST ['mdp']); 
                    $nom = ($_POST ['nom']); 
                    $prenom = ($_POST ['prenom']); 
                    $option = ($_POST ['option']); 
                    $fk_id_promo = ($_POST ['promo']);
                    $requete=$base->prepare('INSERT INTO eleve (login, mdp, nom_e, prenom_e, option_e, fk_id_promo, statut_inscription) VALUES (?,?,?,?,?,?,0)');
                    $requete->execute(array($login, $mdp, $nom, $prenom, $option, $fk_id_promo));
                    header('Location: connexion.php');
               } 
               else{
                    $erreur = "Il y a une erreur dans vos champs";
               } 
                $role = ($_POST['role']); 
                 if ($role == "prof"){ 

                   $login = ($_POST ['login']); 
                    $mdp = md5($_POST ['mdp']); 
                    $nom = ($_POST ['nom']); 
                    $prenom = ($_POST ['prenom']); 
                    $requete_prof=$base->prepare('INSERT INTO prof (login, mdp, nom_p, prenom_p, statut_inscription ) VALUES (?,?,?,?,0)');
                    $requete_prof->execute(array($login, $mdp, $nom, $prenom));
                    header('Location: connexion.php');
                    
               }  
               else{
                $erreur = "Il y a une erreur dans vos champs";
           } 
                
            } 
        }
    catch (PDOException $e) {
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      return false;
    }
  ?>
   <?php
                        /*Afficher la valeur de erreur si la variable erreur existe*/
                        if (isset($erreur)) {
                            echo $erreur;
                        }

                        ?>
</body>
</html>