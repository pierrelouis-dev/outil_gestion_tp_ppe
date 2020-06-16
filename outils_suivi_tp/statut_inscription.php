<html>
<header>
</header>
<body>




</body>
</html>


<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe', 'root', '');

$reponsebrut = $bdd->query('SELECT * FROM eleve WHERE statut_inscription =0');


    if ($_SESSION["role"] == "eleve") {
      header("Location: mes_tp.php");
    }

?>
<form method="POST" action="">
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
	 <span class="nom-eleve"><?php echo $donneestrie['nom_e'];  ?></span>
	 <span class="nom-eleve"><?php echo $donneestrie['prenom_e'];  ?></span>
	 <span class="nom-eleve"><?php echo $donneestrie['statut_inscription'];  ?></span>
	 <input type="" name="id_eleve" value="id_eleve">
	 	<input type="radio" name="valider" value="1">
	 <br>

<?php 

}
?>
 <input type="submit" name="subvalider" value="Valider l'inscription" class="btn-connecter" >
</form>