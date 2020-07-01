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
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_gestion_tp','root','');
	/*Je vérifie si les condtions sont ok au  clique du btn insciption*/

	if(isset($_POST['btn-inscrition']))
	{
		if(!empty($_POST['nom']) AND !empty($_POST['prenom'])  AND !empty($_POST['classe']) AND !empty($_POST['option']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
		{

			$nom = htmlspecialchars($_POST['nom']);/*Ne pas pouvoir mettre des caractères speciaux dans le champ nom */
			$prenom= htmlspecialchars($_POST['prenom']);/*Ne pas pouvoir mettre des caractères speciaux dans le champ prenom */
            $classe = ($_POST['classe']);
            $option = ($_POST['option']);
			$mdp = md5($_POST['mdp']);/*Crypté le mdp en MD5*/
			$mdp2 = md5($_POST['mdp2']);/*Crypté le mdp en MD5 */

			$nomtaille = strlen($nom);/*strlen = permet de compter */
			if ($nomtaille <=255)/*Nombre de caractères max*/
			{
				if ($mdp == $mdp2)/*Test si mdp et mp2 sont égale*/
				{
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$insertmembre = $bdd->prepare("INSERT INTO eleve (nom_eleve,  prenom_eleve, classe_eleve, option_eleve, mdp_eleve) VALUES (?,?,?,?,?)");/*Insert dans la table membres  et dans les colonnes */
                    $insertmembre->execute(array($nom,$prenom,$classe,$option,$mdp));/*Insert du contenue de nom et de mdp*/

					header('Location: connexion.php');/*redirige l'utilisateur*/

				}

				else
				{
					$erreur = "Les mots de passe doit correspondres";
				}
			}
			else
			{
				$erreur = "Votre nom doit être inférieur a 255 caractères";
			}

		}
		else
		{
			$erreur="tous les champs doivent etre completés";
		}


	}


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