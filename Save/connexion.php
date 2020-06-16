
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
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_gestion_tp','root','');
	
	if(isset($_POST['subconnect']))
	{

		$nomconnect = htmlspecialchars($_POST['nomconnect']);/*Ne pas pouvoir mettre des caracteres speciaux dans le champ nom */
		$mdpconnect = md5($_POST['mdpconnect']);/*Crypté le mdp en SHA 1 */
		if(!empty($nomconnect) AND !empty($mdpconnect))
		{
			$requser = $bdd->prepare("SELECT * FROM eleve WHERE nom_eleve = ? AND mdp_eleve = ? ");
			$requser->execute(array($nomconnect,$mdpconnect));/*Insert du contenu=e de nom et de mdp*/
			$userexist = $requser->rowcount();
			if($userexist ==1)
			{
				$infouser = $requser ->fetch();
				$_SESSION['id'] = $infouser['id'];
				$_SESSION['nom_eleve'] = $infouser['nom_eleve'];
				header("Location:mes_tp.php?id=".$_SESSION['id']);
            
			} 
			else
			{
				$erreur = "Mauvais identifiants";
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
                    <input type="text" name="nomconnect"  class="champs champs-nom-co">
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