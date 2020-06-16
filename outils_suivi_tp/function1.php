<?php

	function connect(){
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
	}
	function erreur(){
		if (isset($erreur))
		{
	     echo $erreur;
	    }

	}
	function neweleve(){
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_gestion_tp_ppe','root','');
		/*Je vérifie si les condtions sont ok au  clique du btn insciption*/

		if(isset($_POST['btn-inscrition']))
		{
			if(!empty($_POST['nom']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
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

						header('Location: mes_tp.php');/*redirige l'utilisateur*/

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
	}


	function new_tp(){
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
	}

	function my_tp(){
		
	}

?>