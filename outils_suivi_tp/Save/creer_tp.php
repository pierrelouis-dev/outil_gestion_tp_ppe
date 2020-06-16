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
<?php
	/*Je vérifie si les condtions sont ok au  clique du btn insciption*/

	if(isset($_POST['btn-creer']))
	{

        if(!empty($_POST['titre_tp']) AND !empty($_POST['description_tp']))
		{

			$titre_tp = htmlspecialchars($_POST['titre_tp']);/*Ne pas pouvoir mettre des caractères speciaux dans le champ nom */
            $classe_tp = ($_POST['classe_tp']);
            $description_tp = ($_POST['description_tp']);

			$nomtaille = strlen($titre_tp);/*strlen = permet de compter */
			if ($nomtaille <=255)/*Nombre de caractères max*/
			{
			    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $inserttp = $bdd->prepare("INSERT INTO tp (titre_tp,  classe_tp, description_tp) VALUES (?,?,?)");/*Insert dans la table membres  et dans les colonnes */
                $inserttp->execute(array($titre_tp,$classe_tp,$description_tp));/*Insert du contenue de nom et de mdp*/
                header('Location: creer_tp.php');/*redirige l'utilisateur*/
			}
			else
			{
				$erreur = "Le nom doit être inférieur a 255 caractères";
			}

		}
		else
		{

			$erreur="tous les champs doivent etre completés";
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
                                   <label>Titre du TP</label>
                                   <input type="text" name="titre_tp" class="champs champs-titre-tp" id="titre_tp">

                                   <!--INPUT classe
                                   <label>Séléction de la promotion</label><br>
                                    <label>SIO 1</label>
                                   <input type="radio" name="classe_tp" class="champs champs-option" value="SIO1" id="option_tp">
                                    <label>SIO 2</label>
                                   <input type="radio" name="classe_tp" class="champs champs-option" value="SIO2" id="option_tp">-->
                                   <!--INPUT description -->
                                   <label>Déscritpion du TP </label>
                                   <input type="text" name=description_tp" class="champs champs-descritpion_tp" id="description_tp">
                               </table>
                               <input type="submit" name="btn-creer" value="creer" class="btn-connecter">
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
        </div>
        <div class="col body-border"></div>
    </div>


</body>
</html>