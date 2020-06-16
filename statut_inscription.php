<html>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<div class="container-tableau">
		<title>Confimations inscriptions 4</title>
	    <meta charset='utf-8'>
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <?php 
	    session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe', 'root', '');

$reponsebrut = $bdd->query('SELECT * FROM eleve WHERE statut_inscription =0');


    if ($_SESSION["role"] == "eleve") {
      header("Location: mes_tp.php");
    }

?>
<form method="POST" action="">

	    <div class="container">
	      <h1>Liste des personnes à confirmer</h1>
	      <table class="table">
	        <thead>
	          <tr>
	            <th>Nom</th>
	            <th>Prénom</th>
	            <th>Rôle</th>
	            <th>Validation</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php 
			while ($donneestrie = $reponsebrut->fetch())
			{
				if (isset($_POST['subvalider'])){

					$valider =  ($_POST['valider']);

					if ($valider ==1) {

						$req_update = $bdd->prepare ("UPDATE eleve SET statut_inscription =1 WHERE id_eleve=:id_eleve ");
						$req_update->execute(array($valider));
						$id_eleve = $donneestrie['id_eleve'];

					}
			}		

			?>
	          <tr>
	            <td><?php echo $donneestrie['nom_e'];  ?></td>
	            <td><?php echo $donneestrie['prenom_e'];  ?></td>
	            <td><?php echo $donneestrie['statut_inscription'];  ?></td>
	            <td><input type="radio" name="valider" value="1"></td>
	            <?php 

				}
				?>
	          </tr>
	        </tbody>
	      </table>
	      <input type="submit" name="subvalider" value="Valider l'inscription" class="btn-connecter" >
	    </div>
	</div>
</html>



	 <!---btn-- -
	 <input type="" name="id_eleve" value="id_eleve">
	 	<input type="radio" name="valider" value="1">
	 <br>


 <input type="submit" name="subvalider" value="Valider l'inscription" class="btn-connecter" >
 ---btn-- -->
</form>