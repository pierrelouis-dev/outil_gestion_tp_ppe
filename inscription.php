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
                            <label>Nom</label>
                            <input type="text" name="nom" class="champs champs-nom-co" id="nom">
                            <!--INPUT Prénom-->
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="champs champs-prenom-co" id="prenom">
                            <!--INPUT login -->
                            <label>Login</label>
                            <input type="login" name="login" class="champs champs-login" id="login">
                            <!--INPUT MPD -->
                            <label>Mot de passe</label>
                            <input type="password" name="mdp" class="champs champs-mdp" id="mdp">
                            <!--INPUT option-->
                            <label>Option</label>
                            <input type="text" name="option" class="champs champs-option" id="option">
                            <!--INPUT photo-->
                            <label>photo de profil</label>
                            <input type="file" name="avatar" class="champs champs-avatar" id="avatar">
                            <select name="role">
                            <option value="eleve">Eleve</option>
                            <option value="prof">Prof</option>
                        </select>
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
                 $base = new PDO('mysql:host=localhost; dbname=ppe_projet', 'root', 'root');
                  $login = ($_POST ['login']); 
                    $mdp = md5($_POST ['mdp']); 
                    $nom = ($_POST ['nom']); 
                    $prenom = ($_POST ['prenom']); 
                    $option = ($_POST ['option']); 
                    $requete=$base->prepare('INSERT INTO eleve (login, mdp, nom_e, prenom_e, option_e, verif ) VALUES (?,?,?,?,?,0)');
                    $requete->execute(array($login, $mdp, $nom, $prenom, $option));
                $base=null;
                    
            } 
        }
    catch (PDOException $e) {
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      return false;
    }
  ?>
</body>
</html>