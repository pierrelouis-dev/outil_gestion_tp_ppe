
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
if(isset($_SESSION['id'])) header('Location: mes_tp.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe','root','');

    if(isset($_POST['subinscrire'])){
        header("Location: inscription.php");
    }
    
    if(isset($_POST['subconnect']))
    {

        $loginconnect = htmlspecialchars($_POST['loginconnect']);/*Ne pas pouvoir mettre des caracteres speciaux dans le champ nom */
        $mdpconnect = md5($_POST['mdpconnect']);/*Crypté le mdp en SHA 1 */
        if(!empty($loginconnect) AND !empty($mdpconnect))
        {
            $requser = $bdd->prepare("SELECT e.*,r.nom_role FROM eleve e, roles r WHERE e.id_role = r.id AND login = ? AND mdp = ? ");
            $test = $requser->execute(array($loginconnect,$mdpconnect));/*Insert du contenu=e de nom et de mdp*/
            $userexist = $requser->rowcount();
            if($userexist ==1)
            {
                $infouser = $requser ->fetch();
                $_SESSION['id'] = $infouser['id_eleve'];
                $_SESSION['login'] = $infouser['login'];
                $_SESSION['role'] = $infouser['nom_role'];
                header("Location: mes_tp.php");
                
            } 
            else
            {

                        $requser2 = $bdd->prepare("SELECT p.*,r.nom_role  FROM prof p,roles r WHERE p.id_role = r.id AND login = ? AND mdp = ? ");
                        $test1 = $requser2->execute(array($loginconnect,$mdpconnect));/*Insert du contenu=e de nom et de mdp*/
                        $userexist2 = $requser2->rowcount();
                        if($userexist2 ==1)
                        {
                            $infouser2 = $requser2 ->fetch();
                            $_SESSION['id'] = $infouser2['id_prof'];
                            $_SESSION['login'] = $infouser2['login'];
                            $_SESSION['role'] = $infouser2['nom_role'];
                            header("Location: tp_en_cours.php");

                        } 
                        else
                        {
                            $erreur = "Mot de passe ou Nom incorrect";
                        }
                    
               /**/ 
                $erreur = "Mot de passe ou Nom incorrect";
            }
        }
        else
        {
            $erreur = "Tous les champs doivent etre complétés!";
        }
            
    }

?>

	<!--Début formulaire-->
	<form method="POST" action="">
		<div class="col-12 form-co">
            <div class="champs-co">
                <span class="login-title">Connexion</span>
                <br>
                    <label>Nom</label>
                <br>
                    <input type="text" name="loginconnect"  class="champs champs-nom-co">
                <br>
                    <label>Mot de passe</label>
                <br>
                    <input type="password" name="mdpconnect" class="champs champs-mdp">

                </br>

                <input type="submit" name="subconnect" value="se connecter" class="btn-connecter" >
            </div>
            <div class="error">
                <?php
                /*Afficher la valeur de erreur si la variable erreur existe*/
                if (isset($erreur))
   {
      echo $erreur;
   }

                ?>
            </div>
        </div>

	</form>
	

</div>


</body>
</html>