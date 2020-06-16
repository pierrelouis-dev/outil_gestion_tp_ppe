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
    include('function.php');
    neweleve();
	?>

	<!--Début formulaire-->
	<form method="POST" action="" enctype="multipart/form-data">
        <div class="col-12 form-co">
		<!--INPUT NOM-->
                <div class="champs-co">
                    <span class="login-title">Inscription</span>
                        <table>
                            <!--INPUT Nom-->
                            <label>Nom</label>
                            <input type="text" name="nom" class="champs champs-nom-co" id="nom">
                            <!--INPUT Prénom-->
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="champs champs-prenom-co" id="prenom">
                            <!--INPUT Classe-->
                            <label>Classe</label>
                            <input type="text" name="classe" class="champs champs-classe" id="classe">
                            <!--INPUT option-->
                            <label>Option</label>
                            <input type="text" name="option" class="champs champs-option" id="option">
                            <!--INPUT MPD -->
                            <label>Mot de passe</label>
                            <input type="password" name="mdp" class="champs champs-mdp" id="mdp">
                            <!--INPUT MPD-2 -->
                            <label> Confirmation du mot de passe</label>
                            <input type="password" name="mdp2" class="champs champs-mdp" id="mdp2">
                            <!--INPUT photo-->
                            <label>photo de profil</label>
                            <input type="file" name="avatar" class="champs champs-avatar" id="avatar">
                            <!--Statut inscription-->
                            <label>Prof</label>
                            <input type="checkbox" name="statut_prof" class="champs champs-statut" id="statut">
                            <label>Eleve</label>
                            <input type="checkbox" name="statut_eleve" class="champs champs-statut" id="statut">
                        </table>

                        <input type="submit" name="btn-inscrition" value="S'inscrire" class="btn-connecter">
                       <!-- <input type="submit" name="subconnect" value="Connexion">-->
                    <a href="connexion.php">Vous connecter </a>
                    <div class="error inscription">
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
	
		<?php
        if (isset($_POST["subconnect"]))
        {
            header('Location : connexion.php');
        }
		/*Afficher la valeur de erreur si la variable erreur existe*/
        ?>
        <div class="error">
        <?php
			if (isset($erreur))
			{
				echo $erreur;
			}

		?>
        </div>
</div>


</body>
</html>